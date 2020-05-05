<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\customer;

class OrderController extends Controller
{
    function ListOrder()
    {
        $data['customer'] = customer::where('state',0)->orderBy('created_at','desc')->paginate(10);
        return view('backend.order.order',$data);
    }

    function DetailOrder($customer_id)
    {
        $data['customer'] = customer::find($customer_id);
        return view('backend.order.detail',$data);
    }
    
    function Processed()
    { 
        $data['customer'] = customer::where('state',1)->orderBy('updated_at','desc')->paginate(10);
    
        return view('backend.order.processed',$data);
    }

    function ActiveOrder($customer_id)
    {
        $customer = customer::find($customer_id);
        $customer->state=1;
        $customer->save();
        return redirect('admin/order')->with('thongbao','Đơn hàng đã xử lí');
    }
}
