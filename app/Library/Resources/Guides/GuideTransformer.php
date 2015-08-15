<?php namespace Library\Resources\Guides;

use League\Fractal\TransformerAbstract;

class GuideTransformer extends TransformerAbstract{

    public function transform($guide)
    {
        return [
            'id'      => $guide['id'],
            'project' => $guide['project_id'],
            'name'    => $guide['name'],
            'text'    => $guide['text'],
        ];
    }
} 