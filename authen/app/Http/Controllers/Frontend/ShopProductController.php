<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Front\ShopProductModel;

class ShopProductController extends Controller
{
    //
    public function detail($id) {
        $item = ShopProductModel::find($id);
        $data = array();
        $data['product'] = $item;
        return view('frontend.shop.product.detail', $data);
    }
}
