<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect("home");
});

Route::group(["middleware" => "auth"],function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(["prefix" => "services"],function(){
      Route::get('/', [App\Http\Controllers\ServicesController::class, 'index'])->name('service.index');
      Route::post('/create', [App\Http\Controllers\ServicesController::class, 'create'])->name('service.create');
      Route::post('/update', [App\Http\Controllers\ServicesController::class, 'update'])->name('service.update');
      Route::get('/delete/{id}', [App\Http\Controllers\ServicesController::class, 'delete'])->name('service.delete');
      Route::get('/edit/{id}', [App\Http\Controllers\ServicesController::class, 'edit'])->name('service.edit');
    });


    Route::group(["prefix" => "repertoires"],function(){
      Route::get('/', [App\Http\Controllers\RepertoiresController::class, 'index'])->name('folder.index');
      Route::post('/create', [App\Http\Controllers\RepertoiresController::class, 'create'])->name('folder.create');
      Route::post('/update', [App\Http\Controllers\RepertoiresController::class, 'update'])->name('folder.update');
      Route::get('/delete/{id}', [App\Http\Controllers\RepertoiresController::class, 'delete'])->name('folder.delete');
      Route::get('/edit/{id}', [App\Http\Controllers\RepertoiresController::class, 'edit'])->name('folder.edit');
      Route::get('/folder', [App\Http\Controllers\RepertoiresController::class, 'getFolder'])->name('folder.get');
      Route::post('/attribution', [App\Http\Controllers\RepertoiresController::class, 'attribution'])->name('folder.attrib');
    });



    Route::group(["prefix" => "utilisateurs"],function(){
      Route::get('/', [App\Http\Controllers\UsersController::class, 'index'])->name('gestion.user.index');
      Route::post('/create', [App\Http\Controllers\UsersController::class, 'create'])->name('user.create');
      Route::post('/update', [App\Http\Controllers\UsersController::class, 'update'])->name('user.update');
      Route::get('/delete/{id}', [App\Http\Controllers\UsersController::class, 'delete'])->name('user.delete');
      Route::get('/edit/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('user.edit');
    });


});


Auth::routes();

/*Route::get("/reg-ad",function(){
  App\Models\User::create([
    "name" => "Info2ma",
    "email" => "2ma.info",
    "password" => \Hash::make("*2M@-lineSAve201/."),
    "role" => "ad",
    "service_id" => 1
  ]);
});*/


Route::get("/register",function(){
  return redirect("/");
});
