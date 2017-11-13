<?php

require_once APPPATH . 'modules/Rest_server/libraries/JWT.php';

use \Firebase\JWT\JWT;

class Authorization
{
    
    public static function tokenIsExist($headers)
    {
        return (array_key_exists('Authorization', $headers)
            && !empty($headers['Authorization']));
    }
}
