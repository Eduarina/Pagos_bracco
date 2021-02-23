<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\ProveedorController;
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
    if( session()->get('id') )
        return redirect('/home');
    return view('welcome');
});

Route::post("/login", [EmpleadosController::class, 'index'])->name("login.data");
Route::get("/home", [PagosController::class, 'index']);
Route::post("/addProv", [ProveedorController::class, 'add']);
Route::get("/solicitudes", [SolicitudesController::class, 'index']);
Route::post("/saveSolicitud", [PagosController::class, 'save']);
Route::get("/pagos", [PagosController::class, 'pagos']);
Route::post('/changePay', [PagosController::class, 'pagar']);
Route::get('/usuarios', [EmpleadosController::class, 'usuarios']);
Route::post("/getCuentas", [PagosController::class, 'cuentas']);
Route::get('logout', function(){
    session()->forget('id');
    return redirect('/');
});
Route::post("/createUser", [EmpleadosController::class, 'create']);
Route::get('/proveedores', [ProveedorController::class, 'proveedores']);
Route::post("/getProvInfo", [ProveedorController::class, 'details']);
Route::post("/updateProvs", [ProveedorController::class, 'update']);
