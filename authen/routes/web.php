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
    return view('frontend.homepages.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/*
 * route cho administrator
 */
Route::prefix('admin')->group(function(){
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

    Route::get('shop/category' ,'Admin\ShopCategoryController@index');
    Route::get('shop/category/create','Admin\ShopCategoryController@create');
    Route::get('shop/category/{id}/edit','Admin\ShopCategoryController@edit');
    Route::get('shop/category/{id}/delete','Admin\ShopCategoryController@delete');

    Route::post('shop/category/','Admin\ShopCategoryController@store');
    Route::post('shop/category/{id}','Admin\ShopCategoryController@update');
    Route::post('shop/category/{id}','Admin\ShopCategoryController@destroy');



    Route::get('shop/product' , function (){
        return view('admin.content.shop.product.index');
    });
    Route::get('shop/customer' , function (){
        return view('admin.content.shop.customer.index');
    });
    Route::get('shop/order' , function (){
        return view('admin.content.shop.order.index');
    });
    Route::get('shop/review' , function (){
        return view('admin.content.shop.review.index');
    });
    Route::get('shop/statistic' , function (){
        return view('admin.content.shop.statistic.index');
    });
    Route::get('shop/brand' , function (){
        return view('admin.content.shop.brand.index');
    });
    Route::get('shop/product/order' , function (){
        return view('admin.content.shop.adminorder.index');
    });
    Route::get('shop/product/order' , function (){
        return view('admin.content.shop.category.index');
    });


    Route::get('content/category' , function (){
        return view('admin.content.content.category.index');
    });
    Route::get('content/post' , function (){
        return view('admin.content.content.post.index');
    });
    Route::get('content/page' , function (){
        return view('admin.content.content.page.index');
    });
    Route::get('content/tag' , function (){
        return view('admin.content.content.tag.index');
    });

    //quản trị nội dung admin menu
    Route::get('/menu' , function (){
        return view('admin.content.menu.index');
    });
    Route::get('/menuitems' , function (){
        return view('admin.content.menuitems.index');
    });

    //quản lý admin user
    Route::get('/users' , function (){
        return view('admin.content.users.index');
    });
    Route::get('/media' , function (){
        return view('admin.content.media.index');
    });
    Route::get('/config' , function (){
        return view('admin.content.config.index');
    });
    Route::get('/newletters' , function (){
        return view('admin.content.newletters.index');
    });
    Route::get('/contacts' , function (){
        return view('admin.content.contacts.index');
    });
    Route::get('/banners' , function (){
        return view('admin.content.banners.index');
    });
    //email
    Route::get('email/inbox' , function (){
        return view('admin.email.index');
    });
    Route::get('email/draf' , function (){
        return view('admin.email.draf');
    });
    Route::get('email/send' , function (){
        return view('admin.email.send');
    });




});
/*
 * Route cho các nhà cung cấp(seller)
 * */
Route::prefix('seller')->group(function (){

    //gom nhóm các route cho seller
    //URL:authen.com/seller
    //Route mặc định cho seller

    Route::get('/' , 'SellerController@index')->name('seller.dashboard');
    //URL:authen.com/seller/dashboard
    //Route đăng nhập thành công
    Route::get('/dashboard','SellerController@index')->name('seller.dashboard');
    /*
     * URL:authen.com/seller/register
     * Route trả về view dùng để đằng ký tài khoản seller
     * */
    Route::get('/register','SellerController@create')->name('seller.register');
    /*
     *URL:authen/seller/register
     * Phương thức là POST
     * Route dùng để đăng ký 1 seller từ form POST
     * */
    Route::post('register' , 'SellerController@store')->name('seller.register.store');
    /*
     * Route sẽ trả về view dăng nhập seller
     *URL:authen/seller/login
     * METHOD:GET
     * */
    Route::get('login','Auth\Seller\LoginController@login')->name('seller.auth.login');

    /*Route xử lý quá trình đăng nhập seller
     * authen/seller/login
     * METHOD:POST
     * URL:authen/seller/logout
     * */
    Route::post('login' , 'Auth\Seller\LoginController@loginSeller')->name('seller.auth.loginSeller');
    /*
     * METHOD:POST
     * Route dùng để đăng xuất
     * */
    Route::post('logout' , 'Auth\Seller\LoginController@logout')->name('seller.auth.logout');


});
/*
 * Route cho các nhà vận chuyển(shipper)
 * */

Route::prefix('shipper')->group(function (){
    //gom nhóm các route cho shipper
    //URL:authen.com/shipper
    //Route mặc định cho shipper

    Route::get('/' , 'ShipperController@index')->name('shipper.dashboard');
    //URL:authen.com/shipper/dashboard
    //Route đăng nhập thành công
    Route::get('/dashboard','ShipperController@index')->name('shipper.dashboard');
    /*
     * URL:authen.com/shipper/register
     * Route trả về view dùng để đằng ký tài khoản shipper
     * */
    Route::get('/register','ShipperController@create')->name('shipper.register');
    /*
     *URL:authen/shipper/register
     * Phương thức là POST
     * Route dùng để đăng ký 1 shipper từ form POST
     * */
    Route::post('register' , 'ShipperController@store')->name('shipper.register.store');
    /*
    * Route sẽ trả về view dăng nhập seller
    *URL:authen/shipper/login
    * METHOD:GET
    * */
    Route::get('login','Auth\Shipper\LoginController@login')->name('shipper.auth.login');

    /*Route xử lý quá trình đăng nhập shipper
     * authen/shipper/login
     * METHOD:POST
     * URL:authen/shipper/logout
     * */
    Route::post('login' , 'Auth\Shipper\LoginController@loginShipper')->name('shipper.auth.loginShipper');
    /*
    * METHOD:POST
    * Route dùng để đăng xuất
    * */
    Route::post('logout' , 'Auth\Shipper\LoginController@logout')->name('shipper.auth.logout');
});

