<?php

define('ROOT_DIR', dirname(dirname(__FILE__)));
require(ROOT_DIR.'/inc/acorn.php');

Acorn::$include_paths[] = ROOT_DIR;
Acorn::$include_paths[] = ROOT_DIR.'/inc';
Acorn::$include_paths[] = ROOT_DIR.'/app';
Acorn::$cache_path = $_SERVER['DOCUMENT_ROOT'].'/cache';

include(ROOT_DIR . '/inc/db.php');
