<?php namespace Library\Users;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Hash;

class User extends Model implements AuthenticatableContract{

    use Authenticatable;

    protected $fillable = ['username', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $table = "users";

    public function setPasswordAttribute($password){

        $this->attributes['password'] = Hash::make($password);
    }
} 