<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\API\DropdownController;

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

Route::group([
  'prefix' => 'unit_select',
  'as' => 'unit_select.'
], function(){
  Route::get('/block', [DropdownController::class, 'block'])->name('block');
  Route::get('/number', [DropdownController::class, 'number'])->name('number');
});