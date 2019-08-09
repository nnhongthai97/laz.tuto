<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ShopCategoryModel;
use App\Model\Admin\ShopProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShopProductController extends Controller
{
    //
    public function index(){
        $items = DB::table('shop_products')->paginate(10);
        /*
         * Đây là phương thức index
         * */
        $data = array();
        $data['products'] = $items;
        return view('admin.content.shop.product.index',$data);
    }

    public function create(){
        /*
         * Đây là phương thức create
         * */
        $data = array();
        $cats = ShopCategoryModel::all();
        $data['cats'] = $cats;
        return view('admin.content.shop.product.submit',$data);


    }

    public function edit($id){
        /*
         * Đây là phương thức edit
         * */
        $data = array();

        $iteam = ShopProductModel::find($id);
        $data['product'] = $iteam;

        $cats = ShopCategoryModel::all();
        $data['cats'] = $cats;
        return view('admin.content.shop.product.edit',$data);
    }

    public function delete($id){
        /*
         * Đây là phương thức delete
         * */
        $data = array();

        $iteam = ShopProductModel::find($id);
        $data['product'] = $iteam;
        return view('admin.content.shop.product.delete',$data);

    }

    public function store(Request $request){

        /*
         * Đây là phương thức store
         * */
        $input = $request->all();

        $item = new ShopProductModel();

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->princeCore = $input['priceCore'];
        $item->princSale = $input['priceSale'];
        $item->stock = $input['stock'];
        $item->cat_id = $input['cat_id'];
        $item->save();
        return redirect('/admin/shop/product');


    }

    public function update(Request $request ,$id){
        $input = $request->all();

        $item = ShopProductModel::find($id);

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->priceCore = $input['priceCore'];
        $item->priceSale = $input['priceSale'];
        $item->stock = $input['stock'];
        $item->cat_id = $input['cat_id'];
        $item->save();
        return redirect('/admin/shop/product');

    }

    public function destroy($id){
        $item = ShopCategoryModel::find($id);
        $item->delete();
        return redirect('/admin/shop/product');


    }
}
