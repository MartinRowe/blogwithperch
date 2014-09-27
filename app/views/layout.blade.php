<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All the Posts</title>
 <!--   <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    {{HTML::style('css/style.css');}} 

</head>
<body>
<ul class="nav nav--fit">
   <li><a href="{{ URL::to('/'    ) }}" class="greybox">Home</a></li>
   <li><a href="{{ URL::to('blog') }}" class="greybox">Blog</a></li>
   <li><a href="{{ URL::to('faq') }}" class="greybox">FAQ</a></li>
   <li><a href="{{ URL::to('about') }}" class="greybox">About</a></li>
</ul>
<br />
<br />
<br />

<div class=grid><!--
    
--><!--
    
 --><!--

--><div class="grid__item  six-twelfths">
      <!--   <p class=demo-block-red-white>Six Twelfths</p> -->
      <div class=demo-block-gray-white> 
    {{ HTML::image('meSmile.jpg')}}
      </div>
      @yield('content')
    </div><!--

--><!--
    
--><div class="grid__item  two-twelfths">
<!--        <p class=demo-block-red-white>Five Twelfths</p> -->
  
    </div><!--

    --><!--
    
--><div class="grid__item  four-twelfths">
    <!--    <p class=demo-block-red-white>One Twelfth</p> -->
 <div class=demo-block-gray-white> 
        <a href="{{ action('PostsController@index') }}" >Sidebar</a>
      </div>
      @yield('sidebarcontent')
    </div><!--
        
-->  </div><!--
--></div>
  
</body>
</html>
