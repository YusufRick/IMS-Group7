<?php

use App\Http\Controllers\Api\BranchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('branches')->group(function () {
    Route::get('/', [BranchController::class, 'index']);
    Route::get('{branch}', [BranchController::class, 'show']);
    Route::get('{branch}/products', [BranchController::class, 'getProducts']);
    Route::get('{branch}/users', [BranchController::class, 'getUsers']);
    
    Route::get('{branch}/sales', [BranchController::class, 'getSales']);
    Route::get('{branch}/sales/{sale}', [BranchController::class, 'getSale']);
    Route::get('{branch}/users/{user}/sales', [BranchController::class, 'getUserSales']);
});

// Bypass auth:api specifically for this route
Route::post('branches/{branch}/sales/{userId}', [BranchController::class, 'storeSale'])->withoutMiddleware('auth:api');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
