<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\{AddProductRequest,EditProductRequest};
use App\models\{product,category};
use Illuminate\Support\Str;

class ProductController extends Controller
{
    function ListProduct()
    {
        $data['products']=product::paginate(15);
        return view('backend.product.listproduct',$data);
    }

    function GetAddProduct()
    {
        $data['category']=category::all();
        return view('backend.product.addproduct',$data);
    }

    function PostAddProduct(AddProductRequest $r)
    {
        $prd = new product;
        $prd->code = $r->code ;
        $prd->name = $r->name ;
        $prd->slug = Str_slug($r->name) ;
        $prd->price = $r->price ;
        $prd->featured = $r->featured ;
        $prd->state = $r->state ;
        if ($r->hasFile('img')) 
        {
            $file = $r->img;
            $file_name = Str::slug($r->name,'-').'.'.$file->getClientOriginalExtension();
            $file->move('backend/img',$file_name);
            $prd->img = $file_name;
        }
        else 
        {
            $prd->img = 'no-img.jpg';
        }
        $prd->info = $r->info ;
        $prd->describe = $r->describe ;
        $prd->category_id= $r->category;
        $prd->save();

        return redirect('admin/product')->with('thongbao','Đã thêm sản phẩm thành công!')->withInput();
    }

    function GetEditProduct($id)
    {
        $data['category']=category::all();
        $data['product']=product::find($id);
        return view('backend.product.editproduct',$data);
    }

    function PostEditProduct(EditProductRequest $r,$id)
    {
        $prd = product::find($id);
        $prd->code = $r->code ;
        $prd->name = $r->name ;
        $prd->slug = Str_slug($r->name) ;
        $prd->price = $r->price ;
        $prd->featured = $r->featured ;
        $prd->state = $r->state ;
        if ($r->hasFile('img')) 
        {
            if($prd->img!='no-img.jpg')
            {
                unlink('backend/img/'.$prd->img);
            }
            $file = $r->img;
            $file_name = Str::slug($r->name,'-').'.'.$file->getClientOriginalExtension();
            $file->move('backend/img',$file_name);
            $prd->img = $file_name;
        }
       
        $prd->info = $r->info ;
        $prd->describe = $r->describe ;
        $prd->category_id= $r->category;
        $prd->save();
        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }

    function DelProduct($id)
    {
        product::destroy($id);
        return redirect()->back()->with('thongbao2','Đã xóa sản phẩm thành công!');
    }
}
