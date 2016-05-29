<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    protected $guarded  = [];

    use Authenticatable, CanResetPassword;

    public function manga() {
        return $this->hasMany('App\Manga');
    }

    public function blogs() {
        return $this->hasMany('App\Blog');
    }

    public function bookmarks() {
        return $this->hasMany('App\Bookmark');
    }

    public function notifications() {
        return $this->hasMany('App\Notification');
    }

    public function rank() {
        return $this->belongsTo('App\Rank');
    }

    public function team() {
        return $this->belongsTo('App\Team');
    }

    public function roles() {
        return $this->belongsToMany('App\Role', 'user_roles', 'user_id', 'role_id');
    }

    public function pet() {
        return $this->belongsTo('App\Pet');
    }
}
