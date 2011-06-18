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
if (isset($_SERVER['HTTP_REFERER']))
{
  ShortUrlClick::track_click($short, $_SERVER['HTTP_REFERER']);
}

ShortUrlLoc::track_ip($short, realIP());

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
