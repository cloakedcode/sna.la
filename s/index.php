<?php

require('../inc/setup.php');

Acorn::$include_paths[] = '../app';
Acorn::$vars['menu'] = Page::menuItems();

Acorn::renderView('s/home');
