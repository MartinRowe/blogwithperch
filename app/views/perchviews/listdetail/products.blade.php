<?php include('perch/runtime.php'); ?>
@extends('perchviews/listdetail/listDetailGrid')
<?php
  PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/perchviews/listdetail/products.blade.php');
  //$page = PerchSystem::get_page();
  //echo $page
?>

<!doctype html>

@section('listContent')  
<?php


// altered this to put list and detail on the page
// it was in the else section originally
     perch_content_create('Products', array(
          'template'  => 'product_detail.html',
          'multiple'  => true,
          'edit-mode' => 'listdetail',
     ));
?>   

<?php
     if (perch_get('s')) {
  // Detail mode

// Detail mode
 perch_content_custom('Products', array(
      'template' => 'product_detail.html',
      'filter' => 'slug',
      'match' => 'eq',
      'value' => perch_get('s'),
      'count' => 1,
 )); 

     } else {
// List mode
          perch_content_custom('Products', array(
               'template' => 'product_listing.html',
          )); 
        
     }
?>
</body>
</html>
@stop