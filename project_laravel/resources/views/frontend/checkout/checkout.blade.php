@extends('frontend.master.master')
@section('title','Thanh toán')
@section('checkout')
    class="active"
@endsection
@section('content')
<form method="post" class="colorlib-form">
@csrf
<div class="colorlib-shop">
    <div class="container">
        <div class="row row-pb-md">
            <div class="col-md-10 col-md-offset-1">
                <div class="process-wrap">
                    <div class="process text-center active">
                        <p><span>01</span></p>
                        <h3>Giỏ hàng</h3>
                    </div>
                    <div class="process text-center active">
                        <p><span>02</span></p>
                        <h3>Thanh toán</h3>
                    </div>
                    <div class="process text-center">
                        <p><span>03</span></p>
                        <h3>Hoàn tất thanh toán</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                    <h2>Chi tiết thanh toán</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fname">Họ & Tên</label>
                                <input required name="name"  type="text" id="fname" class="form-control" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fname">Địa chỉ</label>
                                <input required name="address" type="text" id="address" class="form-control" placeholder="Nhập địa chỉ của bạn">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="email">Địa chỉ email</label>
                                <input required name="email" type="email" id="email" class="form-control" placeholder="Ex: youremail@domain.com">
                            </div>
                            <div class="col-md-6">
                                <label for="Phone">Số điện thoại</label>
                                <input required name="phone" type="text" id="zippostalcode" class="form-control" placeholder="Ex: 0123456789">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">

                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-5">
                <div class="cart-detail">
                    <h2>Tổng Giỏ hàng</h2>
                    <ul>
                        <li>

                            <ul>
                                @foreach ($cart as $product)
                                <li><span>{{$product->qty}} x {{$product->name}}
                                    @foreach ($product->options->attr as $key=>$value)
                                        ({{$key}}:{{$value}})
                                    @endforeach
                                </span>
                                 <span>{{number_format($product->price*$product->qty,0,'',',')}}VNĐ</span></li>
                                @endforeach
                            </ul>
                        </li>

                        <li><span>Tổng tiền đơn hàng</span> <span>{{$total}}VNĐ</span></li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <p><button type="submit" class="btn btn-primary">Thanh toán</button></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

@endsection

@section('script')
    @parent
    <script>
        $(document).ready(function () {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function (e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>
@endsection
