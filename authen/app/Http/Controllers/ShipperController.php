<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ShipperModel;
use App\Http\Controllers\Controller;

class ShipperController extends Controller
{
    //Hàm khởi tạo của class
    //Hàm này sẽ luôn chạy trước các hàm khác trong class
    //ShipperController constructor
    public function __construct(){
        $this-> middleware('auth:shipper')->only('index');
    }
    /*
    * Phương thức trả về view khi đăng ký tài khoản seller thành công
    * @return\Illuminate\Contract\View\Factory\Illuminate\View\View
    * */
    public function index(){
        return view('shipper.dashboard');
    }
    /*
     * Phương thức trả về view khi đăng ký tài khoản seller
     * @return\Illuminate\Contract\View\Factory\Illuminate\View\View
     * */
    public function create(){
        return view('shipper.auth.register');
    }
    public function store(Requets $requets){

        //validate dữ liệu được gửi từ form đi
        $this->validate($requets, array(
            'name'=> 'required',
            'email'=> 'required',
            'password'=> 'required'
        ));
        //Khởi tạo đẻ lưu admin mới
        $sellerModel = new ShipperModel();
        $sellerModel->name = $requets->name;
        $sellerModel->email = $requets->email;
        $sellerModel->password = bcrypt($requets->password);
        $sellerModel->save();

        return redirect()->route('shipper.auth.login');
    }

}
