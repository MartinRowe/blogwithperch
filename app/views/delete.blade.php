@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Delete the{{ $post->title }} <small>Are you sure?</small></h1>
    </div>
    <form action="{{ action('PostsController@handleDelete') }}" method="post" role="form">
        <input type="hidden" name="post" value="{{ $post->id }}" />
        <input type="submit" class="btn btn-danger" value="Yes" />
        <a href="{{ action('PostsController@index') }}" class="btn btn-default">No!</a>
    </form>
@stop
