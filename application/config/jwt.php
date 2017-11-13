<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['jwt_key']	= '0dc85385f49c939a625ea74d13501671b66fe';
$config['jwt_issuer'] =  "http://".$_SERVER['HTTP_HOST'];
$config['jwt_nbf'] =  null;
$config['jwt_expiry'] = null;
$config['jwt_algorithm'] = 'HS512';
/* End of file jwt.php */
/* Location: ./application/config/jwt.php */