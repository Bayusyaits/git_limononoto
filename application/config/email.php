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
    'smtp_user' => 'info@limononoto.com',
    'smtp_pass' => 'bFAPQfX8HrXxGhD8',
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'crlf' => '\n',
    'newline' => '\r\n',
    'wordwrap' => TRUE
);
/* End of file email.php */
/* Location: ./system/application/config/email.php */