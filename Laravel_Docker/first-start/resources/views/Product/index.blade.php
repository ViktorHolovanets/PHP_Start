@extends('layouts.app')

@section('content')
    <div class="col-10 m-auto">
        <a class="m-2" href="{{route('products.create')}}">Create product</a>
        <table class="table table-hover table-w m-auto text-center table-danger">
            <thead class="thead-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Model</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Category</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @if(!is_null($products))
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>
                            <a href="{{route('products.show',$product->id)}}">
                                {{$product->model}}
                            </a>
                        </td>
                        <td>{{$product->price}}</td>
                        <td>
                            <img src="{{$product->image}}">
                        </td>
                        <td>
                            <form action="{{route('products.edit', $product->id)}}" method="get">
                                @csrf
                                <input type="submit" class="btn btn-info" value="Edit">
                            </form>
                        </td>
                        <td>

                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection
