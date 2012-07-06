<?php

include('inc/setup.php');

$glob = glob('posts/*.html');
$mod_time = filemtime($glob[0]);
header("Last-Modified: " . date('r', $mod_time));

Acorn::$vars['mod_time'] = $mod_time;
Acorn::$vars['posts'] = Post::posts();

Acorn::renderView('views/feed', '');
