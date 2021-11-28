@extends('dashboard.layouts.app')

@section('title')Home Page @endsection

@section('content')
  


<div class="py-5">
    <div class="container">
    <a href="{{route('dashboard.login')}}" class="btn btn-primary" style="margin-bottom: 20px;">Login as admin</a>
        <!-- Start content -->
            <div class="container text-center m-t-40" style="height: 1200px">
                <h3>منتجات مميزة</h3>   
            <div style="text-align:right;">
            <h5>{{$select_category->name_ar}}</h5>
            </div>
        <div class="row">
        @if(count($products_display) > 0)

        <div class="owl-carousel prod-carousel owl-theme">
            
            @foreach ($products_display as $prod)
            @if($prod->display == 1)
              
            <div class="item">
                <div class="card" style="text-align:center;width:200px">
                <div style="text-align:center;width:200px">
                @if (!empty($prod->images) && count($prod->images) > 0)
                <img  src="{{ $prod->images[0]['image'] ?? ""}}" alt="{{ $prod['name_en'] }}" width="150">
                @else 
                <h5>لا يوجد صورة</h5>
                @endif
                </div>

                <div class="card-body">
                    <h5> {{ $prod['name_' . app()->getLocale()] }}</h5>
                    <small>{{ $prod['price'] }}</small>
                </div>
                <a href="{{route('dashboard.login')}}" class="btn btn-danger" style="margin: 20px;">Add To Cart</a>
                </div>
            </div>
            @endif
            @endforeach
        </div>

            
            @endif
        </div>
        
          <!-- <div style="width:900px;background-color:red;height:1px;"></div> -->

        <div style="text-align:right;">
            <h5>{{$sec_category->name_ar}}</h5>
            </div>
        <div class="row">
        @if(count($products_sec_display) > 0)

        <div class="owl-carousel prod-carousel owl-theme">
            
            @foreach ($products_sec_display as $prod)
            @if($prod->display == 1)
              
            <div class="item">
                <div class="card" style="text-align:center;width:200px">
                <div style="text-align:center;width:200px">
                @if (!empty($prod->images) && count($prod->images) > 0)
                <img  src="{{ $prod->images[0]['image'] ?? ""}}" alt="{{ $prod['name_en'] }}" width="150">
                @else 
                <h5>لا يوجد صورة</h5>
                @endif
                </div>

                <div class="card-body">
                    <h5> {{ $prod['name_' . app()->getLocale()] }}</h5>
                    <small>{{ $prod['price'] }}</small>
                </div>
                <a href="{{route('dashboard.login')}}" class="btn btn-danger" style="margin: 20px;">Add To Cart</a>
                </div>
            </div>
            @endif
            @endforeach
        </div>

            
            @endif
        </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    $('.prod-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})
</script>
@endsection


