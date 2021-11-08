@extends('layouts.app')

@section('title')Login Page @endsection

@section('content')


<div class="wrapper">
    <div class="content-page">
    <a href="{{route('dashboard.login')}}" class="btn btn-primary" style="margin-bottom: 20px;">Logout</a>
        <!-- Start content -->
        <div class="content">
            <div class="container text-center m-t-40" style="height: 1200px">
                <p>Welcome to dashboard</p>
            </div>
        </div>
    </div>
</div>
@endsection