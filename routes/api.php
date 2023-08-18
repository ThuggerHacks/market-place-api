<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;


Route::controller(UserController::class)->group(function(){
    Route::get("/user","index");
    Route::get("/user/{id?}","getOne");
    Route::post("/user","signUp");
    Route::post("/login","login");
    Route::delete("/user/{id?}","deleteOne");
    Route::put("/user/{id?}","updateOne");
});

Route::controller(ProductController::class)->group(function(){
    Route::get("/product","index");
    Route::get("/product/{id?}","getOne");
    Route::get("/product/user/{id}","getByUserId");
    Route::post("/product","addProduct");
    Route::put("/product/{id?}","updateProduct");
    Route::delete("/product/{id?}","deleteOne");
});

Route::controller(ViewController::class)->group(function(){
    Route::get("/view/{product_id?}","getByProductId");
    Route::get("/view/all","getByProductId");
    Route::post("/view","addView");
});

Route::controller(PhotoController::class)->group(function(){
    Route::get("/photo/{product_id?}","getByProductId");
    Route::post("/photo","addPhotoOnProduct");
    Route::post("/upload","uploadPhoto");
    Route::delete("/photo/{id?}","deleteOne");
});


Route::controller(RatingController::class)->group(function(){
    Route::get("/rating/{user_id?}","getByUserId");
    Route::post("/rating","addRating");
    Route::delete("/rating/{id?}","deleteOne");
    Route::put("/rating/{id?}","updateOne");
});

Route::controller(ChatController::class)->group(function(){
    Route::get("/chat","index");
    Route::get("/chat/{id}","getOne");
    Route::get("/chat/list/{product_id}","getChatByProductId");
    Route::get("/chat/{product_id}/{receiver_id}/{sender_id}","getChatsByAll");
    Route::post("/chat","addChat");
    Route::delete("/chat/{id}","deleteChat");
});

Route::controller(MessageController::class)->group(function(){
    Route::get("/message/{id?}","getOne");
    Route::get("/message/chat/{chat_id?}","getByChatId");
    Route::post("/message","index");
    Route::delete("/message/{id?}","deleteOne");
});