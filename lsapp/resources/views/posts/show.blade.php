@extends('layouts.app')
@section('content')
    <a href="/posts" class="btn btn-outline-secondary btn-sm mb-3">Go Back</a>
    <div class="card">
            <img class="card-img-top" src="/storage/cover_images/{{$post->cover_image}}">
            <div class="card-body">
              <h5 class="card-title">{{$post-> title}}</h5>
              <p class="card-text">{!!$post->body!!}</p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Written on {{$post->created_at}} by {{$post->user->name}}</small>
            </div>
    </div>


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
    @endsection