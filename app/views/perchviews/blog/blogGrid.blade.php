@include('menuLayout')
<div class=grid><!--
    
--><!--
    
 --><!--

--><div class="grid__item  six-twelfths">
      <!--   <p class=demo-block-red-white>Six Twelfths</p> -->
      <div class=demo-block-gray-white> 
 @yield('blogRecentPosts')

       
  <!--  {{ HTML::image('meSmile.jpg')}} -->
      </div>
    </div><!--

--><!--
    
--><div class="grid__item  two-twelfths">
<!--        <p class=demo-block-red-white>Five Twelfths</p> -->

    </div><!--

    --><!--
    
--><div class="grid__item  four-twelfths">
    <!--    <p class=demo-block-red-white>One Twelfth</p> -->
 <div class=demo-block> 
     <!--   <a href="{{ action('PostsController@mainindex') }}" >Sidebar</a> -->
     <!-- @yield('BlogArchive') -->
     @yield('blogContent')
      </div>

        
    </div><!--
        
-->  </div><!--
--></div>
  