<?php namespace Library\Http\Controllers;

use Library\Resources\Projects\Project;
use Library\Resources\Servers\Server;
use Library\Resources\Servers\ServerTransformer;
use Illuminate\Support\Facades\Request;
use Sorskod\Larasponse\Larasponse;

class ServersController extends ApiController {

    protected $fractal;

    /**
     * Add dependencies
     * @param Larasponse $fractal
     */
    function __construct(Larasponse $fractal)
    {
        $this->middleware('jwt.auth');
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
    public function index($projectId)
    {
        $project = Project::find($projectId);

        if($project)
        {
            $servers = $project->servers;
        }
        else
        {
            return $this->respondNotFound('The Project Does Not Exist');
        }

        return $this->fractal->collection($servers, new ServerTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $projectId
     * @return Response
     */
    public function store($projectId)
    {
        $project = Project::find($projectId);

        if($project)
        {
            $fields = Request::all();
        }

        Server::create([
            'project_id' => $project->id,
            'name'       => $fields['name'],
            'url'        => "http://" . str_replace("www.", "", str_replace("http://", "", $fields['url'])),
        ]);

        return $this->respondCreated("The Server has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param $projectId
     * @param $serverId
     * @return Response
     */
    public function show($projectId, $serverId)
    {
        $servers = Project::find($projectId)->servers;

        if($servers)
        {
            foreach($servers as $server)
            {
                if($server->id == $serverId)
                {
                    return $this->fractal->item($server, new ServerTransformer());
                }
            }
        }

        return $this->respondNotFound("The Server doesn't exist");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateServerRequest $request
     * @param $projectId
     * @param $serverId
     * @return Response
     */
    public function update(CreateServerRequest $request, $projectId, $serverId)
    {
        $servers = Project::find($projectId)->servers;

        if($servers)
        {
            foreach($servers as $server)
            {
                if($server->id == $serverId)
                {
                    $server->name = Request::get('name');
                    $server->save();

                    return $this->respondUpdated("The Server has been updated");
                }
            }
        }

        return $this->respondNotFound("The Server doesn't exist");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $projectId
     * @param $serverId
     * @return Response
     */
    public function destroy($projectId, $serverId)
    {
        $link = Server::find($serverId);

        if(!$link)
        {
            return $this->respondNotFound("The Server doesn't exist");
        }

        $link->delete();

        return $this->respondDeleted("The Server has been deleted");
    }
}
