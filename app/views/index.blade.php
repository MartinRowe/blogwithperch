<?php include(public_path().'/perch/runtime.php'); ?>
@extends('layout')

@section('content')
    <div class="page-header">
        <br />
        <br />

        <?php perch_content('Intro'); ?>
        <hr />
    </div>

 <!--<div class=demo-block-gray-white>   -->
     <a href="{{ action('PostsController@index') }}" >The Blog Posts</a>



    @if ($posts->isEmpty())
        <p>There are not any posts! :(</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Blog Post</th>
                    <th>Complete</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->blogpost }}</td>
                    <td>{{ HTML::image($post->postimage)}}</td>
                    <td>{{ $post->complete ? 'Yes' : 'No' }}</td>

                    <td>
                        <a href="{{ action('PostsController@edit', $post->id) }}" class="btn btn-default">Edit Post</a>
                    <td>
                        <a href="{{ action('PostsController@delete', $post->id) }}"  class="btn btn--default">Delete Post</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr />
    @endif 
  <div class="panel panel-default">
        <div class="panel-body">
            <a href="{{ action('PostsController@create') }}" class="btn btn-primary">Create Post</a>
    
        </div>
    </div> 
@stop

@section('sidebarcontent')
    <div class="page-header">
        <br />
        <br />
        <!-- <h4>All Posts</h4> -->
        <hr />
    </div>
    @if ($posts->isEmpty())
        <p>There are not any posts! :(</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>
<td>{{ $post->id }}</td>
</td>


                    <td>
                           <a href="{{ action('PostsController@edit', $post->id) }}" class="btn btn-default">{{ $post->title }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr />
    @endif 
@stop

@section('editcontent')
    <div class="page-header">
        <h1>Edit Post <small> and mark it complete!</small></h1>
    </div>

    <form action="{{ action('PostsController@handleEdit') }}" method="post" role="form">
        <input type="hidden" name="id" value="{{ $post->id }}">

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $post->title }}" />
        </div>
        <div class="form-group">
            <label for="blogpost">Blog Post</label>
            <input type="text" class="form-control" name="blogpost" value="{{ $post->blogpost }}" />
        </div>
        <div class="checkbox">
            <label for="complete">
                <input type="checkbox" name="complete" {{ $post->complete ? 'checked' : '' }} /> Complete?
            </label>
        </div>
        <input type="submit" value="Save" class="btn btn-primary" />
        <a href="{{ action('PostsController@index') }}" class="btn btn-link">Cancel</a>
    </form>
    <ul class="form-fields">
   <li>
       <label>test</label>
       <input>
   </li>
   <li>
       <select id="country">
           <option>UK</option>
           <option>US</option>
           <option>Other</option>
       </select>
       <label>test</label>
   </li>
   <li>
       <input>
       <label>test</label>
   </li>
</ul>
@stop

