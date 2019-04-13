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
/* Route with functions (not recommended) but we can use it in redirect or home page */

Route::get('/accounteq/{id}/delete', 'AccountEQController@destroy');
Route::get('/accounteq/paging', 'AccountEQController@paging');
Route::get('/accounteq/searchpaging', 'AccountEQController@searchpaging');
Route::get('/accounteq/searchpaging2', 'AccountEQController@searchpaging2');
Route::get('/accounteq/search', 'AccountEQController@search');
Route::resource('accounteq', 'AccountEQController');

Route::get('/login', function () {
    return view('auth.login');
});

Route::post("/signupclient","HomeController@signupclient");

Route::get("/newregister","HomeController@register");
Route::post("/newregister","HomeController@signupclient");
Route::resource('cms/comment', 'CMS\Client\CommentsController');
//Route::middleware(['auth', 'ClientRole'])->post('cms/comment/{id}/addnaw', 'HomeController@addnaw');

Route::get("/cms/comment/{id}/all","CMS\Client\ArticleController@allComments");
Route::get("/cms/comment/all/{id}","CMS\AllAdminCommentsController@allComments");
//Route::middleware(['auth', 'ClientRole'])->post("/cms/comment/{id}/addtoall","HomeController@addnaw");
Route::post("/cms/comment/{id}/addtoall","CMS\Client\CommentsController@addnaw");

Route::get("/cms/comment/active/{id}","CMS\ArticleController@active");

Route::get('cms/home/noaccess', 'CMS\HomeController@noaccess');
Route::get('cms/home/changepassword', 'CMS\HomeController@changepassword');
Route::post('cms/home/postChangepassword', 'CMS\HomeController@postChangepassword');
Route::resource('cms/home', 'CMS\HomeController');

Route::get('/cms/article/{id}/delete', 'CMS\ArticleController@destroy');
Route::get('/cms/comment/{id}/delete', 'CMS\Client\CommentsController@destroy');
Route::resource('cms/article', 'CMS\ArticleController');

Route::get('/cms/category/{id}/delete', 'CMS\CategoryController@destroy');
Route::resource('cms/category', 'CMS\CategoryController');





Route::get('/client/changepassword', 'CMS\Client\HomeController@changepassword');
Route::post('/client/postChangepassword', 'CMS\Client\HomeController@postChangepassword');
    

Route::get('/cms/breakingnews/{id}/delete', 'CMS\BreakingNewsController@destroy');
Route::resource('cms/breakingnews', 'CMS\BreakingNewsController');


Route::get('/cms/slider/{id}/delete', 'CMS\SliderController@destroy');
Route::get('/cms/admin/{id}/delete', 'CMS\AdminController@destroy');
Route::get('/cms/admin/{id}/permission', 'CMS\AdminController@permission');
Route::post('/cms/admin/{id}/setpermission', 'CMS\AdminController@setpermission');
Route::resource('cms/admin', 'CMS\AdminController');

Route::resource('cms/slider', 'CMS\SliderController');

Route::get('/cms/clients/active/{id}', 'CMS\ClientsController@active');
Route::get('/cms/clients/{id}/delete', 'CMS\ClientsController@destroy');
Route::get('/cms/clients', 'CMS\ClientsController@index');


Route::get('/cms/menu/{id}', 'CMS\MenuController@index');
Route::get('/cms/menu/create/{id}', 'CMS\MenuController@create');
Route::get('/cms/menu/{id}/delete', 'CMS\MenuController@destroy');
Route::get('/cms/page/{id}/delete', 'CMS\PageController@destroy');
Route::resource('cms/menu', 'CMS\MenuController');

Route::resource('cms/page', 'CMS\PageController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/', 'FrontEndController@index');
Route::get('/articles', 'FrontEndController@articles');
Route::get('/article/{id}', 'FrontEndController@article');
Route::get('/page/{id}', 'FrontEndController@page');