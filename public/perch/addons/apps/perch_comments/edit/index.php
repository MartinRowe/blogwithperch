<?php
    # include the API
    include('../../../../core/inc/api.php');
    
    $API  = new PerchAPI(1.0, 'perch_comments');
    $Lang = $API->get('Lang');

    # include your class files
    include('../PerchComments_Comments.class.php');
    include('../PerchComments_Comment.class.php');
    
    # Set the page title
    $Perch->page_title = $Lang->get('Moderate Comments');
   

    # Do anything you want to do before output is started
    include('../modes/edit.pre.php');
    
    
    # Top layout
    include(PERCH_CORE . '/inc/top.php');

    
    # Display your page
    include('../modes/edit.post.php');
    
    
    # Bottom layout
    include(PERCH_CORE . '/inc/btm.php');
?>
