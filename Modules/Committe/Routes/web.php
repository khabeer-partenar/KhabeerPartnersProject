<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\Committe\Entities\Committee;

Route::prefix('committe')->group(function() {
    Route::get('/',function (){
      $commitee = Committee::where('id' , 1)->with('treatDests')->get();
      dd($commitee);
    });
});
