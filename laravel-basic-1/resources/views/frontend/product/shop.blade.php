@extends('frontend.master.master')
@section('title','CỬA HÀNG')
@section('content')
		<!-- main -->
		<div class="colorlib-shop">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-md-push-3">
						<div class="row row-pb-lg">
							@foreach ($products as $row)
							<div class="col-md-4 text-center">
								<div class="product-entry">
									<div class="product-img" style="background-image: url(/backend/img/{{ $row->img }});">

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
						<div class="row">
							<div class="col-md-12">
								{{ $products->links() }}
							</div>
						</div>
					</div>
					<div class="col-md-3 col-md-pull-9">
						<div class="sidebar">
							<div class="side">
								<h2>Danh mục</h2>
								<div class="fancy-collapse-panel">
									<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
										@foreach ($categorys as $row)
											@if ($row->parent==0)
											<div class="panel panel-default">
												<div class="panel-heading" role="tab" id="headingOne">
													<h4 class="panel-title">
														<a data-toggle="collapse" data-parent="#accordion" href="#menu{{ $row->id }}"
															aria-expanded="true" aria-controls="collapseOne">{{ $row->name }}
														</a>
													</h4>
												</div>
												<div id="menu{{ $row->id }}" class="panel-collapse collapse" role="tabpanel"
													aria-labelledby="headingOne">
													<div class="panel-body">
														<ul>
															@foreach ($categorys as $item)
																@if($row->id==$item->parent)
																	<li><a href="/{{ $item->slug }}.html">{{ $item->name }}</a></li>
																@endif
															@endforeach
														</ul>
													</div>
												</div>
											</div>
											@endif
										@endforeach
										
									</div>
								</div>
							</div>
							<div class="side">
								<h2>Khoảng giá</h2>
								<form action="/filter" method="get" class="colorlib-form-2">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="guests">Từ:</label>
												<div class="form-field">
													<i class="icon icon-arrow-down3"></i>
													<select name="start" id="people" class="form-control">
														<option value="100000">100.000 VNĐ</option>
														<option value="200000">200.000 VNĐ</option>
														<option value="300000">300.000 VNĐ</option>
														<option value="500000">500.000 VNĐ</option>
														<option value="1000000">1.000.000 VNĐ</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="guests">Đến:</label>
												<div class="form-field">
													<i class="icon icon-arrow-down3"></i>
													<select name="end" id="people" class="form-control">
														<option value="2000000">2.000.000 VNĐ</option>
														<option value="4000000">4.000.000 VNĐ</option>
														<option value="6000000">6.000.000 VNĐ</option>
														<option value="8000000">8.000.000 VNĐ</option>
														<option value="10000000">10.000.000 VNĐ</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<button type="submit" style="width: 100%;border: none;height: 40px;">Tìm
										kiếm</button>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end main -->

@endsection