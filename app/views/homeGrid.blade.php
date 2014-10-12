@include('menuLayout')
<div class=grid><!--
    
--><!--
    
 --><!--

--><div class="grid__item  two-twelfths">
      <!--   <p class=demo-block-red-white>Six Twelfths</p> -->
      <div class=demo-block-gray-white> 


       
  <!--  {{ HTML::image('meSmile.jpg')}} -->
      </div>
  <!--    @yield('content') -->
    </div><!--

--><!--
    
--><div class="grid__item  six-twelfths">
<!--        <p class=demo-block-red-white>Five Twelfths</p> -->

    </div><!--

    --><!--
    
--><div class="grid__item  four-twelfths">
    <!--    <p class=demo-block-red-white>One Twelfth</p> -->
 <div class=demo-block-gray-white> 
     <!--   <a href="{{ action('PostsController@mainindex') }}" >Sidebar</a> -->
      </div>
 @yield('homeContent')
        
    </div><!--
        
-->  </div><!--
--></div>
  