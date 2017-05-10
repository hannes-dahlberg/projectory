<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model {
    protected $table = 'social_logins';
    protected $fillable = ['oauth_id', 'access_token', 'refresh_token', 'driver'];

    public function user() { return $this->belongsTo(User::class); }
}