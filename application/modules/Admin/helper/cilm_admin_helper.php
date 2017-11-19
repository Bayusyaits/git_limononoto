<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('div_open'))
{
	function div_open($class = NULL, $id = NULL)
	{
	    $code   = '<div ';
	    $code   .= ( $class != NULL )   ? 'class="'. $class .'" '   : '';
	    $code   .= ( $id != NULL )      ? 'id="'. $id .'" '         : '';
	    $code   .= '>';
	    return $code;
	}
	}
if ( ! function_exists('div_close'))
{
function div_close()
{
    return '</div>';
}
}
?>