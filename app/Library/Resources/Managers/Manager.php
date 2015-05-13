<?php namespace Library\Resources\Managers;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model {

    protected $fillable = ['name', 'file'];

    public function repositories()
    {
        return $this->hasMany('Library\Resources\Repositories\Repository');
    }
}
