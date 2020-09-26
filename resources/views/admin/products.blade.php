@extends('layouts.admin')
@section('title') Admin products  @endsection
@section('content')

    <div class="content">
        <div class="card">
            <div class="card-header bg-light"> Admin Products
                <a href="{{route('adminNewProduct')}}" class="btn btn-primary">New Product</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td><img src="{{asset($product->thumbnail)}}" height="100px;" width="200px;"> </td>
                                <td class="text-nowrap"><a href="{{route('adminEditProduct', $product->id)}}"> {{$product->title}}</a></td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->price}}</td>

                                <td>
                                    <a href="{{route('adminEditProduct', $product->id)}}" class="btn btn-warning"><i class="icon icon-pencil"></i></a>
                                    <form style="display: none;" method="Post" id="deleteProduct--{{$product->id}}" action=""> @csrf</form>
                                    <button class="btn btn-danger" onclick="document.getElementById('postDelete--{{$product->id}}').submit()">X</button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
