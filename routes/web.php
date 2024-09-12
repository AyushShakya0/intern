<?php

use App\Http\Controllers\RolesAndPermissionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Facade;
use App\Http\Controllers\AjaxController;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Database\Seeders\RolesAndPermissionsSeeder;
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
        Route::get('/', [CatagoryController::class, 'index'])->name('catagory')->middleware('permission:view_posts');
        Route::get('/create', [CatagoryController::class, 'showcreate'])->name('catagory.index')->middleware('permission:create_posts');
        Route::post('/create', [CatagoryController::class, 'create'])->name('catagory.create')->middleware('permission:create_posts');
        Route::delete('/delete/{id}', [CatagoryController::class, 'delete'])->name('catagory.delete')->middleware('permission:delete_posts');
        Route::get('/update/{id}', [CatagoryController::class, 'update'])->name('catagory.update')->middleware('permission:update_posts');
        Route::put('/update_data/{id}', [CatagoryController::class, 'updatedata'])->name('catagory.update_data')->middleware('permission:update_posts');
    });

    // Route::resource('post', PostController::class);
    // Routes for PostController with permissions middleware
    Route::prefix('post')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('post.index')->middleware('permission:view_posts');
        Route::get('/create', [PostController::class, 'create'])->name('post.create')->middleware('permission:create_posts');
        Route::post('/create', [PostController::class, 'store'])->name('post.store')->middleware('permission:create_posts');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit')->middleware('permission:update_posts');
        Route::put('/update/{id}', [PostController::class, 'update'])->name('post.update')->middleware('permission:update_posts');
        Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('post.destroy')->middleware('permission:delete_posts');
    });





});


Route::resource('rolesandpermission', RolesAndPermissionController::class);
Route::resource('permission', PermissionController::class);
Route::resource('role', RoleController::class);


Route::post('assign-role', [RolesAndPermissionController::class, 'assignRole'])->name('assign.role');
Route::post('assign-permission', [RolesAndPermissionController::class, 'assignPermission'])->name('assign.permission');





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
