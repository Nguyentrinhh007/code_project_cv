<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use Illuminate\Http\Request;
use App\models\category;

class CategoryController extends Controller
{
    function getCategory() {
        $data['category']=category::all();
        return view('backend.category.category',$data);
    }
    function postAddCategory(AddCategoryRequest $r) {
        $cate=new category;
        $cate->name=$r->name;
        $cate->parent=$r->parent;
        $cate->save();
        return redirect()->back()->with('thongbao','Đã thêm danh mục thành công');
    }

    function editCategory($id) {
        $data['cate']=category::find($id);
        $data['category']=category::all();

        return view('backend.category.editcategory',$data);
    }
    // function postEditCategory(EditCategoryRequest $r) {
    //     return view('backend.category.editcategory');
    // }
    function postEditCategory(EditCategoryRequest $r,$id)
    {
     $cate=category::find($id);
     $cate->name=$r->name;
     $cate->parent=$r->parent;
     $cate->save();
     return redirect()->back()->with('thongbao','Đã sửa thành công');
    }

    function delCategory($id){
        category::destroy($id);
        return redirect()->back()->with('thongbao','Đã xóa thành công !');
    }
}
