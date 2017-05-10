<?php namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\PublicEvent;
use App\Events\PrivateEvent;
use Auth;

class EventController extends Controller {
    public function publicEvent(Request $request) {
        event(new PublicEvent($request->input('message')));
    }
    public function privateEvent(Request $request) {
        event(new PrivateEvent(Auth::user(), $request->input('message')));
    }
}