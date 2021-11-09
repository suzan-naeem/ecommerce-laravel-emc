@extends('dashboard.layouts.app')

@section('title')Login Page @endsection

@section('content')
<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

@if(session()->has('danger'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session('danger') }}
    </div>
@endif

<div class="wrapper-page">
    <div class="card-box">
        <div class="panel-heading">
            <h4 class="text-center">Login</h4>
        </div>


        <div class="p-20">
            <form class="form-horizontal m-t-20" method="POST" action="{{route('dashboard.login.post')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group ">
                    <div class="col-12">
                        <input class="form-control" type="email" name="email" required="" placeholder="E-mail">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-12">
                        <input class="form-control" type="password"  name="password" required="" placeholder="Password">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-12">
                        <div class="checkbox checkbox-primary">
                            <strong>Don't have Account ? </strong> 
                            <a href="{{route('dashboard.create.admin')}}"  style="margin-bottom: 20px;">Sign Up</a>
                           
                        </div>

                    </div>
                </div>

              

               

                <div class="form-group text-center m-t-40">
                <button type="submit" class="btn btn-success">Login</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection