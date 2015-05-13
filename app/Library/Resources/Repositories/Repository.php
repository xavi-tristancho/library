<?php namespace Library\Resources\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model {

    protected $fillable = ['name', 'dependency_name', 'manager_id'];

    public function projects()
    {
        return $this->belongsToMany('Library\Resources\Projects\Project');
    }

    public function manager()
    {
        return $this->belongsTo('Library\Resources\Managers\Manager');
    }
}
