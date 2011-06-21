<?php

if (empty($_GET['f']) === false)
{
  require('./lessphp/lessc.inc.php');
  $input = $_SERVER['DOCUMENT_ROOT'].'/css/'.$_GET['f'].'.less';
  $output = $_SERVER['DOCUMENT_ROOT'].'/cache/'.$_GET['f'].'.css';

  try {
    lessc::ccompile($input, $output);
  }
  catch (exception $ex) {
    exit($ex->getMessage());
  }

  header('Content-type: text/css');

  readfile($output);
}
