<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ContentCategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ContentCategoryController extends Controller
{
    //
    public function index(){

        $items = DB::table('content_category')->paginate(10);
        /*
         * Đây là phương thức index
         * */
        $data = array();
        $data['cats'] = $items;
        return view('admin.content.content.category.index',$data);
    }

    public function create(){
        /*
         * Đây là đây là phương thức create
         * */
        $data = array();
        return view('admin.content.content.category.submit',$data);
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
        $item = new ContentCategoryModel();

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->save();
        return redirect('/admin/category/category');

    }
    public function edit($id){
        /*
         * Đây là phương thức edit
         * */
        $data = array();
        $iteam = ContentCategoryModel::find($id);
        $data['cat'] = $iteam;
        return view('admin.content.content.category.edit',$data);

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

        $item = ContentCategoryModel::find($id);

        $item->name = $input['name'];
        $item->slug = $input['slug'];
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->desc = $input['desc'];
        $item->save();
        return redirect('/admin/content/category');

    }
    public function destroy($id) {
        $item = ContentCategoryModel::find($id);
        $item->delete();
        return redirect('/admin/content/category');
    }
    public function delete($id){
        /*
         * Đây là phương thức delete
         * */
        $data = array();

        $iteam = ContentCategoryModel::find($id);
        $data['cat'] = $iteam;
        return view('admin.content.content.category.delete',$data);

    }
}
