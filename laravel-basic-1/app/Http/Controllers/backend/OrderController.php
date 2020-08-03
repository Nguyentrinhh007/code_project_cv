<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\order;

class OrderController extends Controller
{
    function ListOrder()
    {
        $data['order']=order::where('state',2)->orderby('id','DESC')->paginate(6);
        return view('backend.order.order',$data);
    }

    function DetailOrder($id_order)
    {
        $data['order']=order::find($id_order);
        return view('backend.order.detailorder',$data);
    }

    function ProcessedOrder()
    {
        $data['order']=order::where('state',1)->orderby('updated_at','DESC')->paginate(2);

        return view('backend.order.processed',$data);
    }

    function Paid($id_order)
    {
        $order=order::find($id_order);
        $order->state=1;
        $order->save();
        
        return redirect('admin/order/processed');
        
    }

}
