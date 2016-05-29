<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => 'blog'], function() {
    Route::get('blog-list', 'BlogController@index');
    Route::get('add-list', 'BlogController@add_blog');
    Route::post('add-list', 'BlogController@store_blog');
    Route::get('{cleanUrl}', 'BlogController@view');
    Route::get('edit-blog/{blog_id}', 'BlogController@edit_blog');
    Route::post('edit-blog/{blog_id}', 'BlogController@update_blog');
});

Route::group(['prefix' => 'manga'], function() {
    Route::get('manga-list', 'MangaController@index');
    Route::post('bookmark', 'MangaController@bookmark');
    Route::get('random', 'MangaController@random');
    Route::get('add-manga', 'MangaController@add_manga');
    Route::post('add-manga', 'MangaController@store_manga');
    Route::post('store_texts', 'MangaController@store_texts');
    Route::get('{cleanUrl}', 'MangaController@view_manga');
    Route::get('edit-manga/{manga_id}', 'MangaController@edit_manga');
    Route::post('edit-manga/{manga_id}', 'MangaController@update_manga');
    Route::get('add-chapter/{manga_id}', 'MangaController@add_chapter');
    Route::post('add-chapter/{manga_id}', 'MangaController@store_chapter');
    Route::get('edit-chapter/{manga_id}', 'MangaController@edit_chapter');
    Route::post('edit-chapter/{manga_id}', 'MangaController@update_chapter');
    Route::get('edit-images/{chapter_id}/{order}', 'MangaController@edit_images');
    Route::get('{cleanUrl}/chapter-{chapterNumber}', 'MangaController@view_chapter');
    Route::get('{cleanUrl}/chapter-{chapterNumber}/{limit}-{page}', 'MangaController@view_chapter');
});

Route::group(['prefix' => 'user'], function() {
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::get('logout', 'UserController@logout');
    Route::get('bookmarks', 'UserController@bookmarks');
    Route::post('remove_bookmark', 'UserController@remove_bookmark');
    Route::get('notifications', 'UserController@notifications');
    Route::get('edit-profile', 'UserController@get_edit_profile');
    Route::post('edit-profile', 'UserController@edit_profile');
    Route::get('profile/{username}', 'UserController@profile');
});

Route::group(['prefix' => 'team'], function() {
    Route::get('create-team', 'TeamController@get_create_team');
    Route::post('create-team', 'TeamController@create_team');
    Route::get('invite/{user_id}', 'TeamController@invite');
    Route::get('assign/{username}/{role_id}', 'TeamController@assign');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('messages', 'AdminController@get_messages');
    Route::get('users', 'AdminController@get_users');
});

Route::get('/', 'HomeController@index');
Route::get('about', 'AboutController@index');
Route::get('contact', 'ContactController@index');
Route::post('contact', 'ContactController@store_contact');
Route::post('notification/send_message', 'NotificationController@send_message');
Route::get('/about/test', 'AboutController@test');
