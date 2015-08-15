<?php namespace Library\Resources\Projects;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    protected $fillable = ['name'];

    public function repositories()
    {
        return $this->belongsToMany('Library\Resources\Repositories\Repository');
    }

    public function links()
    {
        return $this->hasMany('Library\Resources\Links\Link');
    }

    public function servers()
    {
        return $this->hasMany('Library\Resources\Servers\Server');
    }
}
