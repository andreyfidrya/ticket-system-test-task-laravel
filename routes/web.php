<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/widget', [WidgetController::class, 'index'])->name('widget.form');
Route::post('/widget/send', [WidgetController::class, 'send'])->name('widget.send');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Auth::routes();

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
