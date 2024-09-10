<?php

use App\Http\Controllers\Api\PostApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/signup',[PostApiController::class,'registerUser']);
Route::post('/login',[PostApiController::class,'loginUser']);


Route::middleware('auth:api')->group(function () {
    Route::get('/allpost', [PostApiController::class, 'getAllPost'])->middleware('can:view posts');
    Route::get('/getpost/{id}', [PostApiController::class, 'showPost'])->middleware('can:view posts');
    Route::put('/updatepost/{id}', [PostApiController::class, 'updatePost'])->middleware('can:update posts');
    Route::post('/createpost', [PostApiController::class, 'createPost'])->middleware('can:create posts');
    Route::delete('/deletepost/{id}', [PostApiController::class, 'deletePost'])->middleware('can:delete posts');
});


