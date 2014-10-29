@extends('menuLayoutGrid')
@section('navCSS')
<head>
    <meta charset="UTF-8">
    <title>AssessAndmprove</title>


    <!--   <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    {{HTML::style('css/style.css');}}


    <script type="text/javascript" src="{{asset('/js/jquery.colorbox-min.js')}}"></script>
</head>

<body>

<ul class="nav nav--fit">
   <li><a href="{{ URL::to('/') }}" class="greybox">Home</a></li>
   <li><a href="{{ URL::to('blog') }}" class="greybox">Blog</a></li>
   <li><a href="{{ URL::to('members') }}" class="greybox">Members</a></li>
   <li><a href="{{ URL::to('events') }}" class="greybox">Events</a></li>
   <li><a href="{{ URL::to('gallery') }}" class="greybox">Gallery</a></li>
   <li><a href="{{ URL::to('faq') }}" class="greybox">FAQ</a></li>
   <li><a href="{{ URL::to('about') }}" class="greybox">About</a></li>
   <li><a href="{{ URL::to('search') }}" class="greybox"></a></li>
   <li><a href="{{ URL::to('search') }}" <button class="btn">Search</button></a></li>
<!--   <button class="btn">Search</button> -->
<!--   <li><a href="{{ URL::to('listdetail') }}" class="greybox">ListDetail</a></li> -->
<!--       <li><a href="{{ URL::to('blogg') }}" class="greybox">Blogg</a></li> -->
</ul>

<br />
<hr />

@stop




@section('myFooter')

  <footer class="layout-footer">
  		
 <hr />
    <small>Copyright &copy; <?php echo date('Y'); ?></small>
  		
  </footer>


@stop
