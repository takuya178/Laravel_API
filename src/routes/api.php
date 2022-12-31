<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Quote;
use App\Http\Controllers\QuoteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hello', function() {
    $data = ["message" => "Hello World"];
    return response()->json($data);
});

// Route::get('/quote/{id}', function ($id) {
//     $data = Quote::find($id);
//     return response()->json($data);
// });

Route::get('/quote/{id}', [QuoteController::class, 'show']);
