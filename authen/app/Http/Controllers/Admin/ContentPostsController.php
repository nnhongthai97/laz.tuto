<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ContentPostModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ContentPostsController extends Controller
{
    //
    public function index(){

        $items = DB::table('content_posts')->paginate(10);
        /*
         * Đây là phương thức index
         * */
        $data = array();
        $data['posts'] = $items;
        return view('admin.content.content.post.index',$data);
    }
    public function create(){
        /*
         * Đây là đây là phương thức create
         * */
        $data = array();
        $cats = ContentPostModel::all();
        $data['cats'] = $cats;
        return view('admin.content.content.post.submit',$data);
    }
    public function edit($id){
        /*
         * Đây là phương thức edit
         * */
        $data = array();

        $iteam = ContentPostModel::find($id);
        $data['post'] = $iteam;

        $cats = ContentPostModel::all();
        $data['cats'] = $cats;
        return view('admin.content.content.post.edit',$data);

    }
    public function delete($id){
        /*
         * Đây là phương thức delete
         * */
        $data = array();

        $iteam = ContentPostModel::find($id);
        $data['post'] = $iteam;
        return view('admin.content.content.post.delete',$data);

    }
    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'images' => 'required',
            'intro' => 'required',
            'desc' => 'required',
        ]);
        $input = $request->all();
        $item = new ContentPostModel();
        $item->name = $input['name'];
        $item->slug = $input['slug'] ? $this->slugify($input['slug']) : $this->slugify($input['name']);
        $item->images = $input['images'];
        $item->author_id = isset($input['author_id']) ? $input['author_id'] : 0;
        $item->view = isset($input['view']) ? $input['view'] : 0;
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->cat_id = $input['cat_id'];
        $item->save();
        return redirect('/admin/content/post');
    }
    public function update(Request $request ,$id){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'images' => 'required',
            'intro' => 'required',
            'desc' => 'required',
        ]);
        $input = $request->all();
        $item = ContentPostModel::find($id);
        $item->name = $input['name'];
        $item->slug = $input['slug'] ? $this->slugify($input['slug']) : $this->slugify($input['name']);
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->author_id = isset($input['author_id']) ? $input['author_id'] : 0;
        $item->view = isset($input['view']) ? $input['view'] : 0;
        $item->desc = $input['desc'];
        $item->cat_id = $input['cat_id'];
        $item->save();
        return redirect('/admin/content/post');

    }
    public function destroy($id) {
        $item = ContentPostModel::find($id);
        $item->delete();
        return redirect('/admin/content/post');
    }
    public function slugify($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
}
