<?php namespace Library\Http\Controllers;

use Illuminate\Support\Facades\File;
use Library\Http\Requests;
use Library\Resources\Managers\CreateManagerRequest;
use Library\Resources\Managers\Manager;
use Library\Resources\Managers\ManagerTransformer;
use Illuminate\Support\Facades\Request;
use Sorskod\Larasponse\Larasponse;

class ManagersController extends ApiController {

    protected $fractal;

    /**
     * Add dependencies
     * @param Larasponse $fractal
     */
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

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $managers = Manager::all();

        return $this->fractal->collection($managers, new ManagerTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateManagerRequest $request)
    {
        Manager::create(Request::all());

        return $this->respondCreated('The Manager has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $manager = Manager::find($id);

        if($manager)
        {
            return $this->fractal->item($manager, new ManagerTransformer());
        }

        return $this->respondNotFound("The Manager doesn't exist");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(CreateManagerRequest $request, $id)
    {
        $manager = Manager::find($id);

        if($manager)
        {
            $manager->name = Request::get('name');
            $manager->file = Request::get('file');
            $manager->save();

            return $this->respondUpdated("The Manager has been updated");
        }

        return $this->respondNotFound("The Manager doesn't exist");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $manager = Manager::find($id);

        if($manager)
        {
            $manager->delete();

            return $this->respondDeleted("The Manager has been deleted");
        }

        return $this->respondNotFound("The Manager doesn't exist");
    }
}
