<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\customer;

class OrderController extends Controller
{
    function listOrder() {
        $data['customers']=customer::where('state',0)->orderby('created_at','DESC')->paginate(10);
        return view('backend.order.order',$data);    }
    function detailOrder($customer_id) {
        $data['customer']=customer::find($customer_id);
        return view('backend.order.detailorder',$data);
    }
    function Processed()   {
        $data['customers']=customer::where('state',1)->orderby('updated_at','DESC')->paginate(10);
        return view('backend.order.orderprocessed',$data);
    }
    function ActiveOrder($customer_id)
    {
        $customer=customer::find($customer_id);
        $customer->state=1;
        $customer->save();
        return redirect('admin/order')->with('thongbao','Đã xử lí đơn hàng thành công!');
    }

}
