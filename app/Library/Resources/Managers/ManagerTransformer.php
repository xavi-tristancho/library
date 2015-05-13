<?php namespace Library\Resources\Managers;

use League\Fractal\TransformerAbstract;

class ManagerTransformer extends TransformerAbstract{

    public function transform($manager)
    {
        return [
            'id'   => $manager['id'],
            'name' => $manager['name'],
            'file' => $manager['file'],
        ];
    }
} 