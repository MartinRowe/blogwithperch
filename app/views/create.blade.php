@extends('layout')

@section('content')
    <div class="page-header">
        <h1>Create Post <small>and some day complete it!</small></h1>
    </div>

    <form action="{{ action('PostsController@handleCreate') }}" method="post" role="form">
        <div class="form-group">
            <label for="title">Blog Title</label>
            <input type="text" class="form-control" name="title" />
        </div>
        <div class="form-group">
            <label for="blogpost">Blog Post</label>
            <input type="text" class="form-control" name="blogpost" />
        </div>
        <div class="checkbox">
            <label for="complete">
                <input type="checkbox" name="complete" />Complete?
            </label>
        </div>
        
        <input type="submit" value="Create" class="btn btn-primary" />
        <a href="{{ action('PostsController@index') }}" class="btn btn-link">Cancel</a>
    </form>
@stop


