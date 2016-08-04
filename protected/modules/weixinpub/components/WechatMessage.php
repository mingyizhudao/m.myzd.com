<?php
/**
 * 接受来自微信服务器的消息，并处理回复相对应的消息
 *
 * @author zhongtw
 */
class WechatMessage {

    //接收事件消息
    public function receiveEvent($object) {
        $content = "";
        switch ($object->Event) {
            //用户关注公众号
            case "subscribe":
                $content = "感谢您关注名医主刀 - 国内最大的移动医疗手术平台！";
                $content = $content . "\n平台旨在为病患提供最合适，最便捷的医疗服务方案。";
                $content = $content . "医疗客服根据您提交的病例精准为您对接专家，为您在最短时间内安排手术。";
                $content = $content . "让中国人不再有“看病难”，“一床难求”的困扰。同时也为医生多点行医提供落地平台。";
                $content = $content . "\n点击右下角“更多”，领取红包（专属邀请码6000）。";
                $content = $content . "\n谢谢关注，愿健康与您永远相伴！";
                break;
            //用户之前已关注公众号，然后扫描带参数二维码进入公众号
            case "SCAN":
                $content = "欢迎来到名医主刀 - 国内最大的移动医疗手术平台！";
                break;
            //在模版消息发送任务完成后，微信服务器会将是否送达成功作为通知推送过来
            case "TEMPLATESENDJOBFINISH":
                $wechatMsgRecord = new WechatMsgRecord();
                $wechatMsgRecord->templateSendBack($object->MsgID, $object->Status);
                break;
            //菜单内点击【联系客服】
            case "CLICK";
                if($object->EventKey == "CUSTOMER_SERVICE"){
                    $content = "拨打名医主刀客服热线400-6277-120";
                }
                break;
            default:              
                break;
        }
        
        $event = $object->Event;
        if(isset($object->EventKey) && ($event == 'subscribe' || $event == 'unsubscribe' || $event == 'SCAN')){
            $wechatEventRecord = new WechatEventRecord();
            $wechatEventRecord->ToUserName = $object->ToUserName;
            $wechatEventRecord->FromUserName = $object->FromUserName;
            $wechatEventRecord->event = $object->Event;
            $wechatEventRecord->EventKey = $object->EventKey;
            $wechatEventRecord->save();
        }
        
        $result = $this->transmitText($object, $content);
        return $result;
    }
    
    //接收文本消息
    public function receiveText($object) {
        $rspContent = "感谢您的留言，我们会尽快与您联系。";//默认回复内容
        $reqContent = $object->Content;//请求文字内容
        $wechatKeyWord = WechatKeyWord::model()->getAll();
        foreach ($wechatKeyWord as $v){
            if($v['key_word'] == $reqContent && $v['msg_type'] == 'text'){
                $rspContent = v['reply_content'];//获取需要回复给用户的内容
                break;
            }else{
                continue;
            }
        }
        $result = $this->transmitText($object, $rspContent);
        return $result;
    } 
     
    //回复文本消息
    public function transmitText($object, $content) {
        Yii::log("第一步" . $content);
        $xmlTpl = "<xml>
                   <ToUserName><![CDATA[%s]]></ToUserName>
                   <FromUserName><![CDATA[%s]]></FromUserName>
                   <CreateTime>%s</CreateTime>
                   <MsgType><![CDATA[text]]></MsgType>
                   <Content><![CDATA[%s]]></Content>
                   </xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        Yii::log("回复内容" . $result);
        return $result;
    }  
    
}
