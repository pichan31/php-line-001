<?php
echo "push.php?id=xxxxxxxxxxxxx&msg=xxxxxxxx"."<hr>";
print_r($_GET);



include ('../config.php');
include ('../line-bot.php');


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
