<?php

if (empty($_GET['f']) === false)
{
    $root = $_SERVER['DOCUMENT_ROOT'];
    require($root.'css/lessphp/lessc.inc.php');
    $input = $root.'css/'.$_GET['f'].'.less';
    $output = $root.'cache/'.$_GET['f'].'.css';

    try {
        lessc::ccompile($input, $output);
    }
    catch (exception $ex) {
        exit($ex->getMessage());
    }

    header('Content-type: text/css');

    readfile($output);
}
