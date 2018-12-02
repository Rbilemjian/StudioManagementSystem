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
    Route::post('refresh', 'AuthController@refresh');
    Route::post('self', 'AuthController@self');
});

Route::get('/payments', 'PaymentController@getAllPayments');
Route::get('/comments', 'CommentController@getAllComments');
Route::get('/paymentsandcomments', 'PaymentController@getAllPaymentsAndComments');

Route::post('/createcomment', 'CommentController@createComment');
Route::post('/deletecomment', 'CommentController@deleteComment');

Route::post('/createpayment', 'PaymentController@createPayment');
Route::post('/deletepayment', 'PaymentController@deletePayment');

Route::put('/editcomment', 'CommentController@editComment');
Route::put('/editpayment', 'PaymentController@editPayment');
