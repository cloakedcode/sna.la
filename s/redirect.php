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

// The URL has been shortened, so record tracking data.
$referer = $_SERVER['HTTP_REFERER'];
$ip = realIP();

ShortUrlClick::track_click($short, $referer, $ip);

//header('HTTP/1.1 301 Moved Permanently');
//header('Location: '.$short->long);

function realIP()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
  {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
  {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
