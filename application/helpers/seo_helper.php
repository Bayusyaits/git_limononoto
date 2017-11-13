<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SEO Helper
 *
 * Generates Meta tags for search engines optimizations, open graph, twitter, robots
 *
 * @author		Elson Tan (elsodev.com, Twitter: @elsodev)
 * @version     1.0
 */

/**
 * SEO General Meta Tags
 *
 * Generates general meta tags for description, open graph, twitter, robots
 * Using title, description and image link from config file as default
 *
 * @access  public
 * @param   array   enable/disable different meta by setting true/false
 * @param   string  Title
 * @param   string  Description (155 characters)
 * @param   string  Image URL
 * @param   string  Page URL
 */
if(! function_exists('link_icon')){
function link_icon()
	{
			$output  = '<meta name="HandheldFriendly" content="True">';
			$output .= "\t".'<meta name="MobileOptimized" content="320">'."\n";
			$output .= "\t".'<link rel="canonical" href="'.site_url().''.uri_string().'">'."\n";
			$output .= "\t".'<link rel="shortcut icon" href="'.img_url().'favicon/logo.ico">'."\n";
            $output .= "\t".'<link rel="icon" type="image/png" sizes="32x32" href="'.img_url().'favicon/favicon-32x32.png">'."\n";
            $output .= "\t".'<link rel="icon" type="image/png" sizes="194x194" href="'.img_url().'favicon/favicon-194x194.png">'."\n";
            $output .= "\t".'<link rel="apple-touch-icon" sizes="72x72" href="'.img_url().'favicon/apple-touch-icon-72x72.png">'."\n";
            $output .= "\t".'<link rel="apple-touch-icon" sizes="114x114" href="'.img_url().'favicon/apple-touch-icon-114x114.png">'."\n";
            $output .= "\t".'<link rel="apple-touch-icon" sizes="144x144" href="'.img_url().'favicon/apple-touch-icon-144x144.png">'."\n";
            $output .= "\t".'<link rel="apple-touch-icon" href="'.img_url().'favicon/apple-touch-icon.png">'."\n";
            

		return $output;
	}
	}
if(! function_exists('facebook_xmlns')){
function facebook_xmlns()
	{
		return 'xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/"';
	}
	}
	if(! function_exists('facebook_app_id')){
	function facebook_app_id()
	{
		$ci =& get_instance();
		
		return $ci->config->item('facebook_app_id');
	}
	}
	if(! function_exists('facebook_picture')){
	function facebook_picture($who = 'me')
	{
		$ci =& get_instance();
		
		return $ci->facebook->append_token($ci->config->item('facebook_api_url').$who.'/picture');
	}
	}
	if(! function_exists('facebook_opengraph_meta')){
	function facebook_opengraph_meta($opengraph)
	{
		$ci =& get_instance();
		
		$return = '<meta property="fb:admins" content="'.$ci->config->item('facebook_admins').'">';
		$return .= "\n";
		$return .= '<meta property="fb:app_id" content="'.$ci->config->item('facebook_app_id').'">';
		$return .= "\n";
		$return .= '<meta property="og:site_name" content="'.$ci->config->item('facebook_site_name').'">';
		$return .= "\n";	 
		
		foreach ( $opengraph as $key => $value )
		{
			$return .= '<meta property="og:'.$key.'" content="'.$value.'" />';
			$return .= "\n";
		}
		
		return $return;
	}
	}
if(! function_exists('meta_tags')){
    function meta_tags($opengraph){
        $ci =& get_instance();
        $ci->config->load('seo_config');
		$enable = array('general' => true, 'og'=> true, 'twitter'=> true, 'robot'=> true);
        $output = '';
        $title = '';
        $desc = '';
        $imgurl ='';
        $url = '';
        $keywords = '';
        //uses default set in seo_config.php
        if($title == ''){
            $title = $ci->config->item('seo_title');
        }
        if($desc == ''){
            $desc = $ci->config->item('seo_desc');
        }
        if($imgurl == ''){
            $imgurl = $ci->config->item('seo_imgurl');
        }
        if($keywords == ''){
            $keywords = $ci->config->item('seo_keywords');
        }
        if($url == ''){
            $url = base_url();
        }


        if($enable['general']){
        	$output .= "\t".'<meta name="title" content="'.$opengraph['title'].'">'."\n";
        	$output .= "\t".'<meta name="keywords" content="'.$keywords.'" />'."\n";
            $output .= "\t".'<meta name="description" content="'.$opengraph['description'].'">'."\n";
            $output .= "\t".'<link rel="shortlink" href="https://goo.gl/KnMFWz">'."\n";
            $output .= "\t".'<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">'."\n";
            $output .= "\t".'<meta name="google-site-verification" content="8lOYSQGEdE52PiKd2wqsR6qXPqNy5msUFg2CPnhJLKs">'."\n";
        }
        if($enable['robot']){
            $output .= "\t".'<meta name="robots" content="index,follow">'."\n";

        } else {
            $output .= "\t".'<meta name="robots" content="noindex,nofollow">'."\n";
        }
        $output .= "\t".'<meta name="referrer" content="unsafe-url">'."\n";
		$output .= "\t".'<meta name="twitter:card" content="summary">'."\n";
		$output .= "\t".'<meta name="twitter:site" content="'.$ci->config->item('twitter_site').'">'."\n";
		$output .= "\t".'<meta name="twitter:creator" content="'.$ci->config->item('twitter_creator').'">'."\n";
		foreach ( $opengraph as $key => $value )
		{
        //twitter card
        if($enable['twitter']){
            $output .= "\t".'<meta name="twitter:'.$key.'" content="'.$value.'">'."\n";
        }

		}
		return $output;
    }
    
}

if(! function_exists('meta_profile')){
    function meta_profile($profile){
		

        //twitter card
        	$output = '';
            $output .= "\t".'<meta name="profile:first_name" content="'.decrypt_ciphertext($profile['first_name']).'"/>'."\n";
            $output .= "\t".'<meta name="profile:last_name" content="'.decrypt_ciphertext($profile['last_name']).'"/>'."\n";

		return $output;
    }
    
}

if(! function_exists('meta_apps')){
    function meta_apps(){
    	$output = '';
        $output .= "\t".'<meta name="msapplication-TileColor" content="#f3202a"/>'."\n";
        $output .= "\t".'<meta name="msapplication-TileImage" content="'.img_url().'favicon/mstile-144x144.png"/>'."\n";
        $output .= "\t".'<meta name="theme-color" content="#ffffff"/>'."\n";
		return $output;
    }
    
}