<? if (empty($posts)) : ?>
    <? if (isset($tagged)) : ?>
    <p>There are no posts with that tag.</p>
    <? else : ?>
    <p>There are no posts yet, patience.</p>
    <? endif ?>
<? endif ?>
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
