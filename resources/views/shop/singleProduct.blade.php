@extends('layouts.master')
@section('content')
    <header class="masthead" style="background-image: url('{{asset ('frontend/img/home-bg.jpg')}}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h2>{{ $product->title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{asset($product->thumbnail)}}" height="100px;" width="200px;">
            </div>
            <div class="col-md-9">
                <h2>{{ $product->title }}</h2> <hr>
                {{$product->description}}
                <hr>
                <b>{{$product->description}} </b>
                <br>
                <a href="{{route('shop.orderProduct', $product->id)}}" class="btn btn-primary">Checkout with paypal</a>
            </div>
        </div>
    </div>
@endsection
