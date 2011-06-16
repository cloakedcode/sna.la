<?php

if (empty($_POST['url']))
{
  header('Location: /s');
  exit;
}

define('ROOT_DIR', '.');
require('../acorn.php');
require('../db.php');

Acorn::$cache_path = '../cache';

$short = ShortUrl::toShort($_POST['url']);

if ($short === false)
{
  header('Location: /s');
  exit;
}

echo $short;
