<?php

$url = substr($_SERVER['REQUEST_URI'], 1);

// If no URL was requested, go home.
if (empty($url))
{
  include('index.php');
  exit;
}

// If it's a short url, open redirect.php.
if (substr($url, 0, 1) === '~')
{
  $_GET['u'] = substr($url, 1);
  include('s/redirect.php');
}
