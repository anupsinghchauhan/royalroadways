<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerLR;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\ControllerBilling;
use App\Http\Controllers\ControllerCSV;
use App\Http\Controllers\ControllerTrucksDetails;
use App\Http\Controllers\ControllerMonthlyPendingPayment;
use App\Http\Controllers\ControllerDailyTruck;
use App\Http\Controllers\ControllerTruckExpance;
use App\Http\Controllers\ControllerDashboard;
use App\Http\Controllers\DBBackupController;
//use DB;
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

// frontend route
Route::get('/get-db-backup', [DBBackupController::class,'getBackup']);

Route::get('/', function(){
    $data = array('page_title'=>'contact-us','is_home'=>true);
    return View::make('pages.home',compact('data'));
});
Route::get('about-us', function() {
    $data = array('page_title'=>'About us');
    return View::make('pages.about-us',compact('data'));
});
Route::get('contact-us', function() {
    $data = array('page_title'=>'Contact us');
    return View::make('pages.contact-us',compact('data'));
});
Route::get('truck-list', function() {
    $data = array('page_title'=>'Truck List');
    return View::make('pages.truck-list',compact('data'));
});

Route::get('zohoverify/verifyforzoho.html', function() {
    return View::make('pages.verifyforzoho');
});
/*
Route::get('paypal', function() {
    return View::make('pages.verifyforzoho');
});
*/
Route::get('loginpanel', function () {
    return view('pages.admin.view_admin_login');
})->name('loginpanel');

Route::get('dashboard',  [ControllerDashboard::class, 'index'] )->middleware('auth')->name('dashboard');

// Admin Panel Route
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('lr-bill')->group(function(){
    Route::get('/', [ControllerLR::class,'listLrData'])->middleware('auth');
    Route::get('/today', [ControllerLR::class,'listTodayLrData'])->middleware('auth');
    Route::get('/view/{id}', [ControllerLR::class,'view'])->middleware('auth');
    Route::get('/edit/{id}', [ControllerLR::class,'edit'])->middleware('auth');
    Route::get('/delete/{id}', [ControllerLR::class,'delete'])->middleware('auth');
    Route::get('/sendmail/{id}', [ControllerLR::class,'sendmail'])->middleware('auth');
    Route::get('/create-bill', [ControllerLR::class,'createBill'])->middleware('auth');
    Route::post('/save', [ControllerLR::class,'save'])->middleware('auth');
    Route::post('/send-mail-process/{id}',[ControllerLR::class,'sendMailProcess'])->middleware('auth');
    Route::get('/download-pdf/{id}',[ControllerLR::class,'downloadPDF'])->middleware('auth');
    Route::post('/download-excel',[ControllerLR::class,'downloadExcel'])->middleware('auth');

});

Route::get('lr/ajax-list', [ControllerLR::class, 'listLrDataTableAjax'])->name('lr.ajax-list');

Route::prefix('bills')->group(function(){
    Route::get('/', [ControllerBilling::class,'listBillsData'])->middleware('auth');
    Route::get('/create-bill', [ControllerBilling::class,'createBill'])->middleware('auth');
    Route::get('/view/{id}', [ControllerBilling::class,'view'])->middleware('auth');
    Route::get('/edit/{id}', [ControllerBilling::class,'edit'])->middleware('auth');
    Route::get('/delete/{id}', [ControllerBilling::class,'delete'])->middleware('auth');
    Route::get('/sendmail/{id}', [ControllerBilling::class,'sendmail'])->middleware('auth');
    Route::post('/send-mail-process/{id}',[ControllerBilling::class,'sendMailProcess'])->middleware('auth');
    Route::post('/save/{id?}', [ControllerBilling::class,'save'])->middleware('auth');
    Route::post('ajax-search-data',[ControllerBilling::class,'ajaxSearchData'])->middleware('auth');
    Route::get('/download-pdf/{id}',[ControllerBilling::class,'downloadPDF'])->middleware('auth');
    Route::get('list', [ControllerBilling::class, 'listBillsDataAjax'])->middleware('auth')->name('bills.list');
});

