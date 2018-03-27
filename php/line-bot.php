<?php

include ('vendor/autoload.php');

use \LINE\LINEBot;
use \LINE\LINEBot\HTTPClient;
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot\MessageBuilder;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class BOT_API extends LINEBot {
    
    /* ====================================================================================
     * Variable
     * ==================================================================================== */
    
    private $httpClient     = null;
    private $endpointBase   = null;
    private $channelSecret  = null;
    
    public $content         = null;
    public $events          = null;
    
    public $isEvents        = false;
    public $isText          = false;
    public $isImage         = false;
    public $isSticker       = false;
    
    public $text            = null;
    public $replyToken      = null;
    public $source          = null;
    public $message         = null;
    public $timestamp       = null;
    
    public $response        = null;
    
    /* ====================================================================================
     * Custom
     * ==================================================================================== */
    
    public function __construct ($channelSecret, $access_token) {
        
        $this->httpClient     = new CurlHTTPClient($access_token);
        $this->channelSecret  = $channelSecret;
        $this->endpointBase   = LINEBot::DEFAULT_ENDPOINT_BASE;
        
        $this->content        = file_get_contents('php://input');
        $events               = json_decode($this->content, true);
        
        if (!empty($events['events'])) {
            
            $this->isEvents = true;
            $this->events   = $events['events'];
            
            foreach ($events['events'] as $event) {
                

                $this->replyToken = $event['replyToken']; //***
                $this->source     = (object) $event['source'];            
                //$this->message    = (object) $event['message'].'-*-'.$event['source']['userId'];    
                
                
                //$reTEXT = ' | Link: http://infinite-meadow-26690.herokuapp.com/php/example/chapter-03.php?id='.$event['source']['userId'].'&msg=xxx';



                //$this->message    = (object) $event['message'];
                //$this->message    = "userId : ".$event['source']['userId']." | TEXT : ".$event['message']['text'].$reTEXT;
                //$reTEXT = json_encode($event['message']['text']).'-'.'ภาษาไทย';
                //$str_return = '';
                //$str_return .= "userId : ".$event['source']['userId']." \n TEXT : ".$event['message']['text'].$reTEXT;
                //$str_return .= "TEXT : ".$event['message']['text'].'---'.json_encode($event['message']['text']).'***'.'ภาษาไทย';
                //$str_return .= "TEXT : ".$event['message']['text'].'---'.'ภาษาไทย';
                //$str_return .= "TEXT : ".$event['message']['text']."\n".'ภาษาไทย';
                //$str_return .= "\n";
                
                
                $url_info ='http://61.90.142.230/iadb/line/LOG_USERID/search.php?po='.$event['message']['text'];
                $ch_info = curl_init();
                curl_setopt( $ch_info, CURLOPT_URL, $url_info );
                curl_setopt( $ch_info, CURLOPT_POSTFIELDS, $data );
                curl_setopt( $ch_info, CURLOPT_POST, true );
                curl_setopt( $ch_info, CURLOPT_RETURNTRANSFER, true);
                curl_setopt( $ch_info, CURLOPT_SSL_VERIFYPEER, false );
                $content_info = curl_exec( $ch_info );
                curl_close($ch_info);
                
                $str_return = '';
                //$str_return .= "TEXT : ".$event['message']['text']."\n".'ภาษาไทย';
                $str_return .= "TEXT : ".$event['message']['text']."\n".'--------------';
                $str_return .= "\n".$content_info;

                $this->message    = $str_return;
                $this->timestamp  = $event['timestamp'];


                // saveLog($event['source']['userId'],$event['message']['text']);
                //$url_log ='http://61.90.142.230/iadb/line/LOG_USERID/log_userid.php?id='.$event['source']['userId'].'&msg='.$event['message']['text'].$this->content.var_dump($this->content);
                $url_log ='http://61.90.142.230/iadb/line/LOG_USERID/log_userid.php?id='.$event['source']['userId'].'&msg='.$event['message']['text']."|".$this->content;
                $ch_log = curl_init();
                curl_setopt( $ch_log, CURLOPT_URL, $url_log );
                curl_setopt( $ch_log, CURLOPT_POSTFIELDS, $data );
                curl_setopt( $ch_log, CURLOPT_POST, true );
                curl_setopt( $ch_log, CURLOPT_RETURNTRANSFER, true);
                curl_setopt( $ch_log, CURLOPT_SSL_VERIFYPEER, false );
                $content = curl_exec( $ch_log );
                curl_close($ch_log);
  
                
                




                
                if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
                    $this->isText = true;
                    $this->text   = $event['message']['text'];
                    //$this->text   = $event['message']['text'].'-*-'.$event['source']['userId'];
                }
                
                if ($event['type'] == 'message' && $event['message']['type'] == 'image') {
                    $this->isImage = true;
                }
                
                if ($event['type'] == 'message' && $event['message']['type'] == 'sticker') {
                    $this->isSticker = true;
                }
                
            }

        }
        
        parent::__construct($this->httpClient, [ 'channelSecret' => $channelSecret ]);
        
    }
    
    public function saveLog ($id = null, $msg = null) {
        $url_log ='http://61.90.142.230/iadb/line/LOG_USERID/log_userid.php?id='.$id.'&msg='.$msg;
        //$url_log ='http://61.90.142.230/iadb/line/LOG_USERID/log_userid.php?id=45646546&msg=xxxx';
        $ch_log = curl_init();
        curl_setopt( $ch_log, CURLOPT_URL, $url_log );
        curl_setopt( $ch_log, CURLOPT_POSTFIELDS, $data );
        curl_setopt( $ch_log, CURLOPT_POST, true );
        curl_setopt( $ch_log, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $ch_log, CURLOPT_SSL_VERIFYPEER, false );
        $content = curl_exec( $ch_log );
        curl_close($ch_log);
    } 
    
    
    public function sendMessageNew ($to = null, $message = null) {
        $messageBuilder = new TextMessageBuilder($message);
        $this->response = $this->httpClient->post($this->endpointBase . '/v2/bot/message/push', [
            'to' => $to,
            // 'toChannel' => 'Channel ID,
            'messages'  => $messageBuilder->buildMessage()
        ]);
    }
    
    public function replyMessageNew ($replyToken = null, $message = null) {
        $messageBuilder = new TextMessageBuilder($message);
        $this->response = $this->httpClient->post($this->endpointBase . '/v2/bot/message/reply', [
            'replyToken' => $replyToken,
            'messages'   => $messageBuilder->buildMessage(),
        ]);
    }
    
    public function isSuccess () {
        return !empty($this->response->isSucceeded()) ? true : false;
    }
    
    public static function verify ($access_token) {
        
        $ch = curl_init('https://api.line.me/v1/oauth/verify');
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'Authorization: Bearer ' . $access_token ]);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
        
    }
    
}

?>
