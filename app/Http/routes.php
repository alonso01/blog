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

//Route::get('/',['as' => 'home', 'uses' => 'PostController@index']);

//Route::get('/home',['as' => 'home', 'uses' => 'PostController@index']);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => ['auth']], function()
{

    Route::controller('/filemanager','FilemanagerController');    

    Route::get('/',['as' => 'home', 'uses' => 'PostController@index']);

    Route::get('/home/{s?}',['as' => 'home', 'uses' => 'PostController@index']);

    Route::get('/postsByCompany/{post_cat?}', 'PostController@postsByCompany');
    
    //users profile
    Route::get('user/{id}','UserController@profile')->where('id', '[0-9]+');

    // display list of posts
    Route::get('user/{id}/posts','UserController@user_posts')->where('id', '[0-9]+');

    // display single post
    Route::get('/{slug}',['as' => 'post', 'uses' => 'PostController@show'])->where('slug', '[A-Za-z0-9-_]+');

    // show new post form
    Route::get('/post/new','PostController@create');

    // save new post
    Route::post('/post/new','PostController@store');

    // edit post form
    Route::get('edit/{slug}','PostController@edit');

    // update post
    Route::post('update','PostController@update');

    // delete post
    Route::get('delete/{id}','PostController@destroy');


    // show list companies
    Route::get('/companies/list','CompaniesController@index');
    
    // show new post companies
    Route::get('/companies/new','CompaniesController@create');
    
    // save new company
    Route::post('/companies/new','CompaniesController@store');

    // edit company view
    Route::get('/companies/edit/{id}','CompaniesController@edit');

    // update company
    Route::post('/companies/update','CompaniesController@update');
    
    // display user's all posts
    Route::get('my-all-posts','UserController@user_posts_all');

    // display user's drafts
    Route::get('my-drafts','UserController@user_posts_draft');

    // add comment
    Route::post('comment/add','CommentController@store');

    // delete comment
    Route::post('comment/delete/{id}','CommentController@distroy');


});


