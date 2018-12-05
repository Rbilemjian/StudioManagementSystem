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

Route::group(['middleware' => 'JWT'], function ($router) {

    Route::get('/payments', 'PaymentController@getAllPayments');
    Route::get('/payments/{id}', 'PaymentController@getPayment');
    Route::get('/postcomments/{id}', 'CommentController@getPostCommentsJSON');
    Route::get('/paymentandcomments/{id}', 'PaymentController@getPaymentAndComments');

    Route::post('/createpayment', 'PaymentController@createPayment');
    Route::post('/createcomment', 'CommentController@createComment');
    Route::post('/deletecomment/{id}', 'CommentController@deleteComment');


});


Route::get('/comments', 'CommentController@getAllComments');


Route::post('/deletepayment', 'PaymentController@deletePayment');

Route::put('/editcomment', 'CommentController@editComment');
Route::put('/editpayment', 'PaymentController@editPayment');
