<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;


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

Route::get('/', [UserController::class,'home'])->name('user#home');
Route::group(['prefix'=>'user'],function(){
    Route::get('/gradePage/{id}',[UserController::class,'gradePage'])->name('user#gradePage');
Route::get('/grade/{categoryId}/{gradeId}',[UserController::class,'grade'])->name('user#grade');
Route::get('/bookPage/{categoryId}/{gradeId}/{subjectId}',[UserController::class,'bookPage'])->name('user#book');
Route::get('/bookPage/view',[UserController::class,'viewCount'])->name('user#bookViewCount');
Route::get('/library',[UserController::class,'library'])->name('user#library');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Admin with LoginController
     Route::get('/home',[LoginController::class,'home'])->name('admin#home');
     //Admin Category with Admin Middleware
     Route::group(['prefix'=>'category','middleware'=>'admin_auth'],function(){
         Route::get('/list',[CategoryController::class,'list'])->name('category#list');
        Route::get('/createPage',[CategoryController::class,'createCategoryPage'])->name('category#createPage');
        Route::post('/create',[CategoryController::class,'createCategory'])->name('category#create');
        Route::get('/editPage/{id}',[CategoryController::class,'editCategoryPage'])->name('category#editPage');
        Route::post('/updateCategory',[CategoryController::class,'updateCategory'])->name('category#update');
        Route::get('/delete/{id}',[CategoryController::class,'deleteCategory'])->name('category#delete');
    });
    //Admin Grade with Admin Middleware
    Route::group(['prefix'=>'grade','middleware'=>'admin_auth'],function(){
        Route::get('/list',[GradeController::class,'list'])->name('grade#list');
        Route::get('/createPage',[GradeController::class,'createPage'])->name('grade#createPage');
        Route::post('/create',[GradeController::class,'createGrade'])->name('grade#create');
        Route::get('/editPage/{id}',[GradeController::class,'editPage'])->name('grade#editPage');
        Route::post('/updateGrade',[GradeController::class,'updateGrade'])->name('grade#update');
         Route::get('/delete/{id}',[GradeController::class,'deleteGrade'])->name('grade#delete');
    });
     //Admin Subject with Admin Middleware
     Route::group(['prefix'=>'subject','middleware'=>'admin_auth'],function(){
        Route::get('/list',[SubjectController::class,'list'])->name('subject#list');
        Route::get('/createPage',[SubjectController::class,'createPage'])->name('subject#createPage');
        Route::post('/create',[SubjectController::class,'createSubject'])->name('subject#create');
        Route::get('/editPage/{id}',[SubjectController::class,'editPage'])->name('subject#editPage');
        Route::post('/update',[SubjectController::class,'updateSubject'])->name('subject#update');
        Route::get('/delete/{id}',[SubjectController::class,'delete'])->name('subject#delete');
    });
     //Admin Product(Book) with Admin Middleware
     Route::group(['prefix'=>'product','middleware'=>"admin_auth"],function(){
        Route::get('/list',[ProductController::class,'list'])->name('product#list');
        Route::get('/createPage',[ProductController::class,'createPage'])->name('product#createPage');
        Route::post('/create',[ProductController::class,'createBook'])->name('product#create');
        Route::get('/delete/{id}',[ProductController::class,'deleteBook'])->name('product#delete');
    });
     //Admin Library with Admin Middleware
     Route::group(['prefix'=>'library','middleware'=>"admin_auth"],function(){
        Route::get('/list',[LibraryController::class,'list'])->name('library#list');
     });
});
//Login
Route::get('login',function(){
    return view('login');
})->name('login');