<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Bower for Codeigniter 3
 * @author Yoann VANITOU
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @link https://github.com/maltyxx/bower
 */


$config['css']['page'] = array(
    array('src' => cdn_url().'cilm/css/lm-print.css')
);

$config['js']['page'] = array(
    array('src' => cdn_url().'cilm/js/jquery.min.js')
);

$config['img']['page'] = array(
    array('src' => cdn_url().'cilm/images/favicon/logo.ico')
);
