<?php namespace Library\Resources\Servers;

use Illuminate\Database\Eloquent\Model;

class Server extends Model{

    protected $fillable = ['project_id', 'name', 'url'];

    public function projects()
    {
        return $this->belongsToMany('Libraprojec
        ry\Resources\Projects\Project');
    }
} 