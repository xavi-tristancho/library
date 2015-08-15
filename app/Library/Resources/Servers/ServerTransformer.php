<?php   namespace Library\Resources\Servers;

use League\Fractal\TransformerAbstract;

class ServerTransformer extends TransformerAbstract{

    public function transform($repository)
    {
        return [
            'id'         => $repository['id'],
            'project_id' => $repository['project_id'],
            'name'       => $repository['name'],
            'url'        => $repository['url'],
        ];
    }
} 