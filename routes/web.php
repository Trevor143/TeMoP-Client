<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create.blade.php something great!
|
*/

use App\Bid;
use App\Company;
use App\Tender;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();


Route::group([
    'prefix' => 'user',
    'middleware'=>['web', 'auth'],
    ],
    function ()
    {
        Route::resource('company', 'CompanyController');
        Route::resource('home','DashboardController');
        Route::resource('tender', 'TenderController');
        Route::resource('account', 'UserDetailController');
        Route::resource('bid', 'BidController');
        Route::post('account/password', 'UserDetailController@password')->name('password');
        Route::get('tender/{id}/bid', 'BidController@bid')->name('bid');

});

Route::get('/test/{id}', function ($id){
//    Storage::disk('backpack')->put('file.txt', 'Contents');
$bid = Bid::find($id);
return $bid->company;
});

Route::get('/test/create', function () {
    return view('admin.tender.create');
});