Route::prefix('trucks')->group(function(){
    Route::get('/', [ControllerTrucksDetails::class,'listTrucksData'])->middleware('auth');
    Route::get('all-ztruck', [ControllerTrucksDetails::class, 'DataTableAjax'])->middleware('auth')->name('all-truck.list');
    Route::get('edit/{id}', [ControllerTrucksDetails::class,'edit'])->middleware('auth');
    Route::get('delete/{id}', [ControllerTrucksDetails::class,'delete'])->middleware('auth');
    Route::post('download-excel',[ControllerTrucksDetails::class,'downloadPDF'])->middleware('auth');

    Route::get('daily-trucks', [ControllerDailyTruck::class, 'listTrucksData'])->middleware('auth');
    Route::get('daily-truck-data', [ControllerDailyTruck::class, 'DataTableAjax'])->middleware('auth');
    Route::get('daily-truck/edit/{id}', [ControllerDailyTruck::class,'edit'])->middleware('auth');
    Route::get('daily-truck/delete/{id}', [ControllerDailyTruck::class,'delete'])->middleware('auth');
    Route::get('daily-truck/create', [ControllerDailyTruck::class,'create'])->middleware('auth');
    Route::post('daily-truck/save', [ControllerDailyTruck::class,'save'])->middleware('auth');
    Route::post('daily-truck/download-data',[ControllerDailyTruck::class,'downloadData'])->middleware('auth');

    Route::get('expance', [ControllerTruckExpance::class, 'listTrucksData'])->middleware('auth');
    Route::get('expance-data', [ControllerTruckExpance::class, 'DataTableAjax'])->middleware('auth');
    Route::get('expance/delete/{id}', [ControllerTruckExpance::class,'delete'])->middleware('auth');
    Route::get('expance/create', [ControllerTruckExpance::class,'create'])->middleware('auth');
    Route::post('expance/save', [ControllerTruckExpance::class,'save'])->middleware('auth');
    Route::post('expance/download-excel',[ControllerTruckExpance::class,'downloadExcel'])->middleware('auth');
    Route::get('trucks-vice-expance', function () {
        $title = "Under Construction.";
        return view('pages.admin.view_under_construction',compact('title'));
    })->middleware('auth'); 
});

Route::get('/upload-csv', [ControllerCSV::class,'uploadCsv'])->middleware('auth');
Route::get('/monthly-pending-party-payment-list', [ControllerMonthlyPendingPayment::class,'monthly_pending_party_payment_list'])->middleware('auth');
Route::get('monthly-pending-party-bill/list', [ControllerMonthlyPendingPayment::class, 'DataTableAjax'])->name('monthly-pending-party-bill.list')->middleware('auth');
Route::post('monthly-pending-party-bill/view', [ControllerMonthlyPendingPayment::class, 'view'])->middleware('auth');
Route::get('monthly-pending-party-bill/delete/{id?}', [ControllerMonthlyPendingPayment::class, 'delete'])->middleware('auth');
Route::get('monthly-pending-party-bill/delete-by-name/{id?}', [ControllerMonthlyPendingPayment::class, 'deleteByName'])->middleware('auth');
Route::post('monthly-pending-party-bill/download-pdf', [ControllerMonthlyPendingPayment::class, 'downloadPDF'])->middleware('auth');
Route::post('save-payment', [ControllerMonthlyPendingPayment::class, 'savePayment'])->middleware('auth');
//Route Ajax
Route::post('/ajax-search-address',[ControllerLR::class,'ajax_search_address'])->middleware('auth');


Route::get('monthly-pending-party-bill/delete-by-name/{id?}', [ControllerMonthlyPendingPayment::class, 'deleteByName'])->middleware('auth');

Route::get('users', function () {
    $title = "Under Construction.";
    return view('pages.admin.view_under_construction',compact('title'));
})->middleware('auth'); 

