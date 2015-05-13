<?php namespace Library\Resources\Projects;

use League\Fractal\TransformerAbstract;

class ProjectsStatisticsTransformer extends TransformerAbstract{

    public function transform($projectStatistic)
    {
        $project =  $projectStatistic->getProject();

        return [
            'id'                 => $project->id,
            'name'               => $project->name,
            'repositories_count' => $projectStatistic->getRepositoriesCount(),
        ];
    }
}