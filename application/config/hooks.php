<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['pre_system'] = array(
    'class'     => '',
    'function'  => 'autoload',
    'filename'  => 'autoload.php',
    'filepath'  => 'hooks',
    'params'    => ''
);
// Compress output
$hook['display_override'][] = array(
	'class' => '',
	'function' => 'compress',
	'filename' => 'compress.php',
	'filepath' => 'hooks'
);
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
