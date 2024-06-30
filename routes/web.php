<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\EntryController;
use App\Http\Controllers\admin\FrameController;
use App\Http\Controllers\admin\GiftController;
use App\Http\Controllers\admin\LikeController;
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::prefix('admin')->group(function(){

    Route::get('/users' , [UserController::class , 'listUsers'])->name('admin.users.list');
    Route::get('/users/add' , [UserController::class , 'addUser'])->name('admin.users.add');
    Route::post('/users/create' , [UserController::class , 'createNewUser'])->name('admin.users.create');
    Route::post('/users/delete/{id}' , [UserController::class , 'deleteUser'])->name('admin.users.delete');
    Route::get('/users/edit/{id}' , [UserController::class , 'editUser'])->name('admin.users.edit');
    Route::post('/users/update/{id}' , [UserController::class , 'updateUser'])->name('admin.users.update');
    Route::get('/users/gifts/' , [UserController::class , 'listAllGifts'])->name('admin.users.gifts');


    Route::get('/rooms' , [RoomController::class , 'listRooms'])->name('admin.rooms.list');
    Route::get('/rooms/add' , [RoomController::class , 'addRoom'])->name('admin.rooms.add');
    Route::post('/rooms/create' , [RoomController::class , 'createNewRoom'])->name('admin.rooms.create');
    Route::post('/rooms/delete/{id}' , [RoomController::class , 'deleteRoom'])->name('admin.rooms.delete');
    Route::get('/rooms/edit/{id}' , [RoomController::class , 'editRoom'])->name('admin.rooms.edit');
    Route::post('/rooms/update/{id}' , [RoomController::class , 'updateRoom'])->name('admin.rooms.update');

    Route::get('/categories' , [CategoryController::class , 'listCategories'])->name('admin.categories.list');
    Route::get('/categories/add' , [CategoryController::class , 'addCategory'])->name('admin.categories.add');
    Route::post('/categories/create' , [CategoryController::class , 'createNewCategory'])->name('admin.categories.create');
    Route::post('/categories/delete/{id}' , [CategoryController::class , 'deleteCategory'])->name('admin.categories.delete');
    Route::get('/categories/edit/{id}' , [CategoryController::class , 'editCategory'])->name('admin.categories.edit');
    Route::post('/categories/update/{id}' , [CategoryController::class , 'updateCategory'])->name('admin.categories.update');

    Route::get('/posts' , [PostController::class , 'listPosts'])->name('admin.posts.list');
    Route::get('/posts/add' , [PostController::class , 'addPost'])->name('admin.posts.add');
    Route::post('/posts/create' , [PostController::class , 'createNewPost'])->name('admin.posts.create');
    Route::post('/posts/delete/{id}' , [PostController::class , 'deletePost'])->name('admin.posts.delete');
    Route::get('/posts/edit/{id}' , [PostController::class , 'editPost'])->name('admin.posts.edit');
    Route::post('/posts/update/{id}' , [PostController::class , 'updatePost'])->name('admin.posts.update');

    Route::get('/comments' , [CommentController::class , 'listComments'])->name('admin.comments.list');
    Route::get('/comments/add' , [CommentController::class , 'addComment'])->name('admin.comments.add');
    Route::post('/comments/create' , [CommentController::class , 'createNewComment'])->name('admin.comments.create');
    Route::post('/comments/delete/{id}' , [CommentController::class , 'deleteComment'])->name('admin.comments.delete');
    Route::get('/comments/edit/{id}' , [CommentController::class , 'editComment'])->name('admin.comments.edit');
    Route::post('/comments/update/{id}' , [CommentController::class , 'updateComment'])->name('admin.comments.update');

    Route::get('/likes' , [LikeController::class , 'listLikes'])->name('admin.likes.list');
    Route::get('/likes/add' , [LikeController::class , 'addLike'])->name('admin.likes.add');
    Route::post('/likes/create' , [LikeController::class , 'createNewLike'])->name('admin.likes.create');
    Route::post('/likes/delete/{id}' , [LikeController::class , 'deleteLike'])->name('admin.likes.delete');
    Route::get('/likes/edit/{id}' , [LikeController::class , 'editLike'])->name('admin.likes.edit');
    Route::post('/likes/update/{id}' , [LikeController::class , 'updateLike'])->name('admin.likes.update');

    Route::get('/countries' , [CountryController::class , 'listCountries'])->name('admin.countries.list');
    Route::get('/countries/add' , [CountryController::class , 'addCountry'])->name('admin.countries.add');
    Route::post('/countries/create' , [CountryController::class , 'createNewCountry'])->name('admin.countries.create');
    Route::post('/countries/delete/{id}' , [CountryController::class , 'deleteCountry'])->name('admin.countries.delete');
    Route::get('/countries/edit/{id}' , [CountryController::class , 'editCountry'])->name('admin.countries.edit');
    Route::post('/countries/update/{id}' , [CountryController::class , 'updateCountry'])->name('admin.countries.update');

    Route::get('/gifts' , [GiftController::class , 'listGifts'])->name('admin.gifts.list');
    Route::get('/gifts/add' , [GiftController::class , 'addGift'])->name('admin.gifts.add');
    Route::post('/gifts/create' , [GiftController::class , 'createNewGift'])->name('admin.gifts.create');
    Route::post('/gifts/delete/{id}' , [GiftController::class , 'deleteGift'])->name('admin.gifts.delete');
    Route::get('/gifts/edit/{id}' , [GiftController::class , 'editGift'])->name('admin.gifts.edit');
    Route::post('/gifts/update/{id}' , [GiftController::class , 'updateGift'])->name('admin.gifts.update');

    Route::get('/frames' , [FrameController::class , 'listFrames'])->name('admin.frames.list');
    Route::get('/frames/add' , [FrameController::class , 'addFrame'])->name('admin.frames.add');
    Route::post('/frames/create' , [FrameController::class , 'createNewFrame'])->name('admin.frames.create');
    Route::post('/frames/delete/{id}' , [FrameController::class , 'deleteFrame'])->name('admin.frames.delete');
    Route::get('/frames/edit/{id}' , [FrameController::class , 'editFrame'])->name('admin.frames.edit');
    Route::post('/frames/update/{id}' , [FrameController::class , 'updateFrame'])->name('admin.frames.update');

    Route::get('/entries' , [EntryController::class , 'listEntries'])->name('admin.entries.list');
    Route::get('/entries/add' , [EntryController::class , 'addEntry'])->name('admin.entries.add');
    Route::post('/entries/create' , [EntryController::class , 'createNewEntry'])->name('admin.entries.create');
    Route::post('/entries/delete/{id}' , [EntryController::class , 'deleteEntry'])->name('admin.entries.delete');
    Route::get('/entries/edit/{id}' , [EntryController::class , 'editEntry'])->name('admin.entries.edit');
    Route::post('/entries/update/{id}' , [EntryController::class , 'updateEntry'])->name('admin.entries.update');
});





Route::get('/backend' , function(){
    return view('layouts.backend.theme');
});





Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
