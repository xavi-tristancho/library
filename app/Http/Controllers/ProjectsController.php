<?php namespace Library\Http\Controllers;

use Illuminate\Support\Facades\File;
use Library\Http\Requests;
use Library\Resources\Projects\CreateProjectRequest;
use Library\Resources\Projects\Project;
use Library\Resources\Projects\ProjectTransformer;
use Illuminate\Support\Facades\Request;
use Sorskod\Larasponse\Larasponse;

class ProjectsController extends ApiController {

    protected $fractal;

    /**
     * Add dependencies
     * @param Larasponse $fractal
     */
    function __construct(Larasponse $fractal)
    {
        $this->middleware('jwt.auth', ['except' => 'bower']);

        $this->fractal = $fractal;

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
	public function index()
	{
        $projects = Project::all();

        return $this->fractal->collection($projects, new ProjectTransformer());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateProjectRequest $request)
	{
        Project::create(Request::all());

        return $this->respondCreated('The Project has been created.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $project = Project::find($id);

        if($project)
        {
            return $this->fractal->item($project, new ProjectTransformer());
        }

        return $this->respondNotFound("The Project doesn't exist");
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CreateProjectRequest $request, $id)
	{
        $project = Project::find($id);

        if($project)
        {
            $project->name = Request::get('name');
            $project->save();

            return $this->respondUpdated("The Project has been updated");
        }

        return $this->respondNotFound("The Project doesn't exist");
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$project = Project::find($id);

        if($project)
        {
            $project->delete();

            return $this->respondDeleted("The Project has been deleted");
        }

        return $this->respondNotFound("The Project doesn't exist");
	}

    public function bower($id)
    {
        $project = Project::find($id);

        if($project)
        {
            $repositories = $project->repositories;

            $body = "{\n\t \"name\" : \"{$project->name}\",\n\t \"dependencies\": {\n";

            foreach($repositories as $repository)
            {
                $body .= "\t\t\"{$repository->bower_name}\" : \"latest\",\n";
            }

            $body = substr($body, 0, strlen($body) -2);

            $body .= "\n\t}\n}";

            File::put('file/bower.json', $body);

            return redirect('file/bower.json');
        }
    }

}
