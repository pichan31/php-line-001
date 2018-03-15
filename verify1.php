<?php
$access_token = '+FPbwVPcxPAUeI9hWgihaa+SbMxPrqFCF8l9ljKQuVLKwj7NwiG5lPrj3Hzbk6SD33zAdxi+nnbhtznPtX+8M+MeDrvJ3+5yS1uF6xATQ3mvCZs/+7K6ysy+9Mxqjp+YtkGdqSryBMNdJd2tkmNX+gdB04t89/1O/w1cDnyilFU=';
$url = 'https://api.line.me/v1/oauth/verify';
$headers = array('Authorization: Bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
echo $result;
?>
