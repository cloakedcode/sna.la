<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<rss version="2.0">
	<channel>
		<title>Alan S.</title>
		<description>RSS posts feed for Alan S.</description>
		<link>http://sna.la</link>
		<language>en-us</language>

	<? foreach ($posts as $p) : ?>
		<item>
			<title><?= $p->title ?></title>
			<link>http://sna.la/<?= $p->url() ?></link>
			<description><?= $p->body() ?></description>
			<guid><?= date("Y-M-d", $p->date) ?></guid>
			<pubDate><?= date("D\, j M Y G:i:s T", $p->date) ?></pubDate>
		</item>
	<? endforeach ?>

	</channel>
</rss>
