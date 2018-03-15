<?php
$access_token = '3yyJDVAGUWvn4jY4Uu6jOnBIs8HelxE4eBSS0dodtqfOqjPCsebz5MIg2BV12EOT33zAdxi+nnbhtznPtX+8M+MeDrvJ3+5yS1uF6xATQ3krnKjgUZWcmyLOuWPafUDOd8ndRik3EPce2M6SJ13x0gdB04t89/1O/w1cDnyilFU=';
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
