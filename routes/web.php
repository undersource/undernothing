<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\XMPPController;


Route::get('/login', [LoginController::class, 'form'])->name('login');
Route::post('/login/auth', [LoginController::class, 'authenticate'])->name('auth');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/blog', [BlogController::class, 'show'])->name('blog');
Route::get('/article/add', [BlogController::class, 'addForm'])->name('articleAddForm');
Route::post('/article/add/post', [BlogController::class, 'add'])->name('articleAdd');
Route::get('/article/export', [BlogController::class, 'export'])->name('articleExport');
Route::get('/article/del', [BlogController::class, 'del'])->name('articleDel');
Route::get('/article/{id}', [BlogController::class, 'article'])->name('article');
Route::get('/library', [LibraryController::class, 'index'])->name('libraryIndex');
Route::get('/gallery', [GalleryController::class, 'gallery'])->name('gallery');


Route::get('/email', [EmailController::class, 'index'])->name('emailIndex');
Route::get('/email/register', [EmailController::class, 'registerForm'])->name('emailRegisterForm');
Route::get('/email/password', [EmailController::class, 'passwordForm'])->name('emailPasswordForm');
Route::get('/email/unregister', [EmailController::class, 'unregisterForm'])->name('emailUnregisterForm');
Route::post('/email/register/post', [EmailController::class, 'register'])->name('emailRegister');
Route::post('/email/password/post', [EmailController::class, 'password'])->name('emailPassword');
Route::post('/email/unregister/post', [EmailController::class, 'unregister'])->name('emailUnregister');

Route::get('/xmpp', [XMPPController::class, 'index'])->name('xmppIndex');
Route::get('/xmpp/register', [XMPPController::class, 'registerForm'])->name('xmppRegisterForm');
Route::get('/xmpp/password', [XMPPController::class, 'passwordForm'])->name('xmppPasswordForm');
Route::get('/xmpp/unregister', [XMPPController::class, 'unregisterForm'])->name('xmppUnregisterForm');
Route::post('/xmpp/register/post', [XMPPController::class, 'register'])->name('xmppRegister');
Route::post('/xmpp/password/post', [XMPPController::class, 'password'])->name('xmppPassword');
Route::post('/xmpp/unregister/post', [XMPPController::class, 'unregister'])->name('xmppUnregister');

Route::view('mumble', 'mumble', ['title' => 'MUMBLE'])->name('mumbleIndex');
