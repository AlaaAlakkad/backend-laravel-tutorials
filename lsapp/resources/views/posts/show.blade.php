@extends('layouts.app')
@section('content')
    <a href="/posts" class="btn btn-outline-secondary btn-sm">Go Back</a>

    <h1 class="mt-1">{{$post-> title}}</h1>
    <div>
        {!!$post->body!!}
    </div>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <div class="mt-2 form-inline">
        {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm mr-2'])}}
        {!!Form::close()!!}
        <a href="/posts/{{$post -> id}}/edit" class="btn btn-outline-secondary btn-sm ml-2">Edit</a>

    </div>
    @endsection('content')