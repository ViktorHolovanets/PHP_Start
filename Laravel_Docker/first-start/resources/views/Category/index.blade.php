@extends('layouts.app')

@section('content')
    <div class="col-6">
        <h3 class="col-12 text-center font-bold h1 m-1">Categories</h3>
        <table class="table table-hover table-w m-auto text-center table-danger">
            <thead class="thead-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Category name</th>
                <th scope="col">Count products</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->name}}</td>
                    <td>{{$category->products()->count()}}</td>
                    <td>
                        <form action="{{route('categories.destroy', $category->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-6">
        <h3 class="col-12 text-center font-bold h1 m-1">Create category</h3>
        <form action="{{route('categories.store')}}" method="post" class="col-10 m-auto">
            @csrf
            <div class="form-group">
                <label class="mb-2">Name category</label>
                <input type="text" class="form-control mb-2" placeholder="Enter name" name="name">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
