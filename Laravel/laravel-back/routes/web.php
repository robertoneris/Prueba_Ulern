<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(["error"=>"inicie sesion"],response::HTTP_UNAUTHORIZED);
})->name("login");
