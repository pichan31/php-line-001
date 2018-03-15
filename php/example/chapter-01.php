<?php

//include ('line-bot-api/php/line-bot.php');
include ('../line-bot.php');

$channelSecret = 'a0723beec81191cfa84532647eda4490';
$access_token  = '+FPbwVPcxPAUeI9hWgihaa+SbMxPrqFCF8l9ljKQuVLKwj7NwiG5lPrj3Hzbk6SD33zAdxi+nnbhtznPtX+8M+MeDrvJ3+5yS1uF6xATQ3mvCZs/+7K6ysy+9Mxqjp+YtkGdqSryBMNdJd2tkmNX+gdB04t89/1O/w1cDnyilFU=';

$bot = new BOT_API($channelSecret, $access_token);
	
if (!empty($bot->isEvents)) {
		
    $bot->replyMessageNew($bot->replyToken, json_encode($bot->message));

    if ($bot->isSuccess()) {
        echo 'Succeeded!';
        exit();
    }

    // Failed
    echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
    exit();

}
