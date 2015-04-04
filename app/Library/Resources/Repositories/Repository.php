<?php namespace Library\Resources\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model {

    protected $fillable = ['name'];

    public function projects()
    {
        return $this->belongsToMany('Library\Resources\Projects\Project');
    }
}
