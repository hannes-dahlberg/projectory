<?php namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use Socialite;
use App\Models\User;

class AuthController extends Controller {
    public function auth(Request $request) {
        $http = new \GuzzleHttp\Client;

        //Make request to itself for token using provided username and password
        $token = json_decode((string) $http->post(env('APP_URL', 'http://laravel-vue.app'). '/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => env('PASSPORT_PASSWORD_CLIENT_ID', 'client-id'),
                'client_secret' => env('PASSPORT_PASSWORD_CLIENT_SECRET', 'client-secret'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
                'scope' => '*'
            ]
        ])->getBody(), true);

        //USing token to get user data
        $user = json_decode((string) $http->get(env('APP_URL', 'http://laravel-vue.app'). '/api/auth/user', [
            'headers' => [
                'Authorization' => 'Bearer '. $token['access_token']
            ]
        ])->getBody(), true);

        return [
            'user' => $user,
            'token' => $token
        ];
    }
    public function getUser(Request $request) {
        return json_decode((string) \Auth::user(), true);
    }
    public function social($driver) {
        return Socialite::driver($driver)->stateless()->redirect();
    }
    public function socialCallback($driver) {
        try {
            $socialUser = Socialite::driver($driver)->stateless()->user();

            //Get user (or create if not existing)
            $user = User::updateOrCreate([
                'email' => $socialUser->email
            ]);

            /*Associate token with user's social login (or create social login
            if not existing)*/
            $user->socialLogins()->updateOrCreate([
                'oauth_id' => $socialUser->id,
                'driver' => $driver
            ], [
                'access_token' => $socialUser->token
            ]);

            //Return with user and a new token
            return [
                'user' => $user,
                'token' => $user->createToken('token')->accessToken
            ];
        } catch(ClientException $error) {
            abort(400);
        }
    }
}
