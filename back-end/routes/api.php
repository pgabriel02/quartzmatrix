<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuartzMatrix;

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

Route::post('/angajati', [QuartzMatrix::class, 'getAngajati'])->name('angajati');
Route::post('/mediedepartament', [QuartzMatrix::class, 'getMedieDepartament'])->name('mediedepartament');
Route::post('/angajatidepartament', [QuartzMatrix::class, 'getAngajatiDepartament'])->name('angajatidepartament');
