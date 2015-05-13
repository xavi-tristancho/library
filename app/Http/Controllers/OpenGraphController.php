<?php namespace Library\Http\Controllers;

use Library\OpenGraph\OpenGraph;
use Library\OpenGraph\OpenGraphTransformer;
use Sorskod\Larasponse\Larasponse;
use Illuminate\Support\Facades\Request;

class OpenGraphController extends ApiController{

    protected $fractal;

    public function __construct(Larasponse $fractal)
    {
        $this->fractal = $fractal;
        $this->middleware('jwt.auth');
    }

    public function read()
    {
        $url = Request::get('url');

        $tags = OpenGraph::read($url);

        return $this->fractal->item($tags, new OpenGraphTransformer());
    }
} 