<?php namespace Library\OpenGraph;

use Fusonic\OpenGraph\Consumer;

class OpenGraph {

    public static function read($url)
    {
        $consumer = new Consumer();
        $object = $consumer->loadUrl($url);

        return $object;
    }
} 