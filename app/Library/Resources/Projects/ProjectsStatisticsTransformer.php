<?php namespace Library\Resources\Projects;

use League\Fractal\TransformerAbstract;

class ProjectsStatisticsTransformer extends TransformerAbstract{

    public function transform($projectStatistic)
    {
        $project =  $projectStatistic->getProject();

        return [
            'id'                        => $project->id,
            'name'                      => $project->name,
            'github_repositories_count' => $projectStatistic->getGithubRepositoriesCount(),
        ];
    }
}