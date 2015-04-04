<?php namespace Library\Resources\Projects;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $fillable = ['name'];

    public function repositories()
    {
        return $this->belongsToMany('Library\Resources\Repositories\Repository');
    }
}
