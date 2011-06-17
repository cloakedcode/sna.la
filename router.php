<?php

echo "<pre>".print_r($_SERVER, true).'</pre>';
if (empty($_SERVER['QUERY_STRING']))
{
  header('Location: /');
  exit;
}

$url = $_GET['u'];


