<?
$last = count($posts) -1;
foreach ($posts as $i => $post) :
?>
<div class='post'>
		<h2 class='title'><a href='<?= $post->url() ?>'><?= $post->title ?></a></h2>
		<span class='date'><?= $post->date() ?>.</span>
</div>

<? if ($i < $last ) : ?>
<? endif ?>
<? endforeach ?>
