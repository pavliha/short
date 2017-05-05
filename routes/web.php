<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/api/shorten', function (\Illuminate\Http\Request $request) {
    $url = $request->url;
    $rules = ['url' => 'required|url'];
    $validation = Validator::make($request->all(), $rules);

    if ($validation->fails()) {
        return response($validation->errors()->all(),400);
    }

    $link = App\Link::where('url', '=', $url)->first();

    if(is_object($link)){
        return url($link->hash);
    };

    do {
        $newHash = str_random(6);
    } while (App\Link::where('hash', '=', $newHash)->count() > 0);

    $link = App\Link::create([
        'url'  => $url,
        'hash' => $newHash,
    ]);

    return url($link->hash);

});

Route::get("/{hash}",function($hash){
    return redirect()->to(App\Link::where('hash', '=', $hash)->first()->url);
});
Auth::routes();

Route::get('/home', 'HomeController@index');
