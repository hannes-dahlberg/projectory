<?php namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasApiTokens, Notifiable;

    protected $fillable = ['email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];

    public function socialLogins() { return $this->hasMany(SocialLogin::class); }
}
