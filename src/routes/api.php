<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Quote;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ApiAuthController;

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
//     if ($data) {
//         return response()->json($data);
//     } else {
//         return response()->json(["message" => "Quote not found"], 404);
//     }
// });

// Route::get('/quote/{id}', [QuoteController::class, 'show']);
// Route::get('/quoter', [QuoteController::class, 'index']);
// Route::put('/updateQuote/{id}', [QuoteController::class, 'update']);
Route::apiResource('/quote', QuoteController::class);

// route middleware for authenticated user
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/quote', QuoteController::class);
    // Route::post('/logout', ApiAuthController::class, 'logout');
});

Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);
