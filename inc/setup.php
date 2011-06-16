<?php

define('ROOT_DIR', dirname(dirname(__FILE__)));
require(ROOT_DIR.'/inc/acorn.php');

Acorn::$include_paths[] = ROOT_DIR;
Acorn::$cache_path = $_SERVER['DOCUMENT_ROOT'].'/cache';

if (defined('LOAD_DB') && LOAD_DB === TRUE)
{
  if (isset($_SERVER['IS_ON_PAGODA']))
  {
    Acorn::database(array(
      'user'      => 'lovetta',
      'password'  => '8FSdkouf',
      'database'  => 'laverna',
      'socket'      => '/tmp/mysql/laverna.sock',
      'adapter'   => 'mysql',
      ));
  }
  else
  {
    Acorn::database(array(
      'user'      => 'root',
      'password'  => '',
      'database'  => 'snala',
      'host'      => '127.0.0.1',
      'adapter'   => 'mysql',
      ));
  }
}