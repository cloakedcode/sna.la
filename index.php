<?php

ini_set('date.timezone', 'America/New_York');

/*
 * Start up Acorn
 *
 */

require('inc/setup.php');

Acorn::$include_paths[] = './app';

$time = microtime(true);

Acorn::$vars['menu'] = Page::menuItems();

/*
 * Get the post(s)
 *
 */

$request = (empty($_GET['u'])) ? null : $_GET['u'];
$m = array();

// If it's a CSS file, parse the less file,
// and spit out the CSS.
if (preg_match('/^css\/(.+).css/', $request, $m))
{
    $_GET['f'] = $m[1];
    include('css/less.php');
}
// If it's a page.
else if (preg_match('/^([^\/]+).html$/', $request, $m))
{
    $p = Page::pageWithId($m[1]);

    if (empty($p))
    {
            Acorn::error(404);
            Acorn::renderView('views/notfound');
    }
    else
    {
            Acorn::$vars['page'] = $p;
            Acorn::$vars['title'] = $p->title;
            Acorn::renderView('views/page');
    }
}
// If it's a post.
else if (preg_match('/^([0-9]{4})\/?(([0-9]{2})\/?)?(([0-9]{2})\/?)?((.+?)(\.html))?$/', $request, $m))
{
    $p = Post::postWithId("{$m[1]}-{$m[3]}-{$m[5]}-{$m[7]}");

    if (empty($p))
    {
            Acorn::error(404);
            Acorn::renderView('views/notfound');
    }
    else
    {
            Acorn::$vars['post'] = $p;
            Acorn::$vars['title'] = $p->title;
            Acorn::renderView('views/post');
    }
}
// If it's anything else, show all posts.
else
{
        $p = Page::pageWithId('goodies');

        Acorn::$vars['page'] = $p;
        Acorn::$vars['title'] = $p->title;
        Acorn::renderView('views/page');
        /*
	Acorn::$vars['posts'] = Post::posts();
	Acorn::renderView('views/posts');
        */
}

echo '<!--- Page took: '.(microtime(true) - $time)."-->\n";
