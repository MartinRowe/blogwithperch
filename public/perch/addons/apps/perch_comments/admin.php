<?php
	if ($CurrentUser->logged_in() && $CurrentUser->has_priv('perch_comments')) {
	    $this->register_app('perch_comments', 'Comments', 2, 'A comments system', '1.1');
	    $this->require_version('perch_comments', '2.5');
	    $this->add_setting('perch_comments_akismet_key', 'Akismet API key', 'text', '');
	}
