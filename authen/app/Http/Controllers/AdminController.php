<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\AdminModel;

class AdminController extends Controller
{
    //Hàm khởi tạo của class
    //Hàm này sẽ luôn chạy trước các hàm khác trong class
    //AdminController constructor
    public function __construct(){
        $this->middleware('auth:admin')->only('index');
    }
    /*
     * Phương thức trả về view khi đăng ký tài khoản admin thành công
     * @return\Illuminate\Contract\View\Factory\Illuminate\View\View
     * */
    public function index(){
        return view('admin.dashboard');
    }
    /*
     * Phương thức trả về view khi đăng ký tài khoản admin
     * @return\Illuminate\Contract\View\Factory\Illuminate\View\View
     * */
    public function create(){
        return view('admin.auth.register');
    }

    public function store(Requets $requets){

        //validate dữ liệu được gửi từ form đi
        $this->validate($requets, array(
            'name'=> 'required',
            'email'=> 'required',
            'password'=> 'required'
        ));
        //Khởi tạo đẻ lưu admin mới
        $adminModel = new AdminModel();
        $adminModel->name = $requets->name;
        $adminModel->email = $requets->email;
        $adminModel->password = bcrypt($requets->password);
        $adminModel->save();

        return redirect()->route('admin.auth.login');
    }
}
