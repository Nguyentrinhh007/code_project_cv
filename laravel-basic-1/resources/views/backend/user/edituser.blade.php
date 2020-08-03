@extends('backend.master.master')
@section('title','Sửa thành viên')
@section('user')
	class="active"
@endsection
@section('content')
    <!--main-->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sửa Thành viên</h1>
            </div>
        </div>
        <!--/.row-->
    <div class="row">
        <form method="post">
            @csrf
        <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    @if (session('thongbao'))
                    <div class="alert bg-success" role="alert">
                        <svg class="glyph stroked checkmark">
                            <use xlink:href="#stroked-checkmark"></use>
                        </svg> {{ session('thongbao') }} <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
                    @endif
                    <div class="panel-heading"><i class="fas fa-user"></i> Sửa thành viên - {{ $user->name }}</div>
                    <div class="panel-body">
                        <div class="row justify-content-center" style="margin-bottom:40px">

                            <div class="col-md-8 col-lg-8 col-lg-offset-2">
                             
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                                    {{ showErrors($errors,'email') }}
                                </div>
                                <div class="form-group">
                                    <label>password</label>
                                    <input type="text" name="password" class="form-control" >
                                    {{ showErrors($errors,'password') }}
                                </div>
                                <div class="form-group">
                                    <label>Full name</label>
                                    <input type="full" name="full" class="form-control" value="{{ $user->full }}">
                                    {{ showErrors($errors,'full') }}
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="address" name="address" class="form-control" value="{{ $user->address }}">
                                    {{ showErrors($errors,'address') }}
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="phone" name="phone" class="form-control" value="{{ $user->phone }}">
                                    {{ showErrors($errors,'phone') }}
                                </div>
                              
                                <div class="form-group">
                                    <label>Level</label>
                                    <select name="level" class="form-control" value="">
                                        <option @if($user->level==1) selected  @endif value="1">admin</option>
                                        <option @if($user->level==2) selected  @endif value="2">user</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-lg-8 col-lg-offset-2 text-right">
                                  
                                    <button class="btn btn-success"  type="submit">Sửa thành viên</button>
                                    <button class="btn btn-danger" type="reset">Huỷ bỏ</button>
                                </div>
                            </div>
                           

                        </div>
                    
                        <div class="clearfix"></div>
                    </div>
                </div>

        </div>
    </form>
    </div>

        <!--/.row-->
    </div>

  @endsection