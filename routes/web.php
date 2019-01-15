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

Route::get('/', 'LandingController@index')->name('home')->middleware('auth');
Route::get('/details', 'DetailsController@index')->name('details');

Route::group(['prefix'=>'backend', 'middleware' => ['auth','is_admin']], function() {
	Route::get('/', 'Backend\BackendController@index')->name('backend:home');
	Route::resource('/sns', 'Backend\SnsController')->names([
        'index' => 'backend:sns',
        'store' =>'backend:sns:store',
        'edit' =>'backend:sns:edit',
        'update' => 'backend:sns:update',
        'destroy' => 'backend:sns:destroy'
    ]);

    Route::resource('/education', 'Backend\EducationController')->names([
        'index' => 'backend:educations',
        'create' => 'backend:education:create',
        'store' =>'backend:education:store',
        'edit' =>'backend:education:edit',
        'update' => 'backend:education:update',
        'destroy' => 'backend:education:destroy'
    ]);

    Route::resource('/research', 'Backend\ResearchController')->names([
        'index' => 'backend:researches',
        'create' => 'backend:research:create',
        'store' =>'backend:research:store',
        'edit' =>'backend:research:edit',
        'update' => 'backend:research:update',
        'destroy' => 'backend:research:destroy'
    ]);

    Route::resource('/project', 'Backend\ProjectController')->names([
        'index' => 'backend:projects',
        'create' => 'backend:project:create',
        'store' =>'backend:project:store',
        'edit' =>'backend:project:edit',
        'update' => 'backend:project:update',
        'destroy' => 'backend:project:destroy'
    ]);

    Route::resource('/publication', 'Backend\PublicationController')->names([
        'index' => 'backend:publications',
        'create' => 'backend:publication:create',
        'store' =>'backend:publication:store',
        'edit' =>'backend:publication:edit',
        'update' => 'backend:publication:update',
        'destroy' => 'backend:publication:destroy'
    ]);

    Route::resource('/award', 'Backend\AwardController')->names([
        'index' => 'backend:awards',
        'create' => 'backend:award:create',
        'store' =>'backend:award:store',
        'edit' =>'backend:award:edit',
        'update' => 'backend:award:update',
        'destroy' => 'backend:award:destroy'
    ]);

    Route::resource('/researcher', 'Backend\ResearcherController')->names([
        'index' => 'backend:researchers',
        'create' => 'backend:researcher:create',
        'store' =>'backend:researcher:store',
        'edit' =>'backend:researcher:edit',
        'update' => 'backend:researcher:update',
        'destroy' => 'backend:researcher:destroy'
    ]);

    Route::resource('/collaborator', 'Backend\CollaboratorController')->names([
        'index' => 'backend:collaborators',
        'create' => 'backend:collaborator:create',
        'store' =>'backend:collaborator:store',
        'edit' =>'backend:collaborator:edit',
        'update' => 'backend:collaborator:update',
        'destroy' => 'backend:collaborator:destroy'
    ]);

    Route::resource('/funding', 'Backend\FundingController')->names([
        'index' => 'backend:fundings',
        'create' => 'backend:funding:create',
        'store' =>'backend:funding:store',
        'edit' =>'backend:funding:edit',
        'update' => 'backend:funding:update',
        'destroy' => 'backend:funding:destroy'
    ]);

    Route::resource('/user', 'Backend\UserController')->names([
        'index' => 'backend:users',
        'store' =>'backend:user:store',
        'edit' =>'backend:user:edit',
        'update' => 'backend:user:update',
        'destroy' => 'backend:user:destroy'
    ]);

    Route::resource('/gallery', 'Backend\GalleryController')->names([
        'index' => 'backend:galleries',
        'create' => 'backend:gallery:create',
        'store' =>'backend:gallery:store',
        'edit' =>'backend:gallery:edit',
        'update' => 'backend:gallery:update',
        'destroy' => 'backend:gallery:destroy'
    ]);

    Route::resource('/blog', 'Backend\BlogController')->names([
        'index' => 'backend:blogs',
        'create' => 'backend:blog:create',
        'store' =>'backend:blog:store',
        'edit' =>'backend:blog:edit',
        'update' => 'backend:blog:update',
        'destroy' => 'backend:blog:destroy'
    ]);
});


Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
