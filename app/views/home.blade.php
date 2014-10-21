<?php include('perch/runtime.php'); ?>
@extends('homeGrid')
<?php
PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/home.blade.php');
// Try this to get me out of a bind
// $page = PerchSystem::get_page();
// echo $page
?>


@section('homeContent')
<?php perch_content('homeIntro'); ?>
@stop

@section('searchPage')

	<div class="wrapper cols2-nav-right">
		<div class="primary-content">
		    <?php 
				$query = perch_get('q');  // 'q' query string argument e.g. search.php?q=apples
			    perch_content_search($query);
			?>
		</div>
		<nav class="sidebar">
		   <?php perch_search_form(); ?>
    	</nav>
	</div>
    <?php perch_get_javascript(); ?>
@stop

@section('searchResult')
<perch:before>
    <h1>Search results for &#8220;<perch:search id="search_key" />&#8221;</h1>

    <perch:if exists="paging">
        <p><perch:search id="total" /> results</p>
    </perch:if>
        <ul>
</perch:before>

        <li class="<perch:search id="perch_item_odd" />">
            <h2><a href="<perch:search id="result_url" />"><perch:search id="result_title" /></a></h2>
            <perch:if exists="result_excerpt"><p class="excerpt">&hellip;<perch:search id="result_excerpt" encode="false" />&hellip;</p></perch:if>
            <p><a href="<perch:search id="result_url" />">
                <perch:if exists="result_pageNavText">
                    <perch:search id="result_pageNavText" />
                <perch:else />
                    <perch:search id="result_url" />
                </perch:if>
                </a></p>
        </li>

<perch:after>
    </ul>

    <perch:if exists="paging">
        <div class="paging">
            Page <perch:search id="current_page" /> of <perch:search id="number_of_pages" />
            <perch:if exists="not_first_page">
                <a href="<perch:search id="prev_url" encode="false" />">Previous</a>
            </perch:if>
            <perch:if exists="not_last_page">
                <a href="<perch:search id="next_url" encode="false" />">Next</a>
            </perch:if>
        </div>
    </perch:if>
</perch:after>


<perch:noresults>
    <perch:if exists="search_key">
        <h1>Search results for &#8220;<perch:search id="search_key" />&#8221;</h1>
    <perch:else />
        <h1>Search</h1>
    </perch:if>
    <perch:if exists="search_key">
        <p>Sorry, there are no results for &#8220;<perch:search id="search_key" />&#8221;.</p>
    </perch:if>
</perch:noresults>
@stop