<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\ShopCategoryModel;
use Illuminate\Support\Facades\DB;

class ShopCategoryController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){

        $items = DB::table('shop_category')->paginate(10);
        /*
         * Đây là phương thức index
         * */
        $data = array();
        $data['cats'] = $items;
        return view('admin.content.shop.category.index',$data);
    }
    public function create(){
        /*
         * Đây là đây là phương thức create
         * */
        $data = array();
        return view('admin.content.shop.category.submit',$data);
    }
    public function edit($id){
        /*
         * Đây là phương thức edit
         * */
        $data = array();
        $iteam = ShopCategoryModel::find($id);
        $data['cat'] = $iteam;
        return view('admin.content.shop.category.edit',$data);

    }
    public function delete($id){
        /*
         * Đây là phương thức delete
         * */
        $data = array();

        $iteam = ShopCategoryModel::find($id);
        $data['cat'] = $iteam;
        return view('admin.content.shop.category.delete',$data);

    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',
            'intro' => 'required',
            'desc' => 'required',
        ]);

        $input = $request->all();
        $item = new ShopCategoryModel();

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->save();
        return redirect('/admin/shop/category');

    }
    public function update(Request $request ,$id){
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required',
            'images' => 'required',
            'intro' => 'required',
            'desc' => 'required',
        ]);

        $input = $request->all();

        $item = ShopCategoryModel::find($id);

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->save();
        return redirect('/admin/shop/category');

    }
    public function destroy($id) {
        $item = ShopCategoryModel::find($id);
        $item->delete();
        return redirect('/admin/shop/category');
    }
}
