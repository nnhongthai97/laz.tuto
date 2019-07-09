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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/*
 * route cho administrator
 */
Route::prefix('admin')->group(function (){
    //gom nhóm các route cho admin
    //URL:authen.com/admin
    //Route mặc định
    Route::get('/' , 'AdminController@index')->name('admin.dashboard');
    //URL:authen.com/admin/dashboard
    //Route đăng nhập thành công
    Route::get('/dashboard','AdminController@index')->name('admin.dashboard');
    /*
     * URL:authen.com/admin/register
     * Route trả về view dùng để đằng ký tài khoản admin
     * */
    Route::get('/register','AdminController@create')->name('admin.register');
    /*
     *URL:authen/admin/register
     * Phương thức là POST
     * Route dùng để đăng ký 1 admin từ form POST
     * */
    Route::post('register' , 'AdminController@store')->name('admin.register.store');
    /*
     * Route sẽ trả về view dăng nhập admin
     *URL:authen/admin/login
     * METHOD:GET
     * */
    Route::get('login','Auth\Admin\LoginController@login')->name('admin.auth.login');

    /*Route xử lý quá trình đăng nhập admin
     * authen/admin/login
     * METHOD:POST
     * URL:authen/admin/logout
     * */
    Route::post('login' , 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
    /*
     * METHOD:POST
     * Route dùng để đăng xuất
     * */
    Route::post('logout' , 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');
});