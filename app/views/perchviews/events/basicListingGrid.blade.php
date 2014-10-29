@include('menuLayout')
<div class=grid><!--
    
--><!--
    
 --><!--

--><div class="grid__item  ten-twelfths">
      <!--   <p class=demo-block-red-white>Six Twelfths</p> -->
      <div class=demo-block-gray-white> 
 @yield('basicListing')

       
  <!--  {{ HTML::image('meSmile.jpg')}} -->
      </div>
    </div><!--

--><!--
    
--><div class="grid__item  one-twelfth">
<!--        <p class=demo-block-red-white>Five Twelfths</p> -->
 
    </div><!--

    --><!--
    
--><div class="grid__item  one-twelfth">
    <!--    <p class=demo-block-red-white>One Twelfth</p> -->
 <div class=demo-block> 
     <!--   <a href="{{ action('PostsController@mainindex') }}" >Sidebar</a> -->
     <!-- @yield('BlogArchive') -->
     
      </div>

        
    </div><!--
        
-->  </div><!--
--></div><!--
--><div class=grid><!--
    
--><div class="grid__item  twelve-twelfths">
      <div class=demo-block-gray-white> 
      @yield('myFooter')
      </div>
    </div>  
    </div>
  