<?php   namespace Library\OpenGraph;

use League\Fractal\TransformerAbstract;

class OpenGraphTransformer extends TransformerAbstract{

    public function transform($tags)
    {
        return [
            'title'        => $tags->title,
            'description'  => $tags->description,
            'image'        => $tags->images[0]->url
        ];
    }
} 