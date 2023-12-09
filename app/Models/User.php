<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    
    //One to many relation

    public function books(){
        return $this->hasMany('App\Models\Book');
    }

    public function payment_methods(){
        return $this->hasMany('App\Models\PaymentMethod');
    }

    public function series(){
        return $this->hasMany('App\Models\Serie');
    }

    public function bookshelves(){
        return $this->hasMany('App\Models\Bookshelf');
    }

    public function order_lines(){
        return $this->hasMany('App\Models\OrderLine');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    //Many to many relation
    
    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }

    //One to one polymorphic relation
    public function image(){
        return $this->belongsToMany('App\Models\Image', 'imageable');
    }
}
