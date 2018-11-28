<?php

// ===================================================================================================
// This IPN listener will dump results to a text file. Make sure you have IPN ENABLED in your PayPal
// control panel, and the correct URL set to point to this file on your server.
// ===================================================================================================

$myFile = "IPNDump.txt";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "==== " . date('r') . " ====" . chr(13) . chr(10);

while (list($key, $value) = each($_POST))
{
	if ("" != $value)
	{
		$stringData .= "POST: $key = $value" . chr(13) . chr(10);
	}
}

fwrite($fh, $stringData);
fclose($fh);

echo "This is an IPN listener. Make sure you have IPN ENABLED in your PayPal control panel, and the correct URL set to point to this file on your server.";
?>