<?php defined('BASEPATH') OR exit('No direct script access allowed');

 
/*
| -------------------------------------------------------------------
| EMAIL CONFING
| -------------------------------------------------------------------
| Configuration of outgoing mail server.
| */

$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'ssl://mail.limononoto.com',
    'smtp_port' => 465,
    'smtp_user' => 'no-reply@limononoto.com',
    'smtp_pass' => '4DS+2X[lM*=$4X+q~fX8H%^*',
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'crlf' => '\n',
    'newline' => '\r\n',
    'wordwrap' => TRUE
);
/* End of file email.php */
/* Location: ./system/application/config/email.php */