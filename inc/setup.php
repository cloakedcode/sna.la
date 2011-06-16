<?php

define('ROOT_DIR', dirname(dirname(__FILE__)));
require(ROOT_DIR.'/inc/acorn.php');

Acorn::$include_paths[] = ROOT_DIR;

if (isset($_SERVER['IS_ON_PAGODA']))
{
  Acorn::$cache_path = '/etc/cache';
  var_dump(file_exists(Acorn::$cache_path));
  var_dump(system('ls /'));
}
else
{
  Acorn::$cache_path = $_SERVER['DOCUMENT_ROOT'].'/cache';
}

if (defined('LOAD_DB') && LOAD_DB === TRUE)
{
  if (isset($_SERVER['IS_ON_PAGODA']))
  {
    Acorn::database(array(
      'user'      => 'lovetta',
      'password'  => '8FSdkouf',
      'database'  => 'laverna',
      'host'      => 'localhost:/tmp/mysql/laverna.sock',
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
