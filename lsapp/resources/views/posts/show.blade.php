@extends('layouts.app')
@section('content')
    <a href="/posts" class="btn btn-outline-secondary btn-sm">Go Back</a>

    <h1 class="mt-1">{{$post-> title}}</h1>
    <div>
        {!!$post->body!!}
    </div>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    @auth
        @if(Auth::user()->id == $post->user_id)
            <div class="mt-2 form-inline">
                <a href="/posts/{{$post -> id}}/edit" class="btn btn-outline-secondary btn-sm mr-auto">Edit</a>
                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class'=>'ml-auto'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm mr-2'])}}
                {!!Form::close()!!}
            </div>
        @endif
    @endauth
    @endsection('content')