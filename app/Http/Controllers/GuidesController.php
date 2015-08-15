<?php namespace Library\Http\Controllers;

use Library\Resources\Projects\Project;
use Library\Resources\Guides\Guide;
use Library\Resources\Guides\GuideTransformer;
use Illuminate\Support\Facades\Request;
use Sorskod\Larasponse\Larasponse;

class GuidesController extends ApiController {

    protected $fractal;
    protected $github;

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
        $guides = Project::find($projectId)->guides;

        return $this->fractal->collection($guides, new GuideTransformer());
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

        $project = Project::find($projectId);

        Guide::create([
            'project_id' => $project->id,
            'name'       => $fields['name'],
            'text'       => $fields['text'],
        ]);

        return $this->respondCreated("The Guide has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param $projectId
     * @param $guideId
     * @return Response
     */
    public function show($projectId, $guideId)
    {
        $guides = Project::find($projectId)->guides;

        if($guides)
        {
            foreach($guides as $guide)
            {
                if($guide->id == $guideId)
                {
                    return $this->fractal->item($guide, new GuideTransformer());
                }
            }
        }

        return $this->respondNotFound("The Guide doesn't exist");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $projectId
     * @param $guideId
     * @return Response
     */
    public function update($projectId, $guideId)
    {
        $guides = Project::find($projectId)->guides;

        if($guides)
        {
            foreach($guides as $guide)
            {
                if($guide->id == $guideId)
                {
                    $guide->name = Request::get('name');
                    $guide->text = Request::get('text');
                    $guide->save();

                    return $this->respondUpdated("The Guide has been updated");
                }
            }
        }

        return $this->respondNotFound("The Guide doesn't exist");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $projectId
     * @param $guideId
     * @return Response
     */
    public function destroy($projectId, $guideId)
    {
        $guide = Guide::find($guideId);

        if(!$guide)
        {
            return $this->respondNotFound("The Guide doesn't exist");
        }

        $guide->delete();

        return $this->respondDeleted("The Guide has been deleted");
    }
}