<?php

ini_set('date.timezone', 'America/New_York');

if (isset($_POST['send']))
{
	/*
 	 * Start up Acorn
 	 *
 	 */
	
	require('inc/setup.php');
	
	Acorn::$vars['menu'] = Page::menuItems();
	
	/*
	 * Send the email
	 *
	 */
	include('app/strip_html.php');

	$email = Html2txt($_POST['email']);
	$subject = html2txt($_POST['subject']);
	$msg = html2txt($_POST['message']);

	mail('hello@sna.la', $subject, $msg, "From: me@sna.la; Reply-to: {$email}");

	Acorn::renderView('views/sent');
}
else
{
	header('Location: /');
}

?>
