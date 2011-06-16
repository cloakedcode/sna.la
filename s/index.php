<?php

define('ROOT_DIR', '.');
require('../acorn.php');

Acorn::$include_paths[] = '../';
Acorn::$cache_path = '../cache';

Acorn::renderView('home');
