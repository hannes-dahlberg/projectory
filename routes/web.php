<?php

//Catch all request except under the API prefix and render index view
Route::any('{catchall}', function($url) {
    return view('index');
})->where('catchall', '(?:(?!api).)*');

