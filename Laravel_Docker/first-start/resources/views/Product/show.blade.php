@extends('layouts.app')

@section('content')
    <div class="col-5 m-3">
        <img src="{{$product->image}}" class="col-10 m-auto block">
        <p>Model: {{$product->model}}</p>
        <p>Model: {{$product->price}}</p>
    </div>
    <div class="col-5">
        <p class="h1 text-center">Comments</p>
        <form action="{{route('comments.store')}}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control mb-2" placeholder="Enter name" name="user">
            </div>
            <div class="form-group">
                <textarea name="text" class="form-control"></textarea>
            </div>
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <button type="submit" class="btn btn-success m-2">Create comment</button>
        </form>
        @if(!is_null($product->comments))
            @foreach($product->comments as $comment)
                <div class="mt-2 col-12 flex-col d-flex">
                    <div>
                        {{$comment->user}}
                    </div>
                    <form action="{{route('comments.destroy', $comment->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn" value="❌">
                    </form>
                </div>
                <div class="bg-info">
                    {{$comment->text}}
                </div>
            @endforeach
        @endif
    </div>
@endsection
