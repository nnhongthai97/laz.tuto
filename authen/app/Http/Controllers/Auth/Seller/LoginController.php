<?php

namespace App\Http\Controllers\Auth\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest:seller')->except('logout');

    }
    /*
     * Phương thức này để trả về view dùng để đăng nhập cho phấn seller
     * */
    public function login(){
        return view('seller.auth.login');
    }
    /*
     * Phương thức này dùng để đăng nhập cho seller
     * lấy thông tin từ form có METHOD là POST
     * */
    public function loginSeller(Request $requets){
        //validate dữ liệu đăng nhập
        $this->validate($requets, array(
            'email'=>'required|email',
            'password'=>'required|min:6',
            //Đăng nhập
        ));
        if(Auth::guard('seller')->attempt(
            ['email'=> $requets->email,'password'=>$requets->password],$requets->remember
        )){
            //nếu đăng nhập thành công thì sẽ chuyển hướng về view dashboard của admin
            return redirect()->intended(route('seller.dashboard'));
        }
        //nếu đăng nhập thất bại thì quay trở về form đăng nhập
        //với 2 gía trị của ô input cũ là email và remmember
        return redirect()->back()->withInput($requets->only('email', 'remember'));
    }
    /*
    * Phương thức này dùng để đăng xuất
    * */
    public function logout(){
        Auth::guard('seller')->logout();

        //chuyển hướng về trang login
        return redirect()->route('seller.auth.login');
    }
}
