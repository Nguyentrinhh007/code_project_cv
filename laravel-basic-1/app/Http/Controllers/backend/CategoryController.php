<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\{AddCategoryRequest,EditCategoryRequest};
use App\models\category;
// use Illuminate\Support\Str; ( $cate->slug = Str::slug($r->name,'-');)

class CategoryController extends Controller
{
    function GetCategory()
    {
        $data['category']=category::all();
        return view('backend.category.category',$data);
    }

    function PostCategory(AddCategoryRequest $r)
    {
        if( GetLevel(category::all()->toarray(),$r->parent,1)>2 )
        {
            return redirect()->back()->with('error','Giao diện không hỗ trợ danh mục 3 cấp');
        }
        $cate = new category;
        $cate->name = $r->name;
        $cate->parent = $r->parent;
        $cate->slug = Str_slug($r->name,'-');
        $cate->save();
        return redirect()->back()->with('thongbao','Đã thêm danh mục thành công!');
    }

    function GetEditCategory($id)
    {
        $data['cate']=category::find($id);
        $data['category']=category::all();
        return view('backend.category.editcategory',$data);
    }

    function PostEditCategory(EditCategoryRequest $r,$id)
    {
        $cate=category::find($id);
        $cate->name = $r->name;
        $cate->parent = $r->parent;
        $cate->slug = Str_slug($r->name,'-');
        $cate->save();
        return redirect()->back()->with('thongbao','Đã sửa danh mục thành công!');
    }

    function DelCategory($id)
    {
        category::destroy($id);        
        return redirect()->back()->with('thongbao','Đã xóa thành công!');   
    }
}
