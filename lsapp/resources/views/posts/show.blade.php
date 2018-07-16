@extends('layouts.app')
@section('content')
    <h1>{{$post-> title}}</h1>
    <div>
        {!!$post->body!!}
    </div>
    <small>Written on {{$post->created_at}}</small>
    <div>
    <a href="/posts" class="btn btn-outline-secondary btn-sm">Go Back</a>
    </div>
    @endsection('content')