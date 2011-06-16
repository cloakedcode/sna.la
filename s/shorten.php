<?php

if (empty($_POST['url']))
{
  header('Location: /s');
  exit;
}

define('LOAD_DB', TRUE);
require('../inc/setup.php');

$short = ShortUrl::toShort($_POST['url']);

if ($short === false)
{
  header('Location: /s');
  exit;
}

echo $short;
