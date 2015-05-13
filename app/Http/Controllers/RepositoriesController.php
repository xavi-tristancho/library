<?php namespace Library\Http\Controllers;

use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Library\Http\Requests;
use Library\Resources\Projects\Project;
use Library\Resources\Repositories\CreateRepositoryRequest;
use Library\Resources\Repositories\Repository;
use Library\Resources\Repositories\RepositoryTransformer;
use Library\Github\GithubApi;
use Illuminate\Support\Facades\Request;
use Sorskod\Larasponse\Larasponse;

class RepositoriesController extends ApiController {

    protected $fractal;
    protected $github;

    /**
     * Add dependencies
     * @param Larasponse $fractal
     * @param GitHubManager $github
     */
    function __construct(Larasponse $fractal, GitHubManager $github)
    {
        $this->middleware('jwt.auth');
        $this->fractal = $fractal;
        $this->github = $github;

        $includes = Request::get('includes');

        if($includes)
        {
            $this->fractal->parseIncludes($includes);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($projectId)
    {
        $repositories = Project::find($projectId)->repositories;

        return $this->fractal->collection($repositories, new RepositoryTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $projectId
     * @return Response
     */
    public function store($projectId)
    {
        $repository = Repository::where('name', '=', Request::get('name'))->first();

        $project = Project::find($projectId);

        if(!$repository)
        {
            try{
                $fields = GithubApi::getDependencyName(Request::all());
                $repository = Repository::create($fields);
            }
            catch(QueryException $e)
            {
                return $this->respondFailedValidation('Please fill all the fields');
            }
        }

        $project->repositories()->attach($repository->id);

        return $this->respondCreated("The Repository has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param $projectId
     * @param $repositoryId
     * @return Response
     */
    public function show($projectId, $repositoryId)
    {
        $repositories = Project::find($projectId)->repositories;

        if($repositories)
        {
            foreach($repositories as $repository)
            {
                if($repository->id == $repositoryId)
                {
                    return $this->fractal->item($repository, new RepositoryTransformer());
                }
            }
        }

        return $this->respondNotFound("The Repository doesn't exist");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateRepositoryRequest $request
     * @param $projectId
     * @param $repositoryId
     * @return Response
     */
    public function update(CreateRepositoryRequest $request, $projectId, $repositoryId)
    {
        $repositories = Project::find($projectId)->repositories;

        if($repositories)
        {
            foreach($repositories as $repository)
            {
                if($repository->id == $repositoryId)
                {
                    $repository->name = Request::get('name');
                    $repository->save();

                    return $this->respondUpdated("The Repository has been updated");
                }
            }
        }

        return $this->respondNotFound("The Repository doesn't exist");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $projectId
     * @param $repositoryId
     * @return Response
     */
    public function destroy($projectId, $repositoryId)
    {
        $project = Project::find($projectId);

        if(!$project)
        {
            return $this->respondNotFound("The Project doesn't exist");
        }

        foreach($project->repositories as $repository)
        {
            if($repository->id == $repositoryId)
            {
                $project->repositories()->detach($repositoryId);
                $this->deleteUnusedRepositories();

                return $this->respondDeleted("The Repository has been deleted");
            }
        }

        return $this->respondNotFound("The Repository doesn't exist");
    }

    private function deleteUnusedRepositories()
    {
        $repositories = DB::select(DB::raw(
            '
            SELECT *
            FROM repositories
            WHERE id NOT IN (
              SELECT DISTINCT repository_id
              FROM project_repository
            )
            '
        ));

        foreach($repositories as $repository)
        {
            Repository::find($repository->id)->delete();
        }
    }
}
