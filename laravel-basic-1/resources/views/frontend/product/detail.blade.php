@extends('frontend.master.master')
@section('title','Chi tiết sản phẩm')
@section('content')
		<!-- main -->
		<div class="colorlib-shop">
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-md-10 col-md-offset-1">
						<div class="product-detail-wrap">
							<div class="row">
								<div class="col-md-5">
									<div class="product-entry">
										<div class="product-img" style="background-image: url(/backend/img/{{ $prd->img }});">

										</div>

									</div>
								</div>
								<div class="col-md-7">
									<form action="/cart/add" method="get">

										<div class="desc">
											<h3>{{ $prd->name }}</h3>
											<p class="price">
												<span>{{ number_format($prd->price,0,'','.') }} đ</span>
											</p>
											<p><b>THÔNG TIN</b></p>
											<p style="text-align: justify;">
												{{ $prd->info }}
											</p>
										
									
											<div class="row row-pb-sm">
												<div class="col-md-4">
													<div class="input-group">
														<span class="input-group-btn">
															<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
																<i class="icon-minus2"></i>
															</button>
														</span>
														<input type="text" id="quantity" name="qty" class="form-control input-number" value="1" min="1" max="100">
														<span class="input-group-btn">
															<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
																<i class="icon-plus2"></i>
															</button>
														</span>
													</div>
												</div>
											</div>
											<input type="hidden" name="id_prd" value="{{ $prd->id }}">
											<p><button class="btn btn-primary btn-addtocart" type="submit"> Thêm vào giỏ hàng</button></p>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<div class="col-md-12 tabulation">
								<ul class="nav nav-tabs">
									<li class="active"><a data-toggle="tab" href="#description">Mô tả</a></li>
								</ul>
								<div class="tab-content">
									<div id="description" class="tab-pane fade in active">
										{{ $prd->describe }}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-shop">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
						<h2><span>Sản phẩm Mới</span></h2>
					</div>
				</div>
				<div class="row">
					@foreach ($prd_new as $row)
					<div class="col-md-3 text-center">
						<div class="product-entry">
							<div class="product-img" style="background-image: url(/backend/img/{{ $row->img }});">
								<p class="tag"><span class="new">New</span></p>
								<div class="cart">
									<p>
										<span class="addtocart"><a href="/cart/add?id_prd={{ $row->id }}"><i
													class="icon-shopping-cart"></i></a></span>
										<span><a href="/product/{{ $row->slug }}.html"><i class="icon-eye"></i></a></span>
									</p>
								</div>
							</div>
							<div class="desc">
								<h3><a href="/product/{{ $row->slug }}.html">{{ $row->name }}</a></h3>
								<p class="price"><span>{{ number_format($row->price,0,"",",") }} đ</span></p>
							</div>
						</div>
					</div>
					@endforeach
				
				</div>
			</div>
		</div>
		<!-- end main -->
	
@endsection
