<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IsAdmin;
use App\Http\Controllers\IsCustomer;
use App\Http\Controllers\Customers;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\proposalController;
use App\Http\Controllers\ProposalItemController;
use App\Http\Controllers\ProposalUserController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Routing\RouteGroup;

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

Route::Group([ 'prefix' => 'admin','middleware' => ['ChkAdmin']], function () {
    Route::resource('/customers', Customers::class);
    Route::resource('/proposaluser', ProposalUserController::class);
    Route::resource('/proposalitem', ProposalItemController::class);
    Route::resource('/department', departmentController::class);
    Route::resource('/proposal', proposalController::class);

    Route::get('/download/{id}', [ProposalController::class,'printToPdf'])->name('download');
    
    Route::get('/getPrice/{id}', [proposalController::class,'getPrice'])->name('getPrice');
    Route::get('/customer', [IsAdmin::class, 'customer'])->name('customer');
    Route::get('/', [IsAdmin::class, 'index'])->name('dashboard');
});
Route::Group(['middleware' => ['ChkCustomer']], function () {
    Route::get('/customer_panel', [IsCustomer::class, 'index'])->name('customer_panel');
});


Auth::routes(['register' => false]);

Route::get('/', function ()
{
    return redirect()->route('login');
});
