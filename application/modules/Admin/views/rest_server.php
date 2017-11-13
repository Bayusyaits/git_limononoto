        <div class="lm-page-dashboard">
<section class="lm-module-container lm-banner lm-banner-home fade out">
        <div class="lm-container">
         <?php
    echo $this->tb_dyn_menu->build_menu_title();
	?>
        </div>
      </section>
      <article class="lm-inner lm-<?php echo uri_string();?>-modal lm-module-container">
 <div class="lm-container-fluid fade out"> 
 <div class="lm-modal-container">
        <p>
            See the article
            <a href="http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/" target="_blank">
                http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/
            </a>
        </p>

        <p>
            The master project repository is
            <a href="https://github.com/chriskacerguis/codeigniter-restserver" target="_blank">
                https://github.com/chriskacerguis/codeigniter-restserver
            </a>
        </p>
        <p>
        <?php
        	$_login = $this->session->userdata('login');
	$_last_login = $_login['last_login'];
	        $time_since = time() - date('Y-m-d H:i:s', $_last_login);
	        $headers = $this->input->get_request_header('Authorization');
	        var_dump($headers);	 
	         $this->config->load('validation_rules');
	         $config = is_dir('./feeds/');
	         var_dump($config);
	         $plaintext = encrypt_plaintext('525');
	         $decrypt = decrypt_ciphertext('Udd5OV89pQu3Ny0SWMTaJhSRZfv4foYkMXboRMgoQKVUW9UKAjUMmqzk/rlIQK7KVNmQetr/WSZYwe0n5nBVhA==');
	         $domainName = $_SERVER['HTTP_HOST'] . '/';
	         $arrContextOptions=array(
	    "ssl"=>array(
	        "verify_peer"=>false,
	        "verify_peer_name"=>false,
	    ),
	);  
			 $results = $this->opengraph;
			 print_r($results);
			 //echo $decrypt;
        ?>
        </p>
		
        <ol>
            <li><a href="<?php echo site_url('api/users'); ?>">Users</a> - defaulting to JSON</li>
            <li><a href="<?php echo site_url('api/users/format/csv'); ?>">Users</a> - get it in CSV</li>
            <li><a href="<?php echo site_url('api/users/id/1530817002'); ?>">User #1</a> - defaulting to JSON  (users/id/1)</li>
            <li><a href="<?php echo site_url('api/users/1530817002'); ?>">User #1</a> - defaulting to JSON  (users/1)</li>
            <li><a href="<?php echo site_url('api/users/id/1530817002.xml'); ?>">User #1</a> - get it in XML (users/id/1.xml)</li>
            <li><a href="<?php echo site_url('api/users/id/1530817002/format/xml'); ?>">User #1</a> - get it in XML (users/id/1/format/xml)</li>
            <li><a href="<?php echo site_url('api/users/id/1530817002?format=xml'); ?>">User #1</a> - get it in XML (users/id/1?format=xml)</li>
            <li><a href="<?php echo site_url('api/users/1530817002.xml'); ?>">User #1</a> - get it in XML (users/1.xml)</li>
            <li><a id="ajax" href="<?php echo site_url('api/users/format/json'); ?>">Users</a> - get it in JSON (AJAX request)</li>
            <li><a href="<?php echo site_url('api/users.html'); ?>">Users</a> - get it in HTML (users.html)</li>
            <li><a href="<?php echo site_url('api/users/format/html'); ?>">Users</a> - get it in HTML (users/format/html)</li>
            <li><a href="<?php echo site_url('api/users?format=html'); ?>">Users</a> - get it in HTML (users?format=html)</li>
        </ol>

    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>'.CI_VERSION.'</strong>' : '' ?></p>
	</div>
      </article>
</article>
</div><!-- Lm-Page -->
