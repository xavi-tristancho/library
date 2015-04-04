<?php   namespace Library\Resources\Projects;

use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract{

    public function transform($project)
    {
        return [
            'id'           => $project['id'],
            'name'         => $project['name'],
        ];
    }
} 