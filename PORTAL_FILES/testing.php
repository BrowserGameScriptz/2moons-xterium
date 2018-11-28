<?php

define('MODE', 'LOGIN');
define('ROOT_PATH', str_replace('\\', '/',dirname(__FILE__)).'/');
set_include_path(ROOT_PATH);

require 'includes/common.php';

$encrypt_method = "AES-256-CBC";
		$secret_key = 'mFzSfd8q';
		$secret_iv = '2QhdrkjV';

		// hash
		$key = hash('sha256', $secret_key);
		
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);

//xevfrjdff23
//echo openssl_decrypt(base64_decode("dd"), $encrypt_method, $key, 0, $iv);

$newTestFleetRool = max(1,10-1);
					for ($i = 1; $i <= $newTestFleetRool; $i++) {
						echo $i;
					}
	
