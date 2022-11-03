<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'Api','middleware' => ['json.response', 'cors']], function () {
    //header
    Route::get('get_header_content', 'HeaderAndFooterController@getHeaderContent');
    //client
    Route::get('get_client/{id}', 'ClientController@show');
    Route::get('get_clients', 'ClientController@index');
    //client_brief
    Route::get('get_client_brief', 'ClientBriefController@getClientBriefContent');

    //service_brief
    Route::get('get_service_brief', 'ServiceBriefController@getServiceBriefContent');

    //service
    Route::get('get_service/{id}', 'ServiceController@show');
    Route::get('get_services', 'ServiceController@index');

    //team_brief
    Route::get('get_team_brief', 'TeamBriefController@getTeamBriefContent');

    //team
    Route::get('get_team_member/{id}', 'TeamController@show');
    Route::get('get_team_members', 'TeamController@index');

    //contact_us
    Route::get('get_contact_us', 'ContactUsController@getContactUsContent');


    //fast_facts
    Route::get('get_fast_facts', 'FastFactController@getFastFactsContact');

    //about_us
    Route::get('get_about_us', 'FastFactController@getAboutUsContact');

    //cateogires
    Route::get('get_category/{id}', 'CategoryController@show');
    Route::get('get_categories', 'CategoryController@index');
 
   
    //projects
    Route::get('get_project/{id}', 'ProjectController@show');
    Route::get('get_projects', 'ProjectController@index');
    Route::get('get_projects_category/{category_id?}', 'ProjectController@getProjectsByCategory');

   

    Route::group(['prefix' => 'admin'], function () {
        Route::post('login', 'AdminController@login');

        Route::group(['middleware' => 'auth:admin-api'], function () {

            Route::get('logout', 'AdminController@logout');

            //header_and_footer
            Route::post('create_header_content', 'HeaderAndFooterController@update');
            Route::post('upload_logo', 'HeaderAndFooterController@uploadLogo');

            //client
            Route::post('create_client', 'ClientController@create');
            Route::put('update_client/{id}', 'ClientController@update');
            Route::delete('delete_client/{id}', 'ClientController@destory');

            //client_brief
            Route::post('create_client_brief', 'ClientBriefController@update');

            //service_brief
            Route::post('create_service_brief', 'ServiceBriefController@update');
           
            //service
            Route::post('create_service', 'ServiceController@create');
            Route::put('update_service/{id}', 'ServiceController@update');
            Route::delete('delete_service/{id}', 'ServiceController@destory');


            //team_brief
            Route::post('create_team_brief', 'TeamBriefController@update');

            //team
            Route::post('create_team_member', 'TeamController@create');
            Route::put('update_team_member/{id}', 'TeamController@update');
            Route::delete('delete_team_member/{id}', 'TeamController@destory');


            //contact_us
            Route::post('create_contact_us', 'ContactUsController@update');

            //fast_fact
            Route::post('create_fast_facts', 'FastFactController@update');
            Route::post('uploads_fast_facts_video_ar', 'FastFactController@uploads_fast_facts_video_ar');
            Route::post('uploads_fast_facts_video_en', 'FastFactController@uploads_fast_facts_video_en');

            //about_us
            Route::post('create_about_us', 'FastFactController@updateAboutUs');

            //category
            Route::post('create_category', 'CategoryController@create');
            Route::put('update_category/{id}', 'CategoryController@update');
            Route::delete('delete_category/{id}', 'CategoryController@destory');


            //project
            Route::post('create_project', 'ProjectController@create');
            Route::put('update_project/{id}', 'ProjectController@update');
            Route::delete('delete_project/{id}', 'ProjectController@destory');
            Route::delete('delete_project_image/{id}','ProjectController@destoryProjectImage');
            Route::post('upload_project_images', 'ProjectController@uploadProjectImages');
            



        });

    });
});


