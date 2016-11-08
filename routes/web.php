<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'DashboardController@index');

// Dashboard
Route::get('/dashboard', 'DashboardController@index');


Auth::routes();

Route::get('/home', 'HomeController@index');

// System Manager
Route::get('/routes', 'RoutesController@index');
Route::post('/add-route', 'RoutesController@store');
Route::get('/get-route/{route_id}', 'RoutesController@getRoute');
Route::get('/parent-routes', 'RoutesController@getParentRoutes');
Route::post('/edit-route', 'RoutesController@update');
Route::get('/load-routes', 'RoutesController@loadRoutes');
Route::get('/delete-route/{id}', 'RoutesController@destroy');
Route::get('/menu', 'MenuController@index');
Route::post('/add-menu', 'MenuController@store');
Route::post('/arrange-menu', 'MenuController@arrangeMenu');
Route::post('/edit-menu', 'MenuController@update');
Route::get('/get-menu/{id}', 'MenuController@getMenuItem');
Route::post('/remove-menu', 'MenuController@destroy');
Route::get('/theme-config', 'ThemeController@index');
Route::get('/theme-select/{theme}', 'ThemeController@saveSkin');
Route::get('/get-theme', 'ThemeController@getTheme');

#### inventory module
// category

Route::get('/categories','CategoryController@index');
Route::post('/add-category','CategoryController@storeCategory');

#####Database Backups
Route::get('/backups','DatabaseBackup@index');
Route::get('/make-backup','DatabaseBackup@runBackup');

##### User manager
Route::get('/user_roles','UserManagerController@getIndex');
Route::post('/add-user-role','UserManagerController@storeRole');
Route::delete('/delete-user-role/{id}','UserManagerController@destroyRole');
Route::get('/audit_trails','UserManagerController@auditTrails');
Route::get('/ajax_trails','UserManagerController@ajaxAuditTrails');


####buses

Route::get('all-buses','BusesController@getBuses');
Route::post('/add-bus','BusesController@storeBus');

####Expenses
Route::get('/expenses','ExpensesController@getExpenses');
Route::post('/add-expense','ExpensesController@storeExpense');

####Accounts
Route::get('/accounts','AccountController@getAccounts');
Route::post('/store-transaction','AccountController@storeTransaction');

###masterfile
Route::get('/masterfiles','MasterfileController@index');


####Transactions


####reports
Route::get('daily-report','ReportsController@getDailyReport');
Route::get('/view-report/{id}','ReportsController@viewDailyReport');
Route::get('/all-transactions','ReportsController@viewAllTransactionsReport');

####  Masterfiles
Route::get('/new-mf', 'MasterfileController@index');
Route::post('/store-masterfile','MasterfileController@storeMasterfile');
Route::get('/all-masterfiles','MasterfileController@getAllMasterfiles');
Route::get('/load-masterfiles','MasterfileController@loadMasterFiles');

#### Suppliers
Route::get('/suppliers','SupplierController@getSuppliers');
Route::post('/store-supplier','SupplierController@storeSupplier');
Route::get('/supplier-items','SupplierController@getSupplierItems');
Route::post('/store-supplier-item','SupplierController@storeSupplierItem');
Route::get('/invoices','SupplierController@getInvoices');
Route::get('/load-invoice-fields/{id}','SupplierController@loadInvoiceFields');
Route::post('/raise-invoice','SupplierController@createInvoice');
