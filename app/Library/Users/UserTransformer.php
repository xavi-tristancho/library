<?php namespace Library\Users;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract{

    public function transform($user)
    {
        return [
            'username'   => $user['username'],
            'created_at' => $user['created_at'],
        ];
    }
} 