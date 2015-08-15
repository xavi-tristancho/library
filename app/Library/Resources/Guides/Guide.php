<?php namespace Library\Resources\Guides;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model{

    protected $fillable = ['project_id', 'name', 'text'];
}