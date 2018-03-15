<?php

$cs = 'a0723beec81191cfa84532647eda4490';
$cak ='+FPbwVPcxPAUeI9hWgihaa+SbMxPrqFCF8l9ljKQuVLKwj7NwiG5lPrj3Hzbk6SD33zAdxi+nnbhtznPtX+8M+MeDrvJ3+5yS1uF6xATQ3mvCZs/+7K6ysy+9Mxqjp+YtkGdqSryBMNdJd2tkmNX+gdB04t89/1O/w1cDnyilFU=';
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($cak);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $cs]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
$response = $bot->pushMessage('<to>', $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();


?>
