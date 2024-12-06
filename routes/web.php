<?php

use App\Http\Controllers\FullChatController;
use App\Http\Controllers\GroupMessageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserStatusController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\Configuration\GroupCollection;

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

Route::post('/messages/send', [MessageController::class, 'send']);
Route::get('/userlist',[MessageController::class , 'userlist'])->name('userlist');
Route::get('/sending/{receiverId}',[MessageController::class,'create'])->name('sending');
route::post('/groupmessages/send',[GroupMessageController::class,'send']);
Route::get('/groupslist',[GroupMessageController::class,'groupslist'])->name('grouplist');
Route::get('/groupsending/{groupId}',[GroupMessageController::class,'create'])->name('sendinggroup');
Route::post('/createagroupchat',[GroupMessageController::class,'createagroup'])->name('createagroupchat');
Route::get('/fullchat',[FullChatController::class,'fullchat'])->name('fullchatroute');
Route::get('/fetch-messages/{receiverId}', [FullChatController::class, 'fetchMessages']);
Route::get('/fetch-messages-group/{groupId}', [FullChatController::class, 'fetchMessagesgroup']);




Route::post('/heartbeat', [UserStatusController::class, 'heartbeat']);
Route::get('/get-online-users', [UserStatusController::class, 'getOnlineUsers']);




require __DIR__.'/auth.php';
