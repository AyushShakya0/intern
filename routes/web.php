<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Facade;
use App\Http\Controllers\AjaxController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatagoryController;
use Illuminate\Routing\Controllers\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::prefix('catagory')->group(function () {
        Route::get('/', [CatagoryController::class, 'index'])->name('catagory');
        Route::get('/create', [CatagoryController::class, 'showcreate'])->name('catagory.index')->middleware('can:view posts');
        Route::post('/create', [CatagoryController::class, 'create'])->name('catagory.create')->middleware('can:create posts');
        Route::delete('/delete/{id}', [CatagoryController::class, 'delete'])->name('catagory.delete')->middleware('can:delete posts');
        Route::get('/update/{id}', [CatagoryController::class, 'update'])->name('catagory.update')->middleware('can:update posts');
        Route::put('/update_data/{id}', [CatagoryController::class, 'updatedata'])->name('catagory.update_data');
    });

    Route::resource('post', PostController::class);

});




Route::get('/email', function () {
    Mail::raw('This is a test email sent using Mailpit!', function ($message) {
        $message->to('maharjansohail222@gmail.com')
            ->subject('Test Email');
    });

    return 'Test email sent!';
});

Route::get('/jquery_practice', function () {
    return view('practice.jquery_practice');
});
Route::get('/ajaxtest', [AjaxController::class, 'testajax']);
Route::get('/ajaxtest_show', [AjaxController::class, 'testajax_show'])->name('ajax.test');



//assign roles
Route::post('/assign-role/{userId}', [UserController::class, 'assignRole']);
