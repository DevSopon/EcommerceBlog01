@extends('layouts.master')
@section('content')
    <header class="masthead" style="background-image: url('{{asset ('frontend/img/home-bg.jpg')}}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Our Shop</h1>
                        <span class="subheading">Super cool new t-shirt</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @foreach ($products as $product )

                    <div class="post-preview">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{asset($product->thumbnail)}}" height="100px;" width="200px;">
                            </div>
                            <div class="col-md-8">
                                <a href="{{route ('shop.singleProduct', $product->id)}}">
                                    <h2 class="post-title">
                                        {{ $product->title }}
                                    </h2>
                                </a>
                                <hr>
                                <p>{{ $product->price }} tk.</p> <hr>
                                <p class="post-meta">
                                    Posted on {{ date_format($product->created_at, 'F d, y')}}
                                </p>
                            </div>
                        </div>

                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection
