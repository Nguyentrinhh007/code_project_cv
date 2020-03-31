<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\{AddProductRequest,EditProductRequest,AddAttrRequest,EditAttrRequest,AddValueRequest,EditValueRequest};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use  App\models\{product,attribute,values,category,variant};
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function listProduct() {
        $data['products']=product::paginate(6);
        return view('backend.product.listproduct',$data);
    }

    function addProduct() {
        $data['category']=category::all();
        $data['attrs']=attribute::all();
        return view('backend.product.addproduct',$data);
    }
    function postAddProduct(AddProductRequest $r) {
        // dd($r->all());
        $product=new product;
        $product->product_code=$r->product_code ;
        $product->name=$r->product_name ;
        $product->price=$r->product_price ;
        $product->featured=$r->featured ;
        $product->state=$r->product_state ;
        $product->info=$r->info ;
        $product->describe=$r->description ;
            if($r->hasFile('product_img'))
            {
            $file = $r->product_img;
            $filename=Str::random(9).'.'. $file->getClientOriginalExtension();
            // $filename= $file->getClientOriginalExtension();
            $file->move('backend/img', $filename);
            $product->img= $filename;
            }
            else {
            $product->img='no-img.jpg';
            }

        $product->category_id= $r->category;
        $product->save();
        if($r->attr!=NULL){
        $mang=array();
        foreach($r->attr as $value)
        {
            foreach($value as $item)
            {
            $mang[]= $item;
            }
        }
        $product->values()->Attach($mang);

        $variant=get_combinations($r->attr);

        foreach($variant as $var)
        {
            $vari=new variant;
            $vari->product_id=$product->id;
            $vari->save();
            $vari->values()->Attach($var);
        }
        return redirect('admin/product/add_variant/'.$product->id);
    }
    else {
        return redirect('admin/product');
    }

    }

    function editProduct(request $r,$id) {
        $data['product']=product::find($id);
        $data['category']=category::all();
        $data['attrs']=attribute::all();
        return view('backend.product.editproduct',$data);    }
    function postEditProduct(EditProductRequest $r,$id) {
        $product = product::find($id);
        $product->product_code=$r->product_code ;
        $product->name=$r->product_name ;
        $product->price=$r->product_price ;
        $product->featured=$r->featured ;
        $product->state=$r->product_state ;
        $product->info=$r->info ;
        $product->describe=$r->description ;
            if($r->hasFile('product_img'))
            {
                if($product->img!='no-img.jpg')
                {
                   unlink('backend/img/'.$product->img);
                }
            $file = $r->product_img;
            $filename=Str::random(9).'.'. $file->getClientOriginalExtension();
            // $filename= $file->getClientOriginalExtension();
            $file->move('backend/img', $filename);
            $product->img= $filename;
            }


        $product->category_id= $r->category;
        $product->save();

        $mang=array();
        foreach($r->attr as $value)
        {
            foreach($value as $item)
            {
            $mang[]= $item;
            }
        }
        $product->values()->Sync($mang);

//add variant
        $variant=get_combinations($r->attr);

        foreach($variant as $var)
        {
        if(check_var($product,$var))
        {
        $vari=new variant;
        $vari->product_id=$product->id;
        $vari->save();
        $vari->values()->Attach($var);
        }

        }
        return redirect()->back()->with('thongbao','Đã sửa thành công!');
    }

        // delete product
    function delProduct($id)
    {
    product::destroy($id);
    return redirect()->back()->with('thongbao','Đã xoá thành công!');
    }
      //thêm thuộc tính
    function getAttr() {
        $data['attrs']=attribute::all();
        return view('backend.attr.attr',$data);
    }
    function postAddAttr(AddAttrRequest $r) {
        $attr= new attribute;
        $attr->name=$r->attr_name;
        $attr->save();

      return redirect()->back()->with('thongbao','Đã thêm thành công thuộc tính:'.$r->attr_name);
    }

       //sửa thuộc tính
    function editAttr($id) {
        $data['attr']=attribute::find($id);
        return view('backend.attr.editattr',$data);
    }
    function postEditAttr(EditAttrRequest $r,$id) {
        $attr=attribute::find($id);
        $attr->name=$r->attr_name;
        $attr->save();

      return redirect()->back()->with('thongbao','Đã sửa thành công thuộc tính');
    }
    // xóa thuộc tính
    function delAttr($id){
        attribute::destroy($id);
        return redirect('admin/product/attr')->with('thongbao','Đã xóa thành công thuộc tính');
    }
        //thêm giá trị thuộc tính
    function addValue(AddValueRequest $r) {
        $value=new values;
        $value->attr_id=$r->attr_id;
        $value->value=$r->value_name;
        $value->save();
        return redirect()->back()->with('thongbao','Thêm giá trị thuộc tính thành công');
    }

      //sửa giá trị thuộc tính
    function editValue($id) {
        $data['value']=values::find($id);
        return view('backend.attr.editvalue',$data);
    }
    function postEditValue(EditValueRequest $r,$id) {
        $value=values::find($id);
        $value->value=$r->value_name;
        $value->save();
        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }
    function delValue($id){
        values::destroy($id);
        return redirect()->back()->with('thongbao','Xóa thành công');
    }

    //  variant
    function addVariant($id) {
        //thêm biến thể
        $data['product']=product::find($id);
        return view('backend.variant.addvariant',$data);
    }
    function postAddVariant(request $r,$id) {
        foreach($r->variant as $key=>$value)
        {
           $vari=variant::find($key);
           $vari->price=$value;
           $vari->save();
        }

        return redirect('admin/product')->with('thongbao','Đã thêm thành công!');
      }

    function editVariant($id) {
        //sửa biến thể
        $data['product']=product::find($id);

        return view('backend.variant.editvariant',$data);
    }
    function postEditVariant(request $r,$id) {
        foreach($r->variant as $key=>$value)
        {
           $vari=variant::find($key);
           $vari->price=$value;
           $vari->save();
        }

        return redirect('admin/product')->with('thongbao','Đã Sửa thành công thành công!');
     }
     function delVariant($id){
        variant::destroy($id);
        return redirect()->back()->with('thongbao','Xóa thành công');
    }







}
