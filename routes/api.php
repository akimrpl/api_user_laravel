<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

Route::apiResource('members', MemberController::class);
Route::middleware('log.request')->apiResource('members', MemberController::class);