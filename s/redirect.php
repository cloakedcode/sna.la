<?php

if (empty($_GET['u']))
{
  header('Location: /s');
  exit;
}

define('ROOT_DIR', '.');
require('../acorn.php');
require('../db.php');

Acorn::$cache_path = '../cache';

$short = ShortUrl::fromShort($_GET['u']);

if ($short === false)
{
  header('Location: /s');
  exit;
}

header('HTTP/1.1 301 Moved Permanently');
header('Location: '.$short);
