<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

use App\Models\Image;
use Illuminate\Support\Facades\Auth;

Route::get('/puto', function () {

    //     $images = Image::all();
    //     foreach ($images as $image) {
    //         echo $image->image_path . "<br>";
    //         echo $image->description . "<br>";
    //         echo $image->user->name . "<hr>";

    //         if (count($image->comments) >= 1) {
    //             foreach ($image->comments as $comment) {
    //                 echo $comment->user->name . '' . $comment->user->surname . ': ';
    //                 echo $comment->content . "<br>";
    //             }

    //             echo 'Likes: ' . count($image->likes);
    //             echo "<hr>";
    //         }
    //     }
    //     die();
    return view('welcome');
});

// Rutas generales
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas de usuario
Route::get('/configuracion', [App\Http\Controllers\UserController::class, 'config'])->name('config');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.avatar');
Route::get('/perfil/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::get('/gente/{search?}', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');

// Rutas de imagenes
Route::get('/subir-imagen', [App\Http\Controllers\ImageController::class, 'create'])->name('image.create');
Route::post('/image/save', [App\Http\Controllers\ImageController::class, 'save'])->name('image.save');
Route::get('/image/file/{filename}', [App\Http\Controllers\ImageController::class, 'getImage'])->name('image.file');
Route::get('/image/{id}', [App\Http\Controllers\ImageController::class, 'detail'])->name('image.detail');
Route::get('/image/delete/{id}', [App\Http\Controllers\ImageController::class, 'delete'])->name('image.delete');
Route::get('/image/editar/{id}', [App\Http\Controllers\ImageController::class, 'edit'])->name('image.edit');
Route::post('/image/update/', [App\Http\Controllers\ImageController::class, 'update'])->name('image.update');

// Rutas de comentarios
Route::post('/comment/save', [App\Http\Controllers\CommentsController::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}', [App\Http\Controllers\CommentsController::class, 'delete'])->name('comment.delete');

// Rutas de likes
Route::get('/like/save/{image_id}', [App\Http\Controllers\LikeController::class, 'like'])->name('like.save');
Route::get('/dislike/save/{image_id}', [App\Http\Controllers\LikeController::class, 'dislike'])->name('like.delete');
Route::get('/likes', [App\Http\Controllers\LikeController::class, 'index'])->name('likes');
