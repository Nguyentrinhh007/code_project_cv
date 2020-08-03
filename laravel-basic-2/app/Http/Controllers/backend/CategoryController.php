<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\{AddCategoryRequest,EditCategoryRequest };
use App\models\category;

class CategoryController extends Controller
{
    function GetCategory()
    {
        $data['categorys'] = category::all();
        return view('backend.category.category',$data);
    }

    function PostAddCategory(AddCategoryRequest $r)
    {
        // Đếm cấp danh mục tránh vỡ giao diện
        // if( GetLevel(category::all()->toarray(),$r->parent,1)>2 )
        // {
        //     return redirect()->back()->with('error','Giao diện không hỗ trợ danh mục 3 cấp');
        // }
        $cate = new category;
        $cate->name = $r->name;
        $cate->parent = $r->parent;
        $cate->save();
        
        return redirect()->back()->with('thongbao','Đã thêm danh mục thành công!');
        
    }

    function EditCategory($id)
    {
        $data['cate'] = category::find($id);
        $data['categorys'] = category::all();
        return view('backend.category.editcategory',$data);
    }

    function PostEditCategory(EditCategoryRequest $r,$id)
    {
        $cate=category::find($id);
        $cate->name = $r->name;
        $cate->parent = $r->parent;
        $cate->save();
        
        return redirect()->back()->with('thongbao','Đã sửa danh mục thành công!');
        
    }

    function DelCategory($id)
    {
        category::destroy($id);
        return redirect()->back()->with('thongbao','Đã xóa danh mục');
    }
}
