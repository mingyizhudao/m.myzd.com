<?php

/**
 * 接受微信服务器推送的消息事件并返回相对应的消息
 *
 * @author zhongtw
 */
require_once('protected/modules/weixinpub/components/wxBizMsgCrypt.php');
class WechatapiController extends WeixinpubController {

    
    public $token;
    
    public $EncodingAESKey;
    
    public $AppID;
    
    public $wechatMessage;

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
        echo "111111111111111111";
        echo "</br>";
        echo $this->AppID;
    }

    public function actionApi() {
        Yii::log("进入微信接口");
        if (!isset($_GET['echostr'])) {
            $this->responseMsg();
        } else {
            $this->valid();
        }
    }

    //验证签名
    public function valid() {
        Yii::log("开始验证接口签名");
        if ($this->checkSignature()) {
            echo $_GET["echostr"];
        } else {
            echo "null";
        }
        Yii::app()->end();
    }

    //获取请求内容以及根据类型回复相关消息
    public function responseMsg() {

        $timestamp = $_GET['timestamp'];
        $nonce = $_GET["nonce"];
        $msg_signature = $_GET['msg_signature'];
        $encrypt_type = (isset($_GET['encrypt_type']) && ($_GET['encrypt_type'] == 'aes')) ? "aes" : "raw";

        $postStr = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");

        if (!empty($postStr)) {
            if ($encrypt_type == 'aes') {//加密模式，先解密
                $pc = new WXBizMsgCrypt($this->token, $this->EncodingAESKey, $this->AppID);
                $decryptMsg = "";  //解密后的明文
                $errCode = $pc->DecryptMsg($msg_signature, $timestamp, $nonce, $postStr, $decryptMsg);
                $postStr = $decryptMsg;
            }
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
        
            switch ($RX_TYPE) {//消息类型分离
                case "event":
                    $result = $this->wechatMessage->receiveEvent($postObj);
                    break;
                case "text":
                    $result = $this->wechatMessage->receiveText($postObj);
                    break;
                default:
                    break;
            }
            
            if ($encrypt_type == 'aes') {//对返回给微信服务器的消息进行加密处理
                $encryptMsg = ''; //加密后的密文
                $errCode = $pc->encryptMsg($result, $timestamp, $nonce, $encryptMsg);
                $result = $encryptMsg;
            }
            echo $result;
        } else {
            echo "null";
        }
        Yii::app()->end();
    }

    //验证消息是否来自微信服务器
    private function checkSignature() {
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];
        $token = $this->token;
        Yii::log("签名字符串为：" . $signature);
        Yii::log("时间戳为：" . $timestamp);
        Yii::log("随机字符串为：" . $nonce);
        Yii::log("Token为：" . $token);

        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        Yii::log("系统内生成的签名为：" . $tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
    
    
}
