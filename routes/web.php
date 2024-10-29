<?php

use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AllegroController;


//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('allegro-req');
});
Route::post('/send-product-offer', [AllegroController::class, 'sendProductOffer']);
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');



Route::get('/allegro/token', [AllegroController::class, 'getToken']);

