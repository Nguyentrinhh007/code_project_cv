<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\{AddProductRequest,EditProductRequest,
AddAttrRequest,EditAttrRequest,AddValueRequest,EditValueRequest};
use App\models\{product,attribute,values,category,variant};
use Illuminate\Support\Str;

class ProductController extends Controller
{
    function ListProduct()
    {
        // dd(attr_values(product::find(1)->values()->get()));
        $data['products'] = product::paginate(9);
        return view('backend.product.listproduct',$data);
    }

    function AddProduct()
    {
        $data['category'] = category::all();
        $data['attrs'] = attribute::all();
        return view('backend.product.addproduct',$data);
    }

    function PostAddProduct(AddProductRequest $request)
    {
        // dd($request->all());
        $product = new product;
        $product->product_code = $request->product_code;
        $product->name = $request->product_name;
        $product->price = $request->product_price;
        $product->featured = $request->featured;
        $product->state = $request->product_state;
        $product->info = $request->info;
        $product->describe = $request->description;
            if ($request->hasFile('product_img')) 
            {
                $file = $request->product_img;
                $filename = Str::slug($request->product_name,'-').'.'.$file->getClientOriginalExtension();
                $file->move('backend/img',$filename);   
                $product->img= $filename; 
            } 
            else 
            {
               $product->img = 'no-img.jpg';
            }
        $product->category_id = $request->category;
        $product->save();

        $mang = array();
        foreach ($request->attr as $value) 
        {
            foreach ($value as $item) 
            {
                $mang[] = $item;
            }
        }
        $product->values()->Attach($mang);

        $variant = get_combinations($request->attr);

        foreach ($variant as $var) 
        {
            $vari = new variant;
            $vari->product_id = $product->id;
            $vari->save();
            $vari->values()->Attach($var);
        }
        return redirect('admin/product/add-variant/'.$product->id);
    }

    function EditProduct($id)
    {
        $data['product'] = product::find($id);
        $data['category'] = category::all();
        $data['attrs'] = attribute::all();
        return view('backend.product.editproduct',$data);
    }

    function PostEditProduct(EditProductRequest $request,$id)
    {
        // dd($request->all());
        $product = product::find($id);
        $product->product_code = $request->product_code;
        $product->name = $request->product_name;
        $product->price = $request->product_price;
        $product->featured = $request->featured;
        $product->state = $request->product_state;
        $product->info = $request->info;
        $product->describe = $request->description;
            if ($request->hasFile('product_img')) 
            {
                if ($product->img!='no-img.jpg') 
                {
                    unlink('backend/img/'.$product->img);
                }
                $file = $request->product_img;
                $filename = Str::slug($request->product_name,'-').'.'.$file->getClientOriginalExtension();
                $file->move('backend/img',$filename);   
                $product->img= $filename; 
            } 
        $product->category_id = $request->category;
        $product->save();

        $mang = array();
        foreach ($request->attr as $value) 
        {
            foreach ($value as $item) 
            {
                $mang[] = $item;
            }
        }
        $product->values()->Sync($mang);

             //add variant
       $variant = get_combinations($request->attr);

       foreach ($variant as $var) 
       {
           if (check_var($product,$var)) 
           {
            $vari = new variant;
            $vari->product_id = $product->id;
            $vari->save();
            $vari->values()->Attach($var);
           }
       }

        return redirect()->back()->with('thongbao','Đã sửa sản phẩm thành công!');

    }

    function DelProduct($id)
    {
        product::destroy($id);
        
        return redirect()->back()->with('thongbao','Đã xóa thành công');
        
    }

    // thuộc tính và giá trị thuộc tính
    function DetailAttr()
    {
        $data['attrs'] = attribute::all();
        return view('backend.attr.attr',$data);
    }

    function AddAttr(AddAttrRequest $r)
    {
        $attr = new attribute;
        $attr->name = $r->attr_name;
        $attr->save();
        return redirect()->back()->with('thongbao','Thuộc tính : '.$r->attr_name.' đã được thêm'); 
    }

    function EditAttr($id)
    {
        $data['attr'] = attribute::find($id);
        return view('backend.attr.editattr',$data);
    }

    function PostEditAttr(EditAttrRequest $r,$id)
    {
        $attr = attribute::find($id);
        $attr->name = $r->attr_name;
        $attr->save();
        return redirect()->back()->with('thongbao','Đã sửa thành công thuộc tính'); 
    }

    function DelAttr($id)
    {
       attribute::destroy($id);
       return redirect()->back()->with('thongbao','Đã xóa thành công');
    }

    function AddValue(AddValueRequest $r)
    {
      $value = new values;
      $value->attr_id = $r->attr_id;
      $value->value = $r->value_name;
      $value->save();
      return redirect()->back()->with('thongbao','Đã thêm giá trị :'.$r->value_name);
      
    }

    function EditValue($id)
    {
        $data['value'] = values::find($id);
        return view('backend.attr.editvalue',$data);
    }

    function PostEditValue(EditValueRequest $r,$id)
    {
        $value = values::find($id);
        $value->value = $r->value_name;
        $value->save();
        return redirect()->back()->with('thongbao','Đã sửa thành công');
    }

    function DelValue($id)
    {
       values::destroy($id);
       return redirect()->back()->with('thongbao','Đã xóa thành công');
    }

    // bien the 
    function AddVariant($id)
    {
        $data['product'] = product::find($id);
        return view('backend.variant.addvariant',$data);
    }

    function PostAddVariant(request $request,$id)
    {
        // dd($request->all());
        foreach ($request->variant as $key => $value) {
            $vari = variant::find($key);
            $vari->price=$value;
            $vari->save();
        }
        
        return redirect('admin/product')->with('thongbao','Đã thêm sản phẩm thành công!');
        
    }

    function DelVariant($id)
    {
        variant::destroy($id);
        return redirect()->back()->with('thongbao','Đã xóa thành công biến thể');
        
    }

    function EditVariant($id)
    {
        $data['product'] = product::find($id);

        return view('backend.variant.editvariant',$data);
    }
    function PostEditVariant(request $request,$id)
    {
        // dd($request->all());
        foreach ($request->variant as $key => $value) {
            $vari = variant::find($key);
            $vari->price=$value;
            $vari->save();
        }
        
        return redirect('admin/product')->with('thongbao','Đã sửa sản phẩm thành công!');
        
    }

}
