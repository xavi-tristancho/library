<?php namespace Library\Http\Controllers;

use Library\Resources\Projects\Project;
use Library\Resources\Projects\ProjectStatistics;
use Library\Resources\Projects\ProjectsStatisticsTransformer;
use Sorskod\Larasponse\Larasponse;
use Library\Http\Requests;
use Illuminate\Support\Facades\Request;

class ProjectsStatisticsController extends ApiController {

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

    public function show($projectId)
    {
        $project = Project::find($projectId);

        $projectStatistics = new ProjectStatistics($project);

        return $this->fractal->item($projectStatistics, new ProjectsStatisticsTransformer());
    }
} 