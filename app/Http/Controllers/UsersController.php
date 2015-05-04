<?php namespace Library\Http\Controllers;

use JWTAuth;
use Library\Users\UserTransformer;
use Sorskod\Larasponse\Larasponse;
use Illuminate\Support\Facades\Request; 

class UsersController extends ApiController{

    function __construct(Larasponse $fractal)
    {
        $this->middleware('jwt.auth');

        $this->fractal = $fractal;

        $includes = Request::get('includes');

        if($includes)
        {
            $this->fractal->parseIncludes($includes);
        }
    }

    public function me()
    {
        $user = JWTAuth::parseToken()->authenticate();
        
        // the token is valid and we have found the user via the sub claim
        return $this->fractal->item($user, new UserTransformer());
    }
} 