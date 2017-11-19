<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('div_open'))
{
	function div_open($class = NULL, $id = NULL, $ref_id = NULL)
	{
	    $code   = '<div ';
	    $code   .= ( $class != NULL )   ? 'class="'. $class .'" '   : '';
	    $code   .= ( $id != NULL )      ? 'id="'. $id .'" '         : '';
	    $code   .= ( $ref_id != NULL )      ? 'data-user="'. $ref_id .'" '  : '';
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
if ( ! function_exists('recurse'))
{
function recurse($path){
	    foreach(scandir($path) as $o){
	        if($o != "." && $o != ".."){
	            $full = $path . "/" . $o;
	            if(is_dir($full)){
	                if(!file_exists($full . "/")){
	                    file_put_contents($full . "/", "");
	                }
	                recurse($full);
	            }
	        }
	    }
	}
}
if ( ! function_exists('force_ssl'))
{
function force_ssl() {
    if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
        $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        redirect($url);
        exit;
    }
}
}
if ( ! function_exists('urlRawDecode'))
{
function urlRawDecode($raw_url_encoded)
{
    # Hex conversion table
    $hex_table = array(
        0 => 0x00,
        1 => 0x01,
        2 => 0x02,
        3 => 0x03,
        4 => 0x04,
        5 => 0x05,
        6 => 0x06,
        7 => 0x07,
        8 => 0x08,
        9 => 0x09,
        "A"=> 0x0a,
        "B"=> 0x0b,
        "C"=> 0x0c,
        "D"=> 0x0d,
        "E"=> 0x0e,
        "F"=> 0x0f
    );
        
    # Fixin' latin character problem
        if(preg_match_all("/\%C3\%([A-Z0-9]{2})/i", $raw_url_encoded,$res))
        {
            $res = array_unique($res = $res[1]);
            $arr_unicoded = array();
            foreach($res as $key => $value){
                $arr_unicoded[] = chr(
                        (0xc0 | ($hex_table[substr($value,0,1)]<<4)) 
                       | (0x03 & $hex_table[substr($value,1,1)])
                );
                $res[$key] = "%C3%" . $value;
            }

            $raw_url_encoded = str_replace(
                                    $res,
                                    $arr_unicoded,
                                    $raw_url_encoded
                        );
        }
        
        # Return decoded  raw url encoded data 
        return rawurldecode($raw_url_encoded);
}
}

if ( ! function_exists('encrypt_email'))
{	
	function encrypt_email($plaintext){
	$ci =& get_instance();
       $key = '3N240493WOOCUQBaL1LNADVPqeF3ifPr';
       $ciphertext = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $plaintext, MCRYPT_MODE_ECB)));
	return $ciphertext;
}
}
if ( ! function_exists('decrypt_email'))
{	
	function decrypt_email($ciphertext){
	$ci =& get_instance();
       $key = '3N240493WOOCUQBaL1LNADVPqeF3ifPr';
       $plaintext = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($ciphertext), MCRYPT_MODE_ECB));
	return $plaintext;
}
}
if ( ! function_exists('encrypt_plaintext'))
{	
	function encrypt_plaintext($plaintext){
	$ci =& get_instance();
       //load databse library
       $ci->load->library('encrypt');
       $key = $ci->config->item('encryption_key');
       $ciphertext = $ci->encrypt->encode($plaintext,$key);
	return $ciphertext;
}
}
if ( ! function_exists('remove_element'))
{	
function remove_element($element, $array)
{
   //array_search returns index of element, and FALSE if nothing is found
   $index = array_search($element, $array);
   unset ($array[$index]);
   return $array; 
}
}
if ( ! function_exists('file_extention'))
{	
function file_extention($file)
{
   return pathinfo($file, PATHINFO_EXTENSION); 
}
}
if ( ! function_exists('decrypt_ciphertext'))
{	
	function decrypt_ciphertext($ciphertext){
	$ci =& get_instance();
       //load databse library
       $ci->load->library('encrypt');
       $key = $ci->config->item('encryption_key');
       $decrypt = $ci->encrypt->decode($ciphertext,$key);
	return $decrypt;
}
}
if ( ! function_exists('is_url_exist'))
{	
	function is_url_exist($url){
	    $ch = curl_init($url);    
	    curl_setopt($ch, CURLOPT_NOBODY, true);
	    curl_exec($ch);
	    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	
	    if($code == 200){
	       $status = true;
	    }else{
	      $status = false;
	    }
	    curl_close($ch);
	   return $status;
	}
	}
if ( ! function_exists('restrict_writing'))
{
function restrict_writing($str, $n = 500, $end_char = '.')
	{
		if (mb_strlen($str) < $n)
		{
			return $str;
		}

		// a bit complicated, but faster than preg_replace with \s+
		$str = preg_replace('/ {2,}/', ' ', str_replace(array("\r", "\n", "\t", "\v", "\f"), ' ', $str));

		if (mb_strlen($str) <= $n)
		{
			return $str;
		}

		$out = '';
		foreach (explode(' ', trim($str)) as $val)
		{
			$out .= $val.' ';

			if (mb_strlen($out) >= $n)
			{
				$out = trim($out);
				return (mb_strlen($out) === mb_strlen($str)) ? $out : $out.$end_char;
			}
		}
	}
}
if ( ! function_exists('generateRandomString'))
{
    
  function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}
}
if ( ! function_exists('removes_special_chars'))
{
function removes_special_chars($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}
}
if ( ! function_exists('remove_ext'))
{
function remove_ext($string) {

return preg_replace('/\\.[^.\\s]{3,4}$/', '', $string);
}
}
if ( ! function_exists('clean_chars_and_space'))
{
function clean_chars_and_space($string) {
$search = array('/[^A-Za-z0-9\-]/', '_');
$replace = array(' ', ' ');
$subject = $string;
return str_replace($search, $replace, $subject); 
}
}
if ( ! function_exists('generateRandomNumeric'))
{
    
  function generateRandomNumeric($length = 10) {
	    $numeric = '0123456789';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $numeric[rand(0, strlen($numeric) - 1)];
	    }
	    return $randomString;
	}
}
if ( ! function_exists('is_valid_domain_name'))
{
function is_valid_domain_name($domain_name)
{
    return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
            && preg_match("/^.{1,253}$/", $domain_name) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)   ); //length of each label
}
}

if ( ! function_exists('set_cookie'))
{
function set_cookie($name = '', $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = FALSE)
{
    if (is_array($name))
    {
        // always leave 'name' in last place, as the loop will break otherwise, due to $$item
        foreach (array('value', 'expire', 'domain', 'path', 'prefix', 'secure', 'name') as $item)
        {
            if (isset($name[$item]))
            {
                $$item = $name[$item];
            }
        }
    }

    if ($prefix == '' AND config_item('cookie_prefix') != '')
    {
        $prefix = config_item('cookie_prefix');
    }
    if ($domain == '' AND config_item('cookie_domain') != '')
    {
        $domain = config_item('cookie_domain');
    }
    if ($path == '/' AND config_item('cookie_path') != '/')
    {
        $path = config_item('cookie_path');
    }
    if ($secure == FALSE AND config_item('cookie_secure') != FALSE)
    {
        $secure = config_item('cookie_secure');
    }

    if ( ! is_numeric($expire))
    {
        $expire = time() - 86500;
    }
    else
    {
        $expire = ($expire > 0) ? time() + $expire : 0;
    }

    setcookie($prefix.$name, $value, $expire, $path, $domain, $secure);
}
}

if ( ! function_exists('generateToken'))
{
	function generateToken($length = 20)
	{
	$buf = '';
    for ($i = 0; $i < $length; ++$i) {
        $buf .= chr(mt_rand(0, 255));
    }
    return bin2hex($buf);
	}

}

if ( ! function_exists('multiple_upload')){
 function multiple_upload($path,$userfile)
{       
	$ci =& get_instance();
	$ci->load->library(array('upload'));
	$ci->load->helper(array('asset'));
   $number_of_files_uploaded = count($_FILES[$userfile]['name']);
   $folder = './cdn/cilm/uploads/'.$path.'/';
   if(!is_dir($folder)) { mkdir($folder, 0777, TRUE); }
    // Faking upload calls to $_FILE
    for ($i = 0; $i < $number_of_files_uploaded; $i++) 
    {           
      $_FILES['userfile']['name']     = $_FILES[$userfile]['name'][$i];
      $_FILES['userfile']['type']     = $_FILES[$userfile]['type'][$i];
      $_FILES['userfile']['tmp_name'] = $_FILES[$userfile]['tmp_name'][$i];
      $_FILES['userfile']['error']    = $_FILES[$userfile]['error'][$i];
      $_FILES['userfile']['size']     = $_FILES[$userfile]['size'][$i];
		$config = array(
        'allowed_types' => 'jpg|png|jpeg|pdf|doc|docx|mp4',
        'max_size'      => 1240,
        'max_width'      => 1280,
        'max_height'      => 960,
        'overwrite'     => TRUE,
        
        /* real path to upload folder ALWAYS */
        'upload_path' => $folder
      );
        $ci->upload->initialize($config);
        $ci->upload->do_upload();
    }
}
}
if ( ! function_exists('base64_image')){
 function base64_image($path)
{ 
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
return 'data:image/' . $type . ';base64,' . base64_encode($data);
}
}
if ( ! function_exists('name_image')){
 function name_image($path)
{ 
$type = pathinfo($path, PATHINFO_EXTENSION);
return file_get_contents($path);
}
}
if ( ! function_exists('delete_file_upload')){
function delete_file_upload($path){
	$folder = './cdn/cilm/uploads/'.$path.'/';
    $files = glob($folder.'*'); // get all file names
    foreach($files as $file){ // iterate files
      if(is_file($file))
        unlink($file); // delete file
        //echo $file.'file deleted';
    }   
}
}
if ( ! function_exists('tb_ui_users_email')){
   function tb_ui_users_email($user_email){
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       //select the required fields from the database
	    $ci->db->select('first_name, last_name');
	 
	    //tell the db class the criteria
	    $ci->db->where('email', $user_email);
	 
	    //supply the table name and get the data
	    $row = $ci->db->get('tb_ui_users')->row();
	 
	    //get the full name by concatinating the first and last names
	    $user_name = ucfirst($row->first_name) . " " . ucfirst($row->last_name);
	 
	    // return the full name;
	    return $user_name;
  
   }
}//if_pages

if ( ! function_exists('insert_id_user')){
   function insert_id_user($insert_level){
   	$ci =& get_instance();
    //load databse library
    $ci->load->database();
	$ci->db->select('COUNT(id) as total');
    $ci->db->from('tb_ui_users');
    $result = $ci->db->count_all_results();
	$date = date("Y-m-d H:i:s a");
	$years = date('Y');
	$insert_month = date('m', strtotime($date));
	$insert_years = substr($years,2,2);
	$insert_id =  $result + 1;
	if($insert_id < 10){
		$insert_id = '00'.$insert_id;
	} else if($insert_id < 100){
		$insert_id = '0'.$insert_id;
	}else {
		$insert_id = $insert_id;
	}// else
	
	$create_id = '15'.$insert_level.''.$insert_month.''.$insert_years.''.$insert_id;
	return $create_id;
   
   }
}
if ( ! function_exists('insert_id_team')){
   function insert_id_team($service_id){
   	$ci =& get_instance();
    //load databse library
    $ci->load->database();
	$ci->db->select('COUNT(id) as total');
    $ci->db->from('tb_ui_team');
    $result = $ci->db->count_all_results();
	$date = date("Y-m-d H:i:s a");
	$years = date('Y');
	$insert_month = date('m', strtotime($date));
	$insert_years = substr($years,2,2);
	$insert_id =  $result + 1;
	if($insert_id < 10){
		$insert_id = '00'.$insert_id;
	} else if($insert_id < 100){
		$insert_id = '0'.$insert_id;
	}else {
		$insert_id = $insert_id;
	}// else
	
	$create_id = $service_id.''.$insert_month.''.$insert_years.''.$insert_id;
	return $create_id;
   
   }
}
if ( ! function_exists('count_user')){
   function count_user(){
   	$ci =& get_instance();
    //load databse library
    $ci->load->database();
	$ci->db->select('COUNT(id) as total');
    $ci->db->from('tb_ui_users');
    $result = $ci->db->count_all_results();	
	return $result;
   
   }
}

if ( ! function_exists('insert_id_contact')){
   function insert_id_contact($insert_subject){
   	$ci =& get_instance();
    //load databse library
    $ci->load->database();
	$ci->db->select('COUNT(id) as total');
    $ci->db->from('tb_dyn_menu_contact');
    $result = $ci->db->count_all_results();
	$years = date('Y');
	$insert_years_contact = substr($years,2,2);
	$insert_subject = substr($insert_subject,-2);
	$insert_id_contact =  $result + 1;
	$create_id_contact = '6'.$insert_subject.''.$insert_years_contact.''.$insert_id_contact;
	return $create_id_contact;
   
   }
}
if ( ! function_exists('insert_id_newsletter')){
   function insert_id_newsletter(){
   	$ci =& get_instance();
    //load databse library
    $ci->load->database();
	$ci->db->select('COUNT(id) as total');
    $ci->db->from('tb_cli_newsletter');
    $result = $ci->db->count_all_results();
	$years = date('Y');
	$insert_years_contact = substr($years,2,2);
	$insert_id_contact =  $result + 1;
	$create_id_contact = '53A'.$insert_years_contact.''.$insert_id_contact;
	return $create_id_contact;
   }
}
if ( ! function_exists('insert_id_job_aplicant')){
   function insert_id_job_aplicant($insert_subject){
   	$ci =& get_instance();
    //load databse library
    $ci->load->database();
	$ci->db->select('COUNT(id) as total');
    $ci->db->from('tb_dyn_menu_join');
    $result = $ci->db->count_all_results();
	$years = date('Y');
	$insert_years_contact = substr($years,2,2);
	$insert_subject = substr($insert_subject,-2);
	$insert_id_contact =  $result + 1;
	
	$create_id_contact = '612'.$insert_subject.''.$insert_years_contact.''.$insert_id_contact;
	return $create_id_contact;
   
   }
}

 //check user has been activation in database
 if ( ! function_exists('activation_check')){
    function activation_check($activation)
	{
	 if($activation == '4'){
	 return $activation;
	 }else{
	 $activation = '';
	 return $activation; 
	 }
	 }
 }

if ( ! function_exists('date_to_en'))
{
//** Format Tanggal YYYY-MM-DD **//
function date_to_en($date){
	$date_en = date("Y-m-d H:i:s", $date);
	$month_array = date('m', strtotime($date_en));
	$dateObj   = DateTime::createFromFormat('!m', $month_array);
	$month = $dateObj->format('F');
	$date = date('d', strtotime($date_en));
	$year = substr($date_en, 0 , 4);
	$monthName = substr($month, 0 , 3);
	$date_en = $monthName." ".$date.", ".$year;
	if($date_en == '1970-01-01'){
		return '';
	} else {
		return $date_en;
	}
}//function_date_to_en
}// if_date_to_en
if ( ! function_exists('date_to_time'))
{
//** Format Tanggal YYYY-MM-DD **//
function date_to_time($date){
	$time = date('Y-m-d H:i:s', strtotime($date));
	return $time;
}//function_date_to_en
}// if_date_to_en

if ( ! function_exists('date_to_id'))
{
//** Format Tanggal DD-MM-YYYY **//
function date_to_id($date){
	$date_id = date("Y-m-d H:i:s", $date);
	$date_i = date('Y-m-d', strtotime($date_id));
	if($date_i == '1970-01-01'){
		return '';
	} else {
		return $date_i;
	}
}//function_date_to_id
}//if date_to_id

if ( ! function_exists('date_time_id'))
{
//** Format Tanggal DD-MM-YYYY **//
function date_time_id($date){
	$date_id = date("Y-m-d H:i:s", $date);
	$month_array = date('m', strtotime($date_id));
	$date_array = substr($date_id, 8 , 2);
	$newDateTime = date('h:i A', strtotime($date_id));
    $day_array = date('w', strtotime($date_id));
    $year = substr($date_id, 2 , 2);
    $date_i = $month_array." ".$date_array."' ".$year." at ".$newDateTime."";
	if($date_i == '1970-01-01'){
		return '';
	} else {
		return $date_i;
	}
}//function_date_to_id
}//if date_to_id
if ( ! function_exists('date_time_en'))
{
//** Format Tanggal DD-MM-YYYY **//
function date_time_en($date){
	$date_id = date("Y-m-d H:i:s", $date);
	$month_array = date('m', strtotime($date_id));
	$dateObj   = DateTime::createFromFormat('!m', $month_array);
	$month = $dateObj->format('F');
	$monthName = substr($month, 0 , 3);
	$date = date('d', strtotime($date_id));
	$newDateTime = date('h:i A', strtotime($date_id));
	$year = substr($date_id, 0 , 4);
    $date_i = $monthName." ".$date.", ".$year." at ".$newDateTime."";
	if($date_i == '1970-01-01'){
		return '';
	} else {
		return $date_i;
	}
}//function_date_to_id
}//if date_to_id

if ( ! function_exists('user_id'))
{
//** Format id user cilm_prefix_limononoto_id **//
function user_id($user_id){
	$prefix = config_item('la_prefix_user_id');
	$leadingzeros = '0000';
	$userid = $prefix . substr($leadingzeros, 0, (-strlen($user_id))) . $user_id;
	return $userid;
}//function_user_id
}// if_user_id

//** Format id int **//
if ( ! function_exists('get_user_id'))
{
function get_user_id($userid){
	return intval(substr($userid, 4, 4));
	
}//function_get_user_id
}//if_get_user_id
if ( ! function_exists('delete_cache'))
{
function delete_cache($uri_string=null)
{
    $CI =& get_instance();
    $path = $CI->config->item('cache_path');
    $path = rtrim($path, DIRECTORY_SEPARATOR);

    $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

    $uri =  $CI->config->item('base_url').
            $CI->config->item('index_page').
            $uri_string;

    $cache_path .= md5($uri);

    return unlink($cache_path);
}
}


?>