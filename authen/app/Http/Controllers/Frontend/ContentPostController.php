<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Front\ContentPostModel;

class ContentPostController extends Controller
{
    //
    public function detail($id) {
        $item = ContentPostModel::find($id);
        $data = array();
        $data['post'] = $item;
        return view('frontend.content.post.detail', $data);
    }
}
