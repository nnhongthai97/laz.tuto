<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\SellerModel;


class SellerController extends Controller
{
    //Hàm khởi tạo của class
    //Hàm này sẽ luôn chạy trước các hàm khác trong class
    //SellerController constructor
    public function __construct(){
        $this->middleware('auth:seller')->only('index');
    }
    /*
     * Phương thức trả về view khi đăng ký tài khoản seller thành công
     * @return\Illuminate\Contract\View\Factory\Illuminate\View\View
     * */
    public function index(){
        return view('seller.dashboard');
    }
    /*
     * Phương thức trả về view khi đăng ký tài khoản seller
     * @return\Illuminate\Contract\View\Factory\Illuminate\View\View
     * */
    public function create(){
        return view('seller.auth.register');
    }
    public function store(Requets $requets){

        //validate dữ liệu được gửi từ form đi
        $this->validate($requets, array(
            'name'=> 'required',
            'email'=> 'required',
            'password'=> 'required'
        ));
        //Khởi tạo đẻ lưu admin mới
        $sellerModel = new SellerModel();
        $sellerModel->name = $requets->name;
        $sellerModel->email = $requets->email;
        $sellerModel->password = bcrypt($requets->password);
        $sellerModel->save();

        return redirect()->route('seller.auth.login');
    }
}
