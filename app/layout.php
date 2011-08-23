<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>sna.la</title>
  <link href='/css/style.css' rel='stylesheet' type='text/css' />
  <script src='/js/jquery.js' type='text/javascript'></script>
</head>

<body>
	<div id='header'>
		<div id='logo'>
			<a href='/'>sna.la</a>
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
			Copyright &copy; 2011 Alan Smith.
		</p>
	</div>

<? if ($_SERVER['HTTP_HOST'] === 'sna.la') : ?>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-24052779-1']);
_gaq.push(['_trackPageview']);

(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<? endif ?>

</body>
</html>
