<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://play.warofgalaxyz.com/cronPanel.php?cronjobID=111');
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "");
$answer = curl_exec($ch);