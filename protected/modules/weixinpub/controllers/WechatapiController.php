<?php

/**
 * 接受微信服务器推送的消息事件并返回相对应的消息
 *
 * @author zhongtw
 */
class WechatapiController extends WeixinpubController {

    
    public $token;
    
    public $EncodingAESKey;
    
    public $AppID;
    
    public $wechatMessage;
    
    public $echostr;

    public function init() {

        parent::init();
        
        $this->loadWechatAccount();
        
        $wechatAccount = $this->wechatAccount;
        
        $this->token = $wechatAccount->weixinpub_token;
        
        $this->EncodingAESKey = $wechatAccount->encoding_key;
        
        $this->AppID = $wechatAccount->getAppId();    
        
        $this->wechatMessage = new WechatMessage(); 
        
    }
    
    public function actionTest(){
        $xmlTpl = "<xml>
                        <ToUserName>
                            <![CDATA[ofwHPt5f2doHiEpT48EhNowXVGtc]]>
                        </ToUserName>
                        <FromUserName>
                            <![CDATA[gh_0b1867f2aa86]]>
                        </FromUserName>
                        <CreateTime>1469676258</CreateTime>
                        <MsgType>
                            <![CDATA[text]]>
                        </MsgType>
                        <Content>
                            <![CDATA[%s]]>
                        </Content>
                    </xml>";
        $content = "准备换行/n换行成功";
        $result = sprintf($xmlTpl, $content);
        echo $result;
    }

    public function actionApi() {
        if (!isset($_GET['echostr'])) {
            $this->responseMsg();
        } else {
            $this->echostr = $_GET['echostr'];
            $this->valid();
        }
    }

    //验证签名
    public function valid() {
        if ($this->checkSignature()) {
            ob_clean();
            echo $this->echostr;
        } else {
            echo "";
        }
        Yii::app()->end();
    }
    
    
    public function responseMsg() {
        $postStr = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $RX_TYPE = trim($postObj->MsgType);
        //消息类型分离
        switch ($RX_TYPE) {
            case "event":
                $result = $this->wechatMessage->receiveEvent($postObj);
                break;
            case "text":
                $result = $this->wechatMessage->receiveText($postObj);
                break;
            default:
                break;
        }
        //ob_clean();
        //header("Content-type: text/xml");
        echo $result;
        Yii::app()->end();
    }


    //验证消息是否来自微信服务器
    private function checkSignature() {
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];
        $token = $this->token;

        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
    
    
}
