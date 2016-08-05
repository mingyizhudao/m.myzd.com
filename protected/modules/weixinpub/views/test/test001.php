<?php
require_once "protected/modules/weixinpub/components/WechatJSSDK.php";
$jssdk = new WechatJSSDK();
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <script>
        wx.config({
            debug: false,
            appId: '<?php echo $signPackage["appId"];?>',
            timestamp: <?php echo $signPackage["timestamp"];?>,
            nonceStr: '<?php echo $signPackage["nonceStr"];?>',
            signature: '<?php echo $signPackage["signature"];?>',
            jsApiList: [
                'hideAllNonBaseMenuItem',
            ]
        });
        wx.ready(function() {	
            wx.hideAllNonBaseMenuItem();
        });
    </script>
</head>
<body>
    <h2>just test</h2>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

</html>