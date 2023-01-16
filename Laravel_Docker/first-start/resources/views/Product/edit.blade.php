@extends('layouts.app')

@section('content')
    <div class="col-8 m-auto">
        <h3 class="h1 m-1">Create Product</h3>
        <form action="{{route('products.update',$product->id)}}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
                <label class="mb-2">Name product</label>
                <input type="text" class="form-control mb-2" placeholder="Enter model" name="model" value="{{$product->model}}">
            </div>
            <div class="form-group">
                <label class="mb-2">Price product</label>
                <input type="number" class="form-control mb-2" placeholder="Enter model" name="price" value="{{$product->price}}">
            </div>
            <div class="form-group">
                <label class="mb-2">Url image</label>
                <input type="text" class="form-control mb-2" placeholder="Enter url image" name="image" value="{{$product->image}}">
            </div>
            <div class="form-group">
                <label class="mb-2">Category</label>
                <select name="category_id">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$product->category->id===$category->id?'selected':''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
