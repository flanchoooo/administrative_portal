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
use  App\RegisterInternet;
use App\Role;
use App\Role_User;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});







//CardType
Route::GET('/card/display', ['uses' => 'CardTypeController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/card/create', ['uses' => 'CardTypeController@show', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/card/updateview', ['uses' => 'CardTypeController@update_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/card/update', ['uses' => 'CardTypeController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/card/make', ['uses' => 'CardTypeController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/card/delete', ['uses' => 'CardTypeController@destroy', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);



//CardProduction
Route::GET('/luhn/display', ['uses' => 'LuhnController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/luhn/create', ['uses' => 'LuhnController@show', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/luhn/make', ['uses' => 'LuhnController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/luhn/batchview', ['uses' => 'LuhnController@batch', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/luhn/decommissioned', ['uses' => 'LuhnController@decommissioned', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/luhn/delete', ['uses' => 'LuhnController@destroy', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Merchants
Route::GET('/merchant/display', ['uses' => 'MerchantController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']])->name('display_merchant');
Route::GET('/merchant/create', ['uses' => 'MerchantController@show', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/merchant/make', ['uses' => 'MerchantController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/merchant/updateview', ['uses' => 'MerchantController@update_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/merchant/update', ['uses' => 'MerchantController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//
//Merchant Account
Route::get('/merchantaccount/display', ['uses' => 'MerchantAccountController@all', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/merchantaccount/create', ['uses' => 'MerchantAccountController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/merchantaccount/make', ['uses' => 'MerchantAccountController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/merchantaccount/updateview', ['uses' => 'MerchantAccountController@update_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/merchantaccount/update', ['uses' => 'MerchantAccountController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/merchantaccount/lookup', ['uses' => 'MerchantAccountController@lookup', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/merchantaccount/delete', ['uses' => 'MerchantAccountController@destroy', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//devices
Route::get('/devices/display', ['uses' => 'DeviceController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/devices/createview', ['uses' => 'DeviceController@create_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/devices/create', ['uses' => 'DeviceController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/devices/updateview', ['uses' => 'DeviceController@updateview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/devices/update', ['uses' => 'DeviceController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/devices/del', ['uses' => 'DeviceController@del', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/devices/delete', ['uses' => 'DeviceController@delete', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('devices/creates', ['uses' => 'DeviceController@creates', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Account Management
Route::GET('/accountmanagement/link', ['uses' => 'AccountManagerController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/accountmanagement/lookup', ['uses' => 'AccountManagerController@show', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/accountmanagement/info', ['uses' => 'AccountManagerController@info', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/accountmanagement/create', ['uses' => 'AccountManagerController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/accountmanagement/status', ['uses' => 'AccountManagerController@status', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/accountmanagement/status_info', ['uses' => 'AccountManagerController@status_info', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/accountmanagement/change', ['uses' => 'AccountManagerController@change', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/accountmanagement/display', ['uses' => 'AccountManagerController@display', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/accountmanagement/updateview', ['uses' => 'AccountManagerController@updateview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/accountmanagement/activate', ['uses' => 'AccountManagerController@activate', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/accountmanagement/decommission', ['uses' => 'AccountManagerController@decommission', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/accountmanagement/unlink', ['uses' => 'AccountManagerController@unlink', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/accountmanagement/decommissions', ['uses' => 'AccountManagerController@decommissions', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/accountmanagement/unlinks', ['uses' => 'AccountManagerController@unlinks', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/accountmanagement/reject', ['uses' => 'AccountManagerController@reject', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Products
Route::GET('/product/display', ['uses' => 'ProductController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/product/createview', ['uses' => 'ProductController@createview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/product/create', ['uses' => 'ProductController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/product/updateview', ['uses' => 'ProductController@updateview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/product/update', ['uses' => 'ProductController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/product/delete', ['uses' => 'ProductController@destroy', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Fee
Route::GET('/fee/display', ['uses' => 'FeeController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/fee/createview', ['uses' => 'FeeController@createview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/fee/create', ['uses' => 'FeeController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/fee/updateview', ['uses' => 'FeeController@updateview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/fee/update', ['uses' => 'FeeController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/fee/delete', ['uses' => 'FeeController@destroy', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Reports
Route::get('/transactions/display', ['uses' => 'ReportsController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/transactions/statistics', ['uses' => 'ReportsController@stats', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/transactions/wallet', ['uses' => 'ReportsController@wallet', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/transaction/view', ['uses' => 'ReportsController@view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/transaction/wallet/view', ['uses' => 'ReportsController@wallet_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/transaction/wallet/highcharts', ['uses' => 'ReportsController@highcharts', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//bank
Route::get('/bank/display', ['uses' => 'BankController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/bank/createview', ['uses' => 'BankController@createview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/bank/create', ['uses' => 'BankController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/bank/updateview', ['uses' => 'BankController@updateview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/bank/update', ['uses' => 'BankController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/bank/delete', ['uses' => 'BankController@destroy', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);




//Access Control
Route::get('/access/createroles', ['uses' => 'AccessController@create_roles', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/access/createrole', ['uses' => 'AccessController@create_r', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/access/roles', ['uses' => 'AccessController@assignrole', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/access/role', ['uses' => 'AccessController@link', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/access/access', ['uses' => 'AccessController@accessview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/access/store', ['uses' => 'AccessController@store', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/access/state', ['uses' => 'AccessController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/access/status', ['uses' => 'AccessController@status', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/test/test', ['uses' => 'AccessController@test', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Logs
Route::get('/logs/display', ['uses' => 'LogsController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Cues
Route::get('/cues/display', ['uses' => 'KeyController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/cues/create', ['uses' => 'KeyController@creatview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/cues/creates', ['uses' => 'KeyController@creates', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/cues/delete', ['uses' => 'KeyController@destroy', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Tellers
Route::post('/tellers/display', ['uses' => 'EmployeeController@display_teller', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/teller/make', ['uses' => 'EmployeeController@teller_create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Guest User
Route::get('/access/userhome', ['uses' => 'UserHomeController@index' ]);

//statistics
Route::post('/statistics', ['uses' => 'StatisticsController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//COS
Route::get('/cos/display', ['uses' => 'COSController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/cos/create', ['uses' => 'COSController@createview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/cos/create', ['uses' => 'COSController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/cos/updateview', ['uses' => 'COSController@updateview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/cos/delete', ['uses' => 'COSController@destroy', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/cos/id', ['uses' => 'COSController@where_id', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/cos/update', ['uses' => 'COSController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Wallet Services
//Account Management
Route::GET('/wallet/link', ['uses' => 'WalletServiceController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet/preauth', ['uses' => 'WalletServiceController@show', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet/link_card', ['uses' => 'WalletServiceController@link_card', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Wallet Configs
Route::GET('/wallet_configurations/create', ['uses' => 'WalletConfigController@create_e_value', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet_configurations/preauth', ['uses' => 'WalletConfigController@create_e_value_preauth', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet_configurations/value', ['uses' => 'WalletConfigController@value', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/wallet_configurations/display', ['uses' => 'WalletCOSController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/wallet_configurations/create_cos', ['uses' => 'WalletCOSController@create_cos', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet_configurations/create_cos_', ['uses' => 'WalletCOSController@create_cos_', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/wallet_configurations/summaries', ['uses' => 'WalletCOSController@summaries', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/wallet_configurations/display_pending', ['uses' => 'WalletConfigController@display_pending', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/wallet_configurations/display_pendings', ['uses' => 'WalletConfigController@display_pendings', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/wallet_configurations/create_value', ['uses' => 'WalletConfigController@create_value', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/wallet_configurations/search', ['uses' => 'WalletConfigController@search', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/wallet_configurations/transactions', ['uses' => 'WalletConfigController@wallet_transactions', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Destroy E-Value.
Route::get('/wallet_configurations/destroy_view', ['uses' => 'WalletConfigController@destroy_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet_configurations/preauth_d', ['uses' => 'WalletConfigController@preauth_d', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet_configurations/value_d', ['uses' => 'WalletConfigController@value_d', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet_configurations/destroy_value', ['uses' => 'WalletConfigController@destroy_value', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Update COS.
Route::POST('/wallet_configurations/update_view', ['uses' => 'WalletConfigController@update_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet_configurations/update', ['uses' => 'WalletConfigController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Delete Cos
Route::POST('/wallet_configurations/cos_d', ['uses' => 'WalletConfigController@cos_d', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Mutliple
Route::GET('/multiple/search', ['uses' => 'MultipleAccountController@search', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/multiple/preauth', ['uses' => 'MultipleAccountController@preauth', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/multiple/remove', ['uses' => 'MultipleAccountController@remove', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/multiple/add', ['uses' => 'MultipleAccountController@add', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/multiple/add_account', ['uses' => 'MultipleAccountController@add_account', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/multiple/statement', ['uses' => 'MultipleAccountController@statement', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/multiple/statements', ['uses' => 'MultipleAccountController@statements', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Adjustment
Route::GET('/wallet_configurations/adjustment_view', ['uses' => 'WalletConfigController@adjustment_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet_configurations/adjustment_preauth', ['uses' => 'WalletConfigController@adjustment_preauth', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet_configurations/adjust', ['uses' => 'WalletConfigController@adjust', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/wallet_configurations/agent_registration', ['uses' => 'WalletConfigController@register_home', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet_configurations/register/agent', ['uses' => 'WalletConfigController@register', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Wallet Management
Route::GET('/wallet/update_view', ['uses' => 'WalletManagementController@update_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet/preauth', ['uses' => 'WalletManagementController@preauth', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet/update', ['uses' => 'WalletManagementController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//PIN Reset
Route::GET('/wallet/reset_view', ['uses' => 'WalletManagementController@reset_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet/reset', ['uses' => 'WalletManagementController@reset', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/wallet/reset_preauth', ['uses' => 'WalletManagementController@reset_preauth', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Authentication Services
Route::GET('/authentication/display', ['uses' => 'AuthenticationServiceController@display', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/authentication/createview', ['uses' => 'AuthenticationServiceController@create_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/authentication/create', ['uses' => 'AuthenticationServiceController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/authentication/updateview', ['uses' => 'AuthenticationServiceController@updateview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/authentication/update', ['uses' => 'AuthenticationServiceController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Authentication Roles Services
Route::GET('/roles/display', ['uses' => 'AuthRolesController@display', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/roles/createview', ['uses' => 'AuthRolesController@create_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/roles/create', ['uses' => 'AuthRolesController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::GET('/roles/search', ['uses' => 'AuthRolesController@search', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/roles/search_user', ['uses' => 'AuthRolesController@search_user', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::POST('/roles/update_user', ['uses' => 'AuthRolesController@update_user', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);


//Permissions

Route::get('/permissions/display', ['uses' => 'PermissionsController@display', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/permissions/create_permissions', ['uses' => 'PermissionsController@create_permissions', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/permissions/create', ['uses' => 'PermissionsController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/permissions/edit', ['uses' => 'PermissionsController@edit', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/permissions/update_profile', ['uses' => 'PermissionsController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/error/401', ['uses' => 'PermissionsController@error', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/permissions/users', ['uses' => 'PermissionsController@users', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//IB Dasboards & Transactions
Route::get('/internet/dashboard', ['uses' => 'IBDashController@dashboard', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/internet/transactions', ['uses' => 'IBTransactionsController@index', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/internet/airtime', ['uses' => 'IBTransactionsController@airtime', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/internet/electricity', ['uses' => 'IBTransactionsController@electricity', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/internet/ecocash', ['uses' => 'IBTransactionsController@ecocash', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/between_dates', ['uses' => 'IBTransactionsController@between_dates', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/internet/rtgs', ['uses' => 'IBTransactionsController@rtgs', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/process_rtgs', ['uses' => 'IBTransactionsController@process_rtgs', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Corporate
Route::get('/corporates/display', ['uses' => 'IBCorporateController@display', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/corporates/createview', ['uses' => 'IBCorporateController@createview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/corporate/accountmanagement/lookup', ['uses' => 'IBCorporateController@show', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/corporate/accountmanagement/create', ['uses' => 'IBCorporateController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/corporate/delete', ['uses' => 'IBCorporateController@delete', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/corporate/users', ['uses' => 'IBCorporateController@users', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/corporate/createuser', ['uses' => 'IBCorporateController@createuser', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/corporate/view', ['uses' => 'IBCorporateController@view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/corporate/accounts', ['uses' => 'IBCorporateController@accounts', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/corporate/accountmanagement/add_lookup', ['uses' => 'IBCorporateController@add_lookup', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/corporate/accountmanagement/account_create', ['uses' => 'IBCorporateController@account_create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//IB Products
Route::get('/internet/products/display', ['uses' => 'IBProductsController@display', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/internet/products/createview', ['uses' => 'IBProductsController@createview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/products/create', ['uses' => 'IBProductsController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/products/id', ['uses' => 'IBProductsController@editview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/products/edit', ['uses' => 'IBProductsController@edit', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/products/delete', ['uses' => 'IBProductsController@delete', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//IB Fees
Route::get('/internet_fees/display', ['uses' => 'IBFeesController@display', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/internet/fee/createview', ['uses' => 'IBFeesController@createview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/fee/create', ['uses' => 'IBFeesController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/fee/update', ['uses' => 'IBFeesController@updateview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/fee/updates', ['uses' => 'IBFeesController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Update Profiles
Route::get('/internet/search', ['uses' => 'IBPINStatusController@search', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/preauth', ['uses' => 'IBPINStatusController@preauth', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/update/mobile', ['uses' => 'IBPINStatusController@update', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/pin/reset', ['uses' => 'IBPINStatusController@reset', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/internet/internet/updates', ['uses' => 'IBPINStatusController@internet_updates', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Employees
Route::post('/employee/createview', ['uses' => 'EmployeeController@create_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/employee/create', ['uses' => 'EmployeeController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/employee/creates', ['uses' => 'EmployeeController@creates', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//bulk Disbursements
Route::get('/disburse/display', ['uses' => 'WalletDisbursementController@display', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/disburse/createview', ['uses' => 'WalletDisbursementController@createview', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/disburse/create', ['uses' => 'WalletDisbursementController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/disburse/approve', ['uses' => 'WalletDisbursementController@disburse', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/disburse/reports', ['uses' => 'WalletDisbursementController@reports', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/disburse/cancel', ['uses' => 'WalletDisbursementController@cancel', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/sample.csv', ['uses' => 'WalletDisbursementController@download', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//Pos Users
Route::post('/pos/display_employees', ['uses' => 'PosUsersController@display_employees', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/pos/edit_employees', ['uses' => 'PosUsersController@edit_employees', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/pos_employees/create', ['uses' => 'PosUsersController@create', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);

//EFT
Route::get('/eft/status', ['uses' => 'EFTController@status', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/eft/restart', ['uses' => 'EFTController@restart_view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/eft/restarts', ['uses' => 'EFTController@restart', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::get('/eft/incoming', ['uses' => 'EFTController@incoming', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/eft/search', ['uses' => 'EFTController@search', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);
Route::post('/eft/view', ['uses' => 'EFTController@view', 'as' => 'Admin', 'middleware' => 'role', 'roles' => ['Admin']]);




Route::POST('/login/internet/preauth', [ 'uses' =>'AuthServerController@login_service']);

Route::get('/migrate','MigrationsController@index');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

Route::get('/', ['middleware' => 'auth', 'uses' =>'HomeController@index'])->name('home');



