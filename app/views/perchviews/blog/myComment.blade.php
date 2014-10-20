<?php include('perch/runtime.php'); ?>
@extends('perchviews/blog/blogGrid')
<?php
PerchSystem::set_page('/Users/martinrowe/Documents/Sites/homestead/blogwithperch/app/views/perchviews/blog/myComment.blade.php');
?>

@section('myComments')
<perch:form id="comment" method="post" app="perch_comments">
	<fieldset>
	   <legend>Leave a comment</legend>
		<div>
			<perch:label for="commentName">Name</perch:label>
			<perch:input type="text" id="commentName" required="true" label="Name" antispam="name" />
			<perch:error for="commentName" type="required">Required</perch:error>
		</div>
		<div>
			<perch:label for="commentEmail">Email</perch:label>
			<perch:input type="email" id="commentEmail" required="true" label="Email" antispam="email" />
			<perch:error for="commentEmail" type="required">Required</perch:error>
			<perch:error for="commentEmail" type="format">Check format of address</perch:error>
		</div>
		<div>
			<perch:label for="commentURL">Website</perch:label>
			<perch:input type="url" id="commentURL" placeholder="http://" label="URL" antispam="url" />
		</div>
		<div>
			<perch:label for="commentHTML">Comment</perch:label>
			<perch:input type="textarea" id="commentHTML" required="true" label="Message" antispam="body" />
			<perch:error for="commentHTML" type="required">Required</perch:error>
		</div>
		<div>
			<perch:input type="hidden" id="parentID" value="<perch:comments id="parentID" />" />
			<perch:input type="hidden" id="parentTitle" value="<perch:comments id="parentTitle" />" />
			<perch:input type="submit" id="submitComment" value="Submit" />
		</div>

    </fieldset>
	<perch:success>
		<p>Thank you. Your comment has been submitted and will appear on the site once approved.</p>
	</perch:success>

</perch:form>
