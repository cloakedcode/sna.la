<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?= (isset($title) ? "{$title} | " : '') ?>Alan S.</title>

  <link rel="alternate" type="application/rss+xml" href="http://feeds.feedburner.com/sna/VFkD" title="Alan S. RSS Feed" />

  <link href='/css/style.css' rel='stylesheet' type='text/css' />
  <script src='/js/jquery.js' type='text/javascript'></script>
</head>

<body>
	<div id='header'>
		<div id='logo'>
			<a href='/'>Alan S.</a>
		</div>
		<div id='nav'>
			<ul>
				<? $last = count($menu) - 1 ?>
				<? foreach ($menu as $i => $item) : ?>
				<li><a href='/<?= $item['id'] ?>'><?= $item['title'] ?></a></li>
				<? if ($i !== $last) : ?>
				|
				<? endif ?>
				<? endforeach ?>
			</ul>
		</div>
	</div>

	<div id='content'>
		<?= Acorn::$view_contents ?>
	</div>

	<div id='footer'>
		<p>
			Copyright &copy; 2011-2012 Alan Smith. <a href="http://feeds.feedburner.com/sna/VFkD" title="Subscribe to my RSS feed!"><img src="feed.png" /></a>
		</p>
	</div>

<? if ($_SERVER['HTTP_HOST'] === 'sna.la') : ?>
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://sna.la/analytics/" : "http://sna.la/analytics/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://sna.la/analytics/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->
<? endif ?>

</body>
</html>
