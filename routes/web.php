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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home.index');

// Planning
Route::get('/planning', [\App\Http\Controllers\PlanningController::class, 'index'])->middleware('auth')->name('planning.index');

// login
Route::get('/login', [\App\Http\Controllers\UserController::class, 'index'])->name('login');
Route::get('/log-out', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('submit');

// Settings
Route::get('/settings', [\App\Http\Controllers\UserController::class, 'viewUser'])->middleware('auth')->name('users.index');
Route::post('settings/add', [\App\Http\Controllers\UserController::class, 'add'])->middleware('auth')->name('users.add');
Route::get('settings/addForm/{token}', [\App\Http\Controllers\UserController::class, 'addForm'])->middleware('auth')->name('users.addForm');
Route::post('settings/edit', [\App\Http\Controllers\UserController::class, 'edit'])->middleware('auth')->name('users.edit');
Route::get('settings/editForm/{token}/{id}', [\App\Http\Controllers\UserController::class, 'editForm'])->middleware('auth')->name('users.editForm');
Route::post('settings/delete', [\App\Http\Controllers\UserController::class, 'delete'])->middleware('auth')->name('users.delete');


// Bus
Route::get('bus', [\App\Http\Controllers\BusController::class, 'index'])->middleware('auth')->name('bus.index');
Route::post('bus/add', [\App\Http\Controllers\BusController::class, 'add'])->middleware('auth')->name('bus.add');
Route::get('bus/addForm/{token}', [\App\Http\Controllers\BusController::class, 'addForm'])->middleware('auth')->name('bus.addForm');
Route::post('bus/edit', [\App\Http\Controllers\BusController::class, 'edit'])->middleware('auth')->name('bus.edit');
Route::get('bus/editForm/{token}/{id}', [\App\Http\Controllers\BusController::class, 'editForm'])->middleware('auth')->name('bus.editForm');
Route::post('bus/delete', [\App\Http\Controllers\BusController::class, 'delete'])->middleware('auth')->name('bus.delete');

// Agences
Route::get('agences', [\App\Http\Controllers\AgenceController::class, 'index'])->middleware('auth')->name('agence.index');
Route::post('agence/add', [\App\Http\Controllers\AgenceController::class, 'add'])->middleware('auth')->name('agence.add');
Route::get('agence/addForm/{token}', [\App\Http\Controllers\AgenceController::class, 'addForm'])->middleware('auth')->name('agence.addForm');
Route::post('agence/edit', [\App\Http\Controllers\AgenceController::class, 'edit'])->middleware('auth')->name('agence.edit');
Route::get('agence/editForm/{token}/{id}', [\App\Http\Controllers\AgenceController::class, 'editForm'])->middleware('auth')->name('agence.editForm');
Route::post('agence/delete', [\App\Http\Controllers\AgenceController::class, 'delete'])->middleware('auth')->name('agence.delete');

// Agents
Route::get('agents', [\App\Http\Controllers\AgentController::class, 'index'])->middleware('auth')->name('agent.index');
Route::post('agent/add', [\App\Http\Controllers\AgentController::class, 'add'])->middleware('auth')->name('agent.add');
Route::get('agent/addForm/{token}', [\App\Http\Controllers\AgentController::class, 'addForm'])->middleware('auth')->name('agent.addForm');
Route::post('agent/edit', [\App\Http\Controllers\AgentController::class, 'edit'])->middleware('auth')->name('agent.edit');
Route::get('agent/editForm/{token}/{id}', [\App\Http\Controllers\AgentController::class, 'editForm'])->middleware('auth')->name('agent.editForm');
Route::post('agent/delete', [\App\Http\Controllers\AgentController::class, 'delete'])->middleware('auth')->name('agent.delete');

// Voyageurs
Route::get('voyageurs', [\App\Http\Controllers\VoyageurController::class, 'index'])->middleware('auth')->name('voyageur.index');
Route::post('voyageur/add', [\App\Http\Controllers\VoyageurController::class, 'add'])->middleware('auth')->name('voyageur.add');
Route::get('voyageur/addForm/{token}', [\App\Http\Controllers\VoyageurController::class, 'addForm'])->middleware('auth')->name('voyageur.addForm');
Route::post('voyageur/edit', [\App\Http\Controllers\VoyageurController::class, 'edit'])->middleware('auth')->name('voyageur.edit');
Route::get('voyageur/editForm/{token}/{id}', [\App\Http\Controllers\VoyageurController::class, 'editForm'])->middleware('auth')->name('voyageur.editForm');
Route::post('voyageur/delete', [\App\Http\Controllers\VoyageurController::class, 'delete'])->middleware('auth')->name('voyageur.delete');

// Forfaits
Route::get('forfaits', [\App\Http\Controllers\ForfaitController::class, 'index'])->middleware('auth')->name('forfait.index');
Route::post('forfait/add', [\App\Http\Controllers\ForfaitController::class, 'add'])->middleware('auth')->name('forfait.add');
Route::get('forfait/addForm/{token}', [\App\Http\Controllers\ForfaitController::class, 'addForm'])->middleware('auth')->name('forfait.addForm');
Route::post('forfait/edit', [\App\Http\Controllers\ForfaitController::class, 'edit'])->middleware('auth')->name('forfait.edit');
Route::get('forfait/editForm/{token}/{id}', [\App\Http\Controllers\ForfaitController::class, 'editForm'])->middleware('auth')->name('forfait.editForm');
Route::post('forfait/delete', [\App\Http\Controllers\ForfaitController::class, 'delete'])->middleware('auth')->name('forfait.delete');

// Reservations
Route::get('reservations', [\App\Http\Controllers\ReservationController::class, 'index'])->middleware('auth')->name('reservation.index');
Route::get('reservations/print/{token}/{id}', [\App\Http\Controllers\ReservationController::class, 'print'])->middleware('auth')->name('reservation.print');
Route::post('reservation/add', [\App\Http\Controllers\ReservationController::class, 'add'])->middleware('auth')->name('reservation.add');
Route::get('reservation/addForm/{token}', [\App\Http\Controllers\ReservationController::class, 'addForm'])->middleware('auth')->name('reservation.addForm');
Route::post('reservation/edit', [\App\Http\Controllers\ReservationController::class, 'edit'])->middleware('auth')->name('reservation.edit');
Route::get('reservation/editForm/{token}/{id}', [\App\Http\Controllers\ReservationController::class, 'editForm'])->middleware('auth')->name('reservation.editForm');
Route::post('reservation/delete', [\App\Http\Controllers\ReservationController::class, 'delete'])->middleware('auth')->name('reservation.delete');
