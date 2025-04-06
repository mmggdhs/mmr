<?php


use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




    Route::get('/', [UserController::class,'home']);
    Route::get('/login',['as'=>'login','uses'=>function () {
        return view('pages.login');
    }]);
    Route::post('/login',[UserController::class, 'login']);
    Route::get('/sign', function () {
        return view('pages.sign');
    });
    Route::post('/signin',[UserController::class, 'sign']);
    Route::get('/logout',[UserController::class, 'logout']);

    Route::get('/projects',[ProjectsController::class,'show']);
    Route::get('/project/{id}',[ProjectsController::class,'getproject']);

    Route::middleware('auth')->
    controller(ProjectsController::class)->
    group(function(){
        Route::get('/myprojects','showmyproject');
        Route::group(['prefix'=>'project','as'=>'project'],function(){
            Route::post('/add','addproject');
            Route::delete('/delete/{id}','deleteproject');
        });

    });






