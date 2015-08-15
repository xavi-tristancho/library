<?php namespace Library\Resources\Links;

use Illuminate\Database\Eloquent\Model;

class Link extends Model{

    protected $fillable = ['project_id', 'url', 'title', 'description', 'image'];
}