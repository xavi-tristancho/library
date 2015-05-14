<?php namespace Library\Http\Controllers;

use GrahamCampbell\GitHub\GitHubManager;
use Library\OpenGraph\OpenGraph;
use Library\Resources\Projects\Project;
use Library\Resources\Links\Link;
use Library\Resources\Links\LinkTransformer;
use Illuminate\Support\Facades\Request;
use Sorskod\Larasponse\Larasponse;

class LinksController extends ApiController {

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
        $links = Project::find($projectId)->links;

        return $this->fractal->collection($links, new LinkTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $projectId
     * @return Response
     */
    public function store($projectId)
    {
        $fields = Request::all();
        $tags = OpenGraph::read($fields['url']);

        $project = Project::find($projectId);

        Link::create([
            'project_id' => $project->id,
            'url' => "http://" . str_replace("www.", "", str_replace("http://", "", $fields['url'])),
            'title' => $tags->title,
            'description' => $tags->description,
            'image' => $tags->images[0]->url
        ]);

        return $this->respondCreated("The Link has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param $projectId
     * @param $linkId
     * @return Response
     */
    public function show($projectId, $linkId)
    {
        $links = Project::find($projectId)->links;

        if($links)
        {
            foreach($links as $repository)
            {
                if($repository->id == $linkId)
                {
                    return $this->fractal->item($repository, new LinkTransformer());
                }
            }
        }

        return $this->respondNotFound("The Link doesn't exist");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateLinkRequest $request
     * @param $projectId
     * @param $linkId
     * @return Response
     */
    public function update(CreateLinkRequest $request, $projectId, $linkId)
    {
        $links = Project::find($projectId)->links;

        if($links)
        {
            foreach($links as $repository)
            {
                if($repository->id == $linkId)
                {
                    $repository->name = Request::get('name');
                    $repository->save();

                    return $this->respondUpdated("The Link has been updated");
                }
            }
        }

        return $this->respondNotFound("The Link doesn't exist");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $projectId
     * @param $linkId
     * @return Response
     */
    public function destroy($projectId, $linkId)
    {
        $link = Link::find($linkId);

        if(!$link)
        {
            return $this->respondNotFound("The Link doesn't exist");
        }

        $link->delete();

        return $this->respondDeleted("The Link has been deleted");
    }
}
