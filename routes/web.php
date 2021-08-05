<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AccounceController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [AccounceController::class, 'find'])->name('annonce.find');
Route::post('/announce/get', [AccounceController::class, 'findGet'])->name('findGet');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/team', [PageController::class, 'team'])->name('team');

Route::middleware(['auth'])->group(function () {
    Route::get('/add', [AccounceController::class, 'add'])->name('annonce.add');
    Route::get('/manage', [AccounceController::class, 'manage'])->name('annonce.manage');
    Route::post('/announce/store', [AccounceController::class, 'store'])->name('annonce.store');
    Route::post('/update', [AccounceController::class, 'update'])->name('annonce.update');
    Route::post('/freeze', [AccounceController::class, 'freeze'])->name('announce.freeze');
    Route::post('/activate', [AccounceController::class, 'activate'])->name('announce.activate');
    Route::post('/delete', [AccounceController::class, 'delete'])->name('announce.delete');
    
});

Route::middleware(['auth', 'role.admin'])->group(function () {
    Route::get('/Jervi', [AdminController::class, 'home'])->name('admin.home');
    Route::get('/Jervi/articles', [AdminController::class, 'articles'])->name('admin.articles');
    Route::get('/Jervi/costs', [AdminController::class, 'costs'])->name('admin.costs');
    Route::get('/Jervi/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::get('/Jervi/roles', [AdminController::class, 'roles'])->name('admin.roles');
    Route::get('/Jervi/types', [AdminController::class, 'types'])->name('admin.types');
    Route::get('/Jervi/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/Jervi/wilaya', [AdminController::class, 'wilaya'])->name('admin.wilaya');

    Route::post('/Jervi/za/costs', [AdminController::class, 'costsAdd'])->name('admin.costs.add');
    Route::post('/Jervi/za/messages', [AdminController::class, 'messagesAdd'])->name('admin.messages.add');
    Route::post('/Jervi/za/roles', [AdminController::class, 'rolesAdd'])->name('admin.roles.add');
    Route::post('/Jervi/za/types', [AdminController::class, 'typesAdd'])->name('admin.types.add');

    Route::post('/Jervi/zd/costs', [AdminController::class, 'costsDelete'])->name('admin.costs.delete');
    Route::post('/Jervi/zd/messages', [AdminController::class, 'messagesDelete'])->name('admin.messages.delete');
    Route::post('/Jervi/zd/roles', [AdminController::class, 'rolesDelete'])->name('admin.roles.delete');
    Route::post('/Jervi/zd/types', [AdminController::class, 'typesDelete'])->name('admin.types.delete');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
