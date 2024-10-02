<?php

use App\Http\Controllers\employController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('add');
});
Route::get('/get-data', function () {
    return view('getdata');
})->name('getview');



Route::post('/add', [employController::class, 'adddata'])->name('add');
Route::get('allstudent', [employController::class, 'getall'])->name('getstudent');
Route::get('edituser/{id}', [employController::class, 'updatedata'])->name('edituser');
Route::post('update/{id}', [employController::class, 'updateuser'])->name('updateuser');
Route::get('deleteuser/{id}', [employController::class, 'deleteuser']);
