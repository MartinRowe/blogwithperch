<?php include('perch/runtime.php'); ?>
@extends('faqGrid')

<?php
	PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/faq.blade.php');
	// $page = PerchSystem::get_page();
	// echo $page
?>


@section('faqContent')

	<p>Faq</p>
	<?php perch_content('FaqIntro'); ?>

@stop


@section('FAQ')


<ul class="questions">
<?php
  perch_content_custom('FAQ', array(
    'template'=>'faq_question.html',
    'page'=>'/faq.php'
  ));
?>
</ul>


	<ul class="faq">
  <?php perch_content('FAQ'); ?>
</ul>


@stop