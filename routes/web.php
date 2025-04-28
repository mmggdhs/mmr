<?php


use App\Http\Controllers\Controller;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

    Route::get('/', [UserController::class,'home']);
    Route::put('/profile/update', action: [UserController::class, 'update'])->name('profile.update');

    Route::get('/login',['as'=>'login','uses'=>function () {
        return view('pages.login');
    }]);
    Route::post('/login',[UserController::class, 'login']);
    Route::get('/sign', function () {
        return view('pages.sign');
    });
    Route::post('/signin',[UserController::class, 'sign']);
    Route::get('/logout',[UserController::class, 'logout']);

    // التحققق من الإيميل
    Route::middleware('auth')->controller(UserController::class)->
    group(function(){
        Route::get('/email/verify',function(){
            return view('auth.verifyemail');
        })->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}',function(EmailVerificationRequest $request){
            $request->fulfill();
            return redirect('/');
        })->middleware(['signed'])->name('verification.verify');
        Route::post('/email/verify/resend',function(Request $request){
            $request->user()->sendEmailVerificationNotification();

            return back()->with('message','Verification link sent');
        })->middleware('throttle:6,1')->name('verification.send');
    });

    // الروابط الخاصة بالمشروع
    Route::get('/projects',[ProjectsController::class,'show']);
    Route::get('/project/{id}',[ProjectsController::class,'getproject']);
    Route::get('/project/download/{name}',[ProjectsController::class,'downloadproject']);
    Route::get('projects/search',[ProjectsController::class,'search']);
    Route::middleware('auth')->
    controller(ProjectsController::class)->
    group(function(){
            Route::get('/myprojects','showmyproject');
            Route::group(['prefix'=>'project','as'=>'project'],function(){
            Route::post('/add','addproject');
            Route::delete('/delete/{id}','deleteproject');
            Route::post('/update/{id}','updateproject');
        });

    });

    // الروابط الإبلاغ
    Route::middleware('auth')->
    controller(ReportsController::class)->
    group(function(){
        Route::post('/reports/add','addreport');
    });






