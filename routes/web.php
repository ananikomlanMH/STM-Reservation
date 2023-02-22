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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

// login
Route::get('/planning', [\App\Http\Controllers\PlanningController::class, 'index'])->name('planning.index');

// login
Route::get('/login', [\App\Http\Controllers\UserAuthController::class, 'index'])->name('login.index');

// Bus
Route::get('bus', [\App\Http\Controllers\BusController::class, 'index'])->name('bus.index');
Route::post('bus/add', [\App\Http\Controllers\BusController::class, 'add'])->name('bus.add');
Route::get('bus/addForm/{token}', [\App\Http\Controllers\BusController::class, 'addForm'])->name('bus.addForm');
Route::post('bus/edit', [\App\Http\Controllers\BusController::class, 'edit'])->name('bus.edit');
Route::get('bus/editForm/{token}/{id}', [\App\Http\Controllers\BusController::class, 'editForm'])->name('bus.editForm');
Route::post('bus/delete', [\App\Http\Controllers\BusController::class, 'delete'])->name('bus.delete');

// Agences
Route::get('agences', [\App\Http\Controllers\AgenceController::class, 'index'])->name('agence.index');
Route::post('agence/add', [\App\Http\Controllers\AgenceController::class, 'add'])->name('agence.add');
Route::get('agence/addForm/{token}', [\App\Http\Controllers\AgenceController::class, 'addForm'])->name('agence.addForm');
Route::post('agence/edit', [\App\Http\Controllers\AgenceController::class, 'edit'])->name('agence.edit');
Route::get('agence/editForm/{token}/{id}', [\App\Http\Controllers\AgenceController::class, 'editForm'])->name('agence.editForm');
Route::post('agence/delete', [\App\Http\Controllers\AgenceController::class, 'delete'])->name('agence.delete');

// Agents
Route::get('agents', [\App\Http\Controllers\AgentController::class, 'index'])->name('agent.index');
Route::post('agent/add', [\App\Http\Controllers\AgentController::class, 'add'])->name('agent.add');
Route::get('agent/addForm/{token}', [\App\Http\Controllers\AgentController::class, 'addForm'])->name('agent.addForm');
Route::post('agent/edit', [\App\Http\Controllers\AgentController::class, 'edit'])->name('agent.edit');
Route::get('agent/editForm/{token}/{id}', [\App\Http\Controllers\AgentController::class, 'editForm'])->name('agent.editForm');
Route::post('agent/delete', [\App\Http\Controllers\AgentController::class, 'delete'])->name('agent.delete');

// Agents
Route::get('voyageurs', [\App\Http\Controllers\VoyageurController::class, 'index'])->name('voyageur.index');
Route::post('voyageur/add', [\App\Http\Controllers\VoyageurController::class, 'add'])->name('voyageur.add');
Route::get('voyageur/addForm/{token}', [\App\Http\Controllers\VoyageurController::class, 'addForm'])->name('voyageur.addForm');
Route::post('voyageur/edit', [\App\Http\Controllers\VoyageurController::class, 'edit'])->name('voyageur.edit');
Route::get('voyageur/editForm/{token}/{id}', [\App\Http\Controllers\VoyageurController::class, 'editForm'])->name('voyageur.editForm');
Route::post('voyageur/delete', [\App\Http\Controllers\VoyageurController::class, 'delete'])->name('voyageur.delete');

// Forfaits
Route::get('forfaits', [\App\Http\Controllers\ForfaitController::class, 'index'])->name('forfait.index');
Route::post('forfait/add', [\App\Http\Controllers\ForfaitController::class, 'add'])->name('forfait.add');
Route::get('forfait/addForm/{token}', [\App\Http\Controllers\ForfaitController::class, 'addForm'])->name('forfait.addForm');
Route::post('forfait/edit', [\App\Http\Controllers\ForfaitController::class, 'edit'])->name('forfait.edit');
Route::get('forfait/editForm/{token}/{id}', [\App\Http\Controllers\ForfaitController::class, 'editForm'])->name('forfait.editForm');
Route::post('forfait/delete', [\App\Http\Controllers\ForfaitController::class, 'delete'])->name('forfait.delete');

// Reservations
Route::get('reservations', [\App\Http\Controllers\ReservationController::class, 'index'])->name('reservation.index');
Route::get('reservations/print/{token}/{id}', [\App\Http\Controllers\ReservationController::class, 'print'])->name('reservation.print');
Route::post('reservation/add', [\App\Http\Controllers\ReservationController::class, 'add'])->name('reservation.add');
Route::get('reservation/addForm/{token}', [\App\Http\Controllers\ReservationController::class, 'addForm'])->name('reservation.addForm');
Route::post('reservation/edit', [\App\Http\Controllers\ReservationController::class, 'edit'])->name('reservation.edit');
Route::get('reservation/editForm/{token}/{id}', [\App\Http\Controllers\ReservationController::class, 'editForm'])->name('reservation.editForm');
Route::post('reservation/delete', [\App\Http\Controllers\ReservationController::class, 'delete'])->name('reservation.delete');
