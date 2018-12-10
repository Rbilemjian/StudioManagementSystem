<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'auth'], function ($router) {

    Route::post('signup', 'AuthController@signUp');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
});

Route::group(['middleware' => 'JWT'], function ($router) {

    Route::get('/payments', 'PaymentController@getAllPayments');
    Route::get('/payments/{id}', 'PaymentController@getPayment');
    Route::get('/postcomments/{id}', 'CommentController@getPostCommentsJSON');

    Route::post('/createpayment', 'PaymentController@createPayment');
    Route::post('/createcomment', 'CommentController@createComment');

    Route::post('/deletecomment/{id}', 'CommentController@deleteComment');
    Route::post('/deletepayment/{id}', 'PaymentController@deletePayment');
});
