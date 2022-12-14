<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DokController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('registracija', [AuthController::class, 'registracija']);
Route::post('prijava', [AuthController::class, 'prijava']);
Route::post('odjava', [AuthController::class, 'odjava']);

Route::post('upload', [DokController::class, 'upload']);
Route::get('get-documents/{id}', [DokController::class, 'getDocuments']);
Route::delete('delete-document/{id}', [DokController::class, 'deleteDocument']);
Route::get('edit/{id}', [DokController::class, 'editDocument']);
Route::post('update/{id}', [DokController::class, 'updateDocument']);
Route::get('get-documents', [DokController::class, 'getAllDocuments']);
Route::get('search-documents-admin/{input}', [DokController::class, 'searchDocumentsAdmin']);
Route::get('search-documents/{id}/{input}', [DokController::class, 'searchDocuments']);
Route::get('sort-documents-admin/{kolona}/{poredak}', [DokController::class, 'sortDocumentsAdmin']);
Route::get('sort-documents/{id}/{kolona}/{poredak}', [DokController::class, 'sortDocuments']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
