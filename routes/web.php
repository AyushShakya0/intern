<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Facade;

use Illuminate\Support\Facades\Mail;

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
Route::prefix('catagory')->group(function (){
    Route::get('/', [CatagoryController::class, 'index'])->name('catagory')->middleware(Authenticate::class);
    Route::get('/create',[CatagoryController::class,'showcreate'])->name('catagory.index')->middleware(Authenticate::class);
    Route::post('/create',[CatagoryController::class,'create'])->name('catagory.create')->middleware(Authenticate::class);
    Route::delete('/delete/{id}',[CatagoryController::class,'delete'])->name('catagory.delete')->middleware(Authenticate::class);
    Route::get('/update/{id}',[CatagoryController::class,'update'])->name('catagory.update')->middleware(Authenticate::class);
    Route::put('/update_data/{id}',[CatagoryController::class,'updatedata'])->name('catagory.update_data')->middleware(Authenticate::class);
});

Route::resource('post',PostController::class)->middleware(Authenticate::class);


Route::get('/email', function () {
    Mail::raw('This is a test email sent using Mailpit!', function ($message) {
        $message->to('maharjansohail222@gmail.com')
                ->subject('Test Email');
    });

    return 'Test email sent!';
});

Route::get('/jquery_practice',function (){
return view('practice.jquery_practice');
});
Route::get('/ajaxtest',[AjaxController::class,'testajax']);
Route::get('/ajaxtest_show',[AjaxController::class,'testajax_show'])->name('ajax.test');