<?php

/*
 *  JFuentealba @itux
 *  created at 
 *  updated at September 9, 2019 - 10:12 pm
 */

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
// Caffeinates Shinobi
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use App\Dependency;
use App\Solicitud;
use App\Activity;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'dependency_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permission()
    {

        return $this->hasMany('App\Permission');

    }

    public function role()
    {

        return $this->hasMany('App\Permission');

    }

    public function dependency()
    {

        return $this->belongsTo('App\Dependency');

    }

    public function solicitud()
    {

        return $this->hasMany('App\Solicitud');

    }

    public function actividad()
    {

        return $this->hasMany('App\Activity');

    }

    //Establecemos la relación N:N con Posts
    public function posts(){

        return $this->hasMany(Post::class);

    }
}
