<?php

// background this script
ignore_user_abort(true);
set_time_limit(0);

// get todays date
$today = strtotime(date('Y-m-d'));
// for each post in posts/upcoming
foreach (glob('posts/upcoming/*.html') as $post)
{
	// if it is dated today or before
	if (strtotime(substr(basename($post), 0, 10)) <= $today)
	{
		// move it into posts/
		rename($post, 'posts/' . basename($post));
	}
}
