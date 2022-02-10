<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;


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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home'); //home page
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat'); // chat page
    Route::get('/chats', [ChatController::class, 'getList'])->name('chatList'); //chat list page

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/user/{id}', [UserController::class, 'profile'])->name('user-profile');
    Route::post('/user/edit', [UserController::class, 'editProfile'])->name('edit-profile');

    Route::get('ajax/chat-messages', [ChatController::class, 'getMessages']);
    Route::post('ajax/chat-message', [ChatController::class, 'sendMessage']);
    Route::get('ajax/chat-get-new-messages', [ChatController::class, 'getNewMessage']);
    Route::get('ajax/chat-get-new-chats', [ChatController::class, 'getUnreadChats']);
    Route::get('ajax/chats', [ChatController::class, 'getChats']);
    Route::get('/ajax/users', [UserController::class, 'getList']);
});
