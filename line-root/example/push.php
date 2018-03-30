<?php
echo "push.php?id=xxxxxxxxxxxxx&msg=xxxxxxxx"."<hr>";
print_r($_GET);


//include ('line-bot-api/php/line-bot.php');
include ('../line-bot.php');

// // AAA info
// $channelSecret = '284c868918e2a89b8e9d311c8f7ccdf3';
// $access_token  = 'bkL15evcI4ilmJveNzTW1KAUi5Wuir6z62Rj+cW6YKQmrJUVUGXbhwHdYQJRY7GHuSO8oTKr2v6P1mR3rFm0Wqs9DsO0tmamkbQgCw4gnXmQwmZ/CRCxGV4wgoKzZszjQI/pn2Yr+E9NB3ytWEYMIAdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'a0723beec81191cfa84532647eda4490';
$access_token  = '+FPbwVPcxPAUeI9hWgihaa+SbMxPrqFCF8l9ljKQuVLKwj7NwiG5lPrj3Hzbk6SD33zAdxi+nnbhtznPtX+8M+MeDrvJ3+5yS1uF6xATQ3mvCZs/+7K6ysy+9Mxqjp+YtkGdqSryBMNdJd2tkmNX+gdB04t89/1O/w1cDnyilFU=';

$bot = new BOT_API($channelSecret, $access_token);

$line_id = $_GET['id'];
$msg = $_GET['msg'];

if(!isset($_GET['id'])) { $bot->sendMessageNew('U08b751e137f4889902a101831ad96fda', 'Hello World !!');
} else $bot->sendMessageNew($line_id, $msg);

if ($bot->isSuccess()) {
    echo 'Succeeded!';
    exit();
}

// Failed
echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
exit();


?>
