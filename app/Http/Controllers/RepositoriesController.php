<?php namespace Library\Http\Controllers;

use Carbon\Carbon;
use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Library\Http\Requests;
use Library\Resources\Projects\Project;
use Library\Resources\Repositories\CreateRepositoryRequest;
use Library\Resources\Repositories\Repository;
use Library\Resources\Repositories\RepositoryTransformer;
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
    public function index($project)
    {
        $repositories = Project::find($project)->repositories;
        $githubRepositories = $this->getRepositories($repositories);

        return $this->fractal->collection($githubRepositories, new RepositoryTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRepositoryRequest $request
     * @param $projectId
     * @return Response
     */
    public function store($projectId)
    {
        $repository = Repository::where('name', '=', Request::get('name'))->first();

        $project = Project::find($projectId);

        if(!$repository)
        {
            $repository = Repository::create(Request::all());
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

    /**
     * @param $repositories
     * @return array
     */
    private function getRepositories($repositories)
    {
        $githubRepositories = [];

        foreach ($repositories as $repository) {
            if (Cache::has($repository->name)) {
                $githubRepository = Cache::get($repository->name);
            } else {
                $name = explode('/', $repository->name);
                $githubRepository = $this->github->repo()->show($name[0], $name[1]);
                $expiresAt = Carbon::now()->addDays(1);
                Cache::add($repository->name, $githubRepository, $expiresAt);                
            }

            $githubRepository['id'] = $repository->id;
            array_push($githubRepositories, $githubRepository);            
        }
        return $githubRepositories;
    }
}
