<?php namespace Library\Resources\Links;

use League\Fractal\TransformerAbstract;

class LinkTransformer extends TransformerAbstract{

    public function transform($link)
    {
        return [
            'id'          => $link['id'],
            'project'     => $link['name'],
            'url'         => $link['url'],
            'title'       => $link['title'],
            'description' => $link['description'],
            'image'       => $link['image'],
        ];
    }
} 