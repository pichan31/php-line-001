<?php

//include ('line-bot-api/php/line-bot.php');
include ('../line-bot.php');

$channelSecret = '284c868918e2a89b8e9d311c8f7ccdf3';
$access_token  = 'bkL15evcI4ilmJveNzTW1KAUi5Wuir6z62Rj+cW6YKQmrJUVUGXbhwHdYQJRY7GHuSO8oTKr2v6P1mR3rFm0Wqs9DsO0tmamkbQgCw4gnXmQwmZ/CRCxGV4wgoKzZszjQI/pn2Yr+E9NB3ytWEYMIAdB04t89/1O/w1cDnyilFU=';

$bot = new BOT_API($channelSecret, $access_token);
	
$bot->sendMessageNew('U08b751e137f4889902a101831ad96fda', 'Hello World !!');

if ($bot->isSuccess()) {
    echo 'Succeeded!';
    exit();
}

// Failed
echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
exit();

?>
