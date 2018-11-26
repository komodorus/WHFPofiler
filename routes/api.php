<?php

use App\User;
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

Route::get('/profiles', function(){
    // return datatables(User::select('*')->get());
    return datatables(User::select('name', 'email', 'birthday', 'cpf', 'active')->get());
});