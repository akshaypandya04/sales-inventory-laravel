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


Route::get('/', function () {

    return view('auth.login');

});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/edit_profile', 'HomeController@edit_profile')->name('edit_profile');
Route::POST('/update_profile/{id}', 'HomeController@update_profile')->name('update_profile');
Route::get('/password_change/', 'HomeController@update_password')->name('update_password');

Route::match(['get', 'post'], '/update-pwd', 'HomeController@updatePassword');

Route::resource('category', 'CategoryController');
Route::resource('tax', 'TaxController');
Route::resource('unit', 'UnitController');
Route::resource('payment', 'PaymentController');
Route::resource('customer', 'CustomerController');
Route::resource('product', 'ProductController');
Route::resource('invoice', 'InvoiceController');
Route::resource('loans', 'LoanController');
Route::get('/findPrice', 'InvoiceController@findPrice')->name('findPrice');
Route::get('/findCustomer', 'LoanController@findCustomer')->name('findCustomer');

Route::get('/get-items-by-category/{id}', 'SalesEntryController@getItemsByCategory');

Route::get('/get-by-category/{id}', 'PurchaseController@getByCategory');

Route::get('/party-list', 'CustomerController@party_list')->name('party.list');

Route::get('get-item/{id}','SalesEntryController@getItem');

Route::resource('sales', SalesEntryController::class)->parameters([
    'sales' => 'salesEntry'
]);
Route::resource('items', 'ItemController');

Route::resource('expenses', ExpenseController::class)->parameters([
    'expenses' => 'expense' // ✅ lowercase 'purchase'
]);

Route::resource('purchases', PurchaseController::class)->parameters([
    'purchases' => 'purchase' // ✅ lowercase 'purchase'
]);

Route::post('api/fetch-code','PaymentController@fetch_loan_code');

Route::get('/findLoan', 'PaymentController@findLoan')->name('findLoan');

Route::get('/invoice-report', 'InvoiceController@invoice_report')->name('invoice.report');

Route::get('/customer-report', 'CustomerController@customer_report')->name('customer.report');

Route::get('/equity-finance-report', 'LoanController@loan_report')->name('loans.report');
Route::get('/rates-report', 'UnitController@rates_report')->name('rates.report');

Route::get('/customer-filter', 'CustomerController@customer_filter')->name('customer.filter');


Route::get('/sales-filter', 'SalesEntryController@sales_filter')->name('sales.filter');

Route::get('/purchases-filter', 'PurchaseController@purchases_filter')->name('purchases.filter');

Route::get('/expenses-filter', 'ExpenseController@expenses_filter')->name('expenses.filter');


Route::get('/sales-report', 'SalesEntryController@sales_report')->name('sales.report');

Route::get('/purchases-report', 'PurchaseController@purchases_report')->name('purchases.report');

Route::get('/expenses-report', 'ExpenseController@expenses_report')->name('expenses.report');

Route::get('/daywise-profit', 'PaymentController@dayWiseProfitReport')->name('report.daywise.profit');

Route::get('/loan-filter', 'LoanController@loan_filter')->name('loan.filter');
Route::get('/invoice-filter', 'InvoiceController@invoice_filter')->name('invoice.filter');
Route::get('/rates-filter', 'UnitController@rates_filter')->name('rates.filter');
