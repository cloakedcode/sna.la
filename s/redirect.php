<?php

if (empty($_GET['u']))
{
  header('Location: /s');
  exit;
}

define('LOAD_DB', TRUE);
require($_SERVER['DOCUMENT_ROOT'].'/inc/setup.php');

$short = ShortUrl::fromShort($_GET['u']);

if ($short === false)
{
  header('Location: /s');
  exit;
}

header('HTTP/1.1 301 Moved Permanently');
header('Location: '.$short);
