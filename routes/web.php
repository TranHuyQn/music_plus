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


Route::get('/', 'IndexController@index')->name('index');

Auth::routes(['verify'=>true]);

Route::get('profile', 'UserController@show')->middleware('login')->name('profile');
Route::post('profile', 'UserController@update_avatar')->middleware('login');

Route::get('/like/vote', 'LikeController@vote')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'SearchController@searchByName')->name('search.searchByName');

Route::get('/redirect/{social}', 'SocialAuthController@redirect')->name('facebook.login');
Route::get('/callback/{social}', 'SocialAuthController@callback');


Route::group(['prefix' => 'songs'], function () {
    Route::get('/', 'SongController@index')->name('songs.index');
    Route::get('/create', 'SongController@create')->middleware('login')->name('songs.create');
    Route::post('/store', 'SongController@store')->name('songs.store');
    Route::get('/{id}/play', 'SongController@show')->name('songs.play');
    Route::post('/addToPlaylist', 'SongController@addToPlaylist')->name('songs.addToPlaylist');
});


Route::get('/guestIndexPlayList', 'PlaylistController@guestIndex')->name('guest.playlists.list');
Route::get('/guestShowPlayList/{id}', 'PlaylistController@guestShow')->name('guest.playlists.show');
Route::get('playlists/{id}/playAll', 'PlaylistController@playAll')->name('playlists.playAll');
Route::get('singers/{id}/playAll', 'SingerController@playAll')->name('singers.playAll');
Route::get('/singerList', 'SingerController@index')->name('guest.singers.list');
Route::get('singer/{id}/show', 'SingerController@show')->name('singers.show');
Route::get('/songGuestIndex', 'SongController@showAll')->name('guest.songs.list');


Route::group(['prefix' => 'manage', 'middleware' => ['login']], function () {
    Route::group(['prefix' => 'playlist'], function () {
        Route::get('/', 'PlaylistController@index')->name('playlists.list');
        Route::get('/{playlistId}/show', 'PlaylistController@show')->name('playlists.show');
        Route::get('/{playlistId}/destroy/{songId}', 'PlaylistController@destroy')->name('playlists.destroy');
        Route::post('/', 'PlaylistController@store')->name('playlists.store');
        Route::post('/update/{id}', 'PlaylistController@update')->name('playlists.update');
        Route::post('/addSong/{playlistId}', 'PlaylistController@addSong')->name('playlists.addSong');
        Route::get('/{playlistId}/destroyAll', 'PlaylistController@destroyAll')->name('playlist.destroyAll');
        Route::get('/{id}/showHotPlaylist', 'PlaylistController@showHotPlaylist')->name('playlists.showHotPlaylist');
    });

    Route::group(['prefix' => 'singers'], function () {
        Route::get('/', 'SingerController@index')->name('singers.list');
        Route::get('/create', 'SingerController@create')->middleware('login')->name('singers.create');
        Route::post('/store', 'SingerController@store')->middleware('login')->name('singers.store');
        Route::get('/{id}/edit', 'SingerController@edit')->middleware('login')->name('singers.edit');
        Route::post('/{id}/update', 'SingerController@update')->middleware('login')->name('singers.update');

    });
    Route::group(['prefix' => 'songs'], function () {
        Route::get('/', 'SongController@songManager')->name('songs.list');
        Route::get('/create', 'SongController@create')->name('songs.create');
        Route::get('/{id}/edit', 'SongController@edit')->middleware('edit-song')->name('songs.edit');
        Route::post('/{id}/edit', 'SongController@update')->name('songs.update');
        Route::get('/{id}/destroy', 'SongController@destroy')->middleware('edit-song')->name('songs.destroy');
    });

    Route::group(['prefix' => 'artists'], function () {
        Route::get('/', 'ArtistController@index')->name('artists.list');
        Route::get('/create', 'ArtistController@create')->middleware('login')->name('artists.create');
        Route::post('/store', 'ArtistController@store')->middleware('login')->name('artists.store');
        Route::get('/{id}/show', 'ArtistController@show')->name('artists.show');
        Route::get('/{id}/edit', 'ArtistController@edit')->middleware('login')->name('artists.edit');
        Route::post('/{id}/update', 'ArtistController@update')->middleware('login')->name('artists.update');

    });
});

Route::group(['prefix' => 'comment', 'middleware' => ['login']], function () {
    Route::post('/store/{commentListId}', 'CommentController@store')->name('comments.store');
    Route::get('/{id}/destroy', 'CommentController@destroy')->name('comments.destroy');
    Route::post('/{id}/update', 'CommentController@update')->name('comments.update');
});
