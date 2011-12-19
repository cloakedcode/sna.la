<h1 class='post-title'><?= $post->title ?></h1>
<div class='tags'>Tags:
    <? if (empty($post->tags)) : ?>
    none
    <? else : ?>
    <? foreach($post->tags as $i => $t) : ?>
    <?= ($i > 0) ? ', ' : '' ?>
    <a href='/tag/<?= $t ?>'><?= $t ?></a>
    <? endforeach ?>
    <? endif ?>
</div>
<div class='date'><?= $post->date() ?>.</div>

<div class='post-content'>
    <?= $post->body() ?>
    <div class='post-links'>
        <? if ($post->nextPost()) : ?>
            <a class='next' href='<?= $post->nextPost()->url() ?>'>&laquo; <?= $post->nextPost()->title ?></a>
        <? endif ?>
        <? if ($post->previousPost()) : ?>
            <a class='previous' href='<?= $post->previousPost()->url() ?>'><?= $post->previousPost()->title ?> &raquo;</a>
        <? endif ?>
    </div>
</div>

<hr/>

<div id="disqus_thread"></div>
<script type="text/javascript">
	var disqus_identifier = '<?= $post->id ?>';
	(function() {
		var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
		dsq.src = 'http://codecabin.disqus.com/embed.js';
		(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	})();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript=codecabin">comments powered by Disqus.</a></noscript>
