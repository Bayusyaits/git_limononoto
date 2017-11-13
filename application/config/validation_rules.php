<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// untuk auto load folder library
$config['login'] = array(
		               array(
		                     'field'   => 'email',
		                     'label'   => 'Email',
		                     'rules'   => 'trim|required|valid_email'
		               ),
		               array(
		                     'field'   => 'password',
		                     'label'   => 'Password',
		                     'rules'   => 'trim|required'
		               )
		        );
$config['twofactor'] = array(
		               array(
		                     'field'   => 'code',
		                     'label'   => 'Verification code',
		                     'rules'   => 'trim|required|numeric'
		               ),
		                  array(
		                     'field'   => 'birthday',
		                     'label'   => 'Birthday',
		                     'rules'   => 'required|numeric'
		                  )
		        );	
$config['passwordreset'] = array(
		               array(
		                     'field'   => 'email',
		                     'label'   => 'Email',
		                     'rules'   => 'trim|required|valid_email'
		               )
		        );	
$config['resetpassword'] = array(
		               array(
		                     'field'   => 'code',
		                     'label'   => 'Activation Password',
		                     'rules'   => 'trim|required|numeric'
		               ),
		               array(
		                     'field'   => 'password',
		                     'label'   => 'Password',
		                     'rules'   => 'required|min_length[3]'
		                  ),
		                  array(
		                     'field'   => 'cpassword',
		                     'label'   => 'Confirm password',
		                     'rules'   => 'required|min_length[3]|matches[password]'
		                  )
		        );			        	        
$config['signup_terms'] = array(
		               array(
		                     'field'   => 'email',
		                     'label'   => 'Email',
		                     'rules'   => 'trim|required|valid_email|min_length[5]'
		               )
		        );
$config['newsletter'] = array(
		               array(
		                     'field'   => 'email',
		                     'label'   => 'Email',
		                     'rules'   => 'trim|required|valid_email|min_length[5]'
		               )
		        );		        
$config['activation'] = array(
		               array(
		                     'field'   => 'code',
		                     'label'   => 'Activation',
		                     'rules'   => 'trim|required|numeric'
		               )
		        );	        		       
$config['signup'] = array(
		               array(
		                     'field'   => 'firstname',
		                     'label'   => 'First name',
		                     'rules'   => 'required|alpha'
		                  ),
		                  array(
		                     'field'   => 'lastname',
		                     'label'   => 'Last name',
		                     'rules'   => 'required|alpha'
		                  ),
		                  array(
		                     'field'   => 'level',
		                     'label'   => 'Level user',
		                     'rules'   => 'required'
		                  ),
		                  array(
		                     'field'   => 'country',
		                     'label'   => 'Country',
		                     'rules'   => 'required'
		                  ),
		                  array(
		                     'field'   => 'password',
		                     'label'   => 'Password',
		                     'rules'   => 'required'
		                  ),
		                  array(
		                     'field'   => 'cpassword',
		                     'label'   => 'Confirm password',
		                     'rules'   => 'required|matches[password]'
		                  )
		        );
$config['contact'] = array(
		               array(
		                     'firstname'   => 'firstname',
		                     'label'   => 'First name',
		                     'rules'   => 'required|alpha|min_length[2]'
		                  ),
		               array(
		                     'lastname'   => 'lastname',
		                     'label'   => 'Last name',
		                     'rules'   => ''
		                  ),
		               array(
		                     'field'   => 'subject',
		                     'label'   => 'Subject',
		                     'rules'   => 'required'
		                  ), 
		                  array(
		                     'field'   => 'email',
		                     'label'   => 'Email',
		                     'rules'   => 'trim|required|valid_email|min_length[5]'
		                  ), 
		                  array(
		                     'field'   => 'phonenumber',
		                     'label'   => 'Phonenumber',
		                     'rules'   => 'trim|required|min_length[5]|max_length[15]'
		                  ),   
		               array(
		                     'field'   => 'message',
		                     'label'   => 'Message',
		                     'rules'   => 'required|min_length[2]'
		                  )
		            );
$config['join'] = array(
		               array(
		                     'firstname'   => 'firstname',
		                     'label'   => 'First name',
		                     'rules'   => 'required|alpha'
		                  ),
		               array(
		                     'lastname'   => 'lastname',
		                     'label'   => 'Last name',
		                     'rules'   => ''
		                  ),
		               array(
		                     'field'   => 'department',
		                     'label'   => 'Department',
		                     'rules'   => 'required'
		                  ), 
		                  array(
		                     'field'   => 'email',
		                     'label'   => 'Email',
		                     'rules'   => 'trim|required|valid_email|min_length[5]'
		                  ), 
		                  array(
		                     'field'   => 'phonenumber',
		                     'label'   => 'Phonenumber',
		                     'rules'   => 'trim|required|min_length[5]|max_length[15]'
		                  ),   
		               array(
		                     'field'   => 'answer',
		                     'label'   => 'Answer',
		                     'rules'   => 'required|min_length[2]'
		                  )
		            );		            