
<?php
/**
 * $data.
 */
$this->setPageTitle('名医主刀');
$this->show_footer = false;
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/auth/sendSmsVerifyCode');
?>
<style type="text/css">
    .y-color{
        background: rgba(239,202,36,1);
    }
    .g-color{
        background: rgba(25,175,166,1);
    }
    .d-color-t{
        color: #333;
    }
    .w-color-t{
        color: #fff;
    }
    .l-color-t{
        color: rgba(239,202,36,1);
    }
    .g-color-t{
        color: rgba(25,175,166,1);
    }
    .f-size-l{
        font-size: 18px; 
    }
    .w-btn{
        background: rgba(239,202,36,1);
        height: 40px;
        border-radius: 20px;
        color: #000;
    }
    .w-btn-rx{
        background: rgba(239,202,36,1);
        height: 40px;
        border-radius: 5px;
        color: #000;
    }
    h2,h3{
        font-weight: bold;
    }
    .w-b-img{
    }


    .w-b-1{
        background: url('http://static.mingyizhudao.com/147763323241176') no-repeat;
       background-size: cover;
       text-align: center;
    }
    .w-b-1 .w-b-logo{
       background: url('http://static.mingyizhudao.com/147763299353754') 14px center no-repeat;
       background-size: contain;
       display: inline-block;
       width: 120px;
       height: 30px;
        float: left;
        margin: 5px 0;
    }
    .w-b-1>p{
        background: rgba(255,255,255,.5);
        height: 40px;
        text-align: right;
        line-height: 40px;
        padding:  0 10px 0 0;
    }
    .w-b-1>div{
        text-align: center;
        margin: 50px 0 60px 0;
    }
    .w-b-1>button{
        width: 250px;
        margin-bottom: 20px;
    }
    
    .w-b-2{
        text-align: center;
        padding: 0 20px;
    }
    .w-b-2 ul li{
        text-align: left;
        line-height: 30px;
    }
    .w-b-2 li span{
        display: inline-block;
        width: 18px;
        height: 18px;
        border-radius: 9px;
        margin-right: 5px;
        text-align: center;
        line-height: 18px;
        color: #fff;
    }
    .w-b-2 img{
        margin: 10px 0;
    }

    .w-b-3 {
        padding: 10px 0;
        text-align: center;
    }
    .w-b-3>div{
        background: url('http://static.mingyizhudao.com/147763840040514') no-repeat;
        height: 80px;
        background-size: cover;
        line-height: 110px;
        text-align: center;
        color: #fff;
    }
    .w-b-3 ul{
        margin: 20px 15px 15px 15px;
        text-align: left;
    }
    .w-b-3 li{
        line-height: 40px;
    }
    .w-b-3 li span{
        display: inline-block;
        width: 30%;
        float: left;
    }
    .w-b-3 li>div{
        width: 70%;
        display: inline-block;
        float: left;
    }
    .w-b-3 li>input, .w-b-3 li>div input{
        width: 70%;
        height: 30px;
        border-radius: 5px;
    }
    .w-b-3 li>div a{    
        color: #333;
        display: inline-block;
        border: 1px rgba(239,202,36,1) solid;
        border-radius: 5px;
        width: 25%;
        font-size: 12px;
        height: 25px;
        line-height: 25px;
        background: rgba(239,202,36,1);
        text-align: center;
    }
    .w-b-3 p{
        padding: 10px;
    }
    .w-b-3 button{
        width: 100%;
    }

    .w-b-4{
        text-align: center;
        padding: 0 10px;
    }
    .w-b-4 img{
        margin: 20px 0;
    }
    .w-b-4-2l >div{
        float: left;
        padding: 0 20px;
        width: 50%;
    }
    .w-b-4-2l:after{
        content: '';
        display: block;
        clear: both;
    }

    .w-b-5{
        background: url('http://static.mingyizhudao.com/147764125988461') no-repeat;
        background-size: cover;
        height: 180px;
        padding: 80px 30px;
        color: #fff;
    }
    .w-b-5 button{
        width: 130px;
        margin-top: 10px;
    }

    .w-b-6{
        text-align: center;
        padding: 10px;
    }
    .w-b-6 >div{
        margin-top: 30px;
    }
    .w-b-6 >div p{
        border-left: 4px solid rgba(25,175,166,1);
        padding: 0 5px;
        text-align: left;
        margin-bottom: 5px;
    }
    .w-b-6 video{
        position: relative;
        display: block;
        top: 0;
        left: 0;
        width: 100%;
        /*height: 100%;*/
        background: #000;
    }
    .w-b-6 .w-6-link{
        text-align: left;
    }
    .w-b-6 i{
        display: inline-block;
        background: url('http://static.mingyizhudao.com/147764222612476') no-repeat;
        background-size: contain;
        width: 20px;
        height: 20px;
    }

    .w-b-7{
        margin: 50px 0;
    }

    .w-b-8{
        padding: 10px 20px;
        background-color: #858585;
    }
    .w-b-8 button{
        background-color: #19AFA6;
        width: 100%;
    }
    .w-b-8 i{
        display: inline-block;
        background: url('http://static.mingyizhudao.com/147764376732564') no-repeat;
        background-size: cover;
        width: 15px;
        height: 15px;
        margin-right: 5px;
    }
</style>
<article class="active" data-scroll="true" class="wifi-page">
    <div class="w-b-1">
        <p class="d-color-t f-size-l"><i class="w-b-logo"></i>做手术就找名医主刀</p>
        <div>
            <h2 class="w-color-t">想找北上广名医动手术？</h2>
            <p class="w-color-t"><span class="l-color-t">3万</span>三甲主刀名医帮您约，<span class="l-color-t">不用等床位</span>！</p>
        </div>
        <button class="w-btn freePhone">电话快速预约 ></button>
    </div>
    <div class="w-b-2">
        <h3 class="d-color-t">直约全国各大名院主刀医生来做手术</h3>
        <p>手术档期、床位安排、主刀医生，<span class="g-color-t">一个电话</span>统统搞定！</p>
        <img class="w-b-2" src="http://static.mingyizhudao.com/147763500968412">
        <ul>
            <li><span class="g-color">1</span>中山大学附属肿瘤医院/中山医院/南方医院</li>
            <li><span class="g-color">2</span>湘雅医院</li>
            <li><span class="g-color">3</span>长征医院/长海医院/华山医院/瑞金医院</li>
            <li><span class="g-color">4</span>南京军区总院</li>
            <li><span class="g-color">5</span>积水潭医院/解放军总院/协和医院/天坛医院</li>
        </ul>
    </div>
    <div class="w-b-3">
        <div>
            挑选<span class="l-color-t">更多</span>名院医生，尽在<span class="l-color-t">名医主刀</span>！
        </div>
        <form>
            <ul>
                <li><span>姓名：</span><input placeholder="请输入您的姓名" type="" name=""></li>
                <li><span>电话：</span><input id="booking_mobile" placeholder="请输入您的电话" type="" name=""></li>
                <!-- <li><span>所在城市：</span><input placeholder="请选择您所在的城市" type="" name=""></li> -->
                <li>
                    <span>验证码：</span>
                    <div>
                        <input placeholder="请输入验证码" type="" name="">
                        <a id="btn-sendSmsCode">验证码</a>
                    </div>
                </li>
                <li><span>预约医生：</span><input placeholder="请输入您想预约的主刀医生，没有可不填" type="" name=""></li>
            </ul>
            <p>
                <button class="w-btn-rx">提交预约</button>
            </p>
        </form>
    </div>
    <div class="w-b-4">
        <h3>别让等待延误了生命健康</h3>
        <p><span class="g-color-t">12小时内</span>确认面诊时间，<span class="g-color-t">7天内</span>安排住院准备手术</p>
        <img src="http://static.mingyizhudao.com/147764030179738">
        <div class="w-b-4-2l">
            <div>
                <img src="http://static.mingyizhudao.com/147764095578977">
                <p>无须漫长苦等主刀医生</p>
                <p class="g-color-t">延误救治</p>
            </div>
            <div>
                <img src="http://static.mingyizhudao.com/147764095603274">
                <p>无须担心医院没有床位</p>
                <p class="g-color-t">危及生命</p>
            </div>
        </div>
    </div>
    <div class="w-b-5">
        <p>做手术找名医主刀，就是<span class="l-color-t">快</span>！</p>
        <button class="w-btn online-adv">在线咨询预约</button>
    </div>
    <div class="w-b-6">
        <h3>帮助一位患者，幸福整个家庭</h3>
        <p>成立至今帮助<span class="g-color-t">数万患者</span>及时获得手术</p>
        <div>
            <p>案例一 是什么夺去了11岁小女孩奔跑的权利？</p>
            <video class="w6video" x-webkit-airplay="true" webkit-playsinline="" playsinline="true" preload="none" poster="http://static.mingyizhudao.com/147764536727257" src="http://222.73.3.72/vhot2.qqvideo.tc.qq.com/l0326dsrvqi.m701.mp4?vkey=495E22F1C26CF0DF6FCFF315D3AA4E304D037E9F059D1192AAA866A210DD5701AC0E77782B025EFF3A005CFA886F7C28AFD7B359C5BD8D85B49D28854F8B86A6A9B4B56F1D10B5973BE952D2CA3B45BB314EDEE6BF4E6777&br=29&platform=2&fmt=auto&level=0&sdtfrom=v3010&guid=98bc1931e016862d615374312bc8ff22"></video>
        </div>
        <div>
            <p>案例二 扭曲的人生：名医主刀还我18年正直梦！（上）</p>
            <video class="w6video" x-webkit-airplay="true" webkit-playsinline="" playsinline="true" preload="none" poster="http://static.mingyizhudao.com/147764536308615" src="http://222.73.132.153/vhot2.qqvideo.tc.qq.com/y0332exruz4.m701.mp4?vkey=98396AAC66D6A100A0E3A11FF6E67B5AE71CACD0FB3EEEE9F1A1ED4F56696DDAB35E29551CE5C22CF6340AF36EA35163939ED6884EEA1E1106288CB930B44C5AA933386B5EA555FBD39813DAB1F142F55C69A723B105CB1F&br=29&platform=2&fmt=auto&level=0&sdtfrom=v3010&guid=98bc1931e016862d615374312bc8ff22"></video>
        </div>
        <div class="w-6-link">
            <i></i>
            <a class="g-color-t" href="http://m.mingyizhudao.com/mobile/event/view-page-life.html">同病不同命：名医主刀助肺癌陈先生重获生命</a>
        </div>
        <div class="w-6-link">
            <i></i>
            <a class="g-color-t" href="http://m.mingyizhudao.com/mobile/event/view-page-lifeExpect.html">患者心声：活下去的希望是名医主刀给的</a>
        </div>
    </div>
    <div class="w-b-7">
        <img class="online-adv" src="http://static.mingyizhudao.com/147764327385872">
    </div>
    <div class="w-b-8">
        <button class="freePhone"><i></i>电话预约三甲主刀名医</button>
    </div>
</article>
<script>
    $(document).ready(function () {
        $('.freePhone').click(function () {
            J.customConfirm('友情提示',
                    '<div class="mb10">立即拨打免费客服热线400-6277-120</div>',
                    '<a id="closeLogout" class="w50">取消</a>',
                    '<a id="dial" class="color-green w50">拨打</a>',
                    function () {
                    });
            $('#closeLogout').click(function () {
                J.closePopup();
            });
            $('#dial').click(function () {
                J.closePopup();
                location.href = 'tel://4006277120';
            });
        });
        $('.online-adv').click(function(){
            location.href = 'http://dct.zoosnet.net/LR/Chatpre.aspx?id=DCT73779034&lng=cn';
        });
        $('.w6video').click(function(){

            if (this.paused) {
               this.play();
               this.controls = 'controls';
            } else {
               this.pause();
            }
        });

        

        
        $("#btn-sendSmsCode").click(function (e) {
            e.preventDefault();
            checkCaptchaCode($(this));
        });
  

    });

    function checkCaptchaCode(domBtn) {
        var domMobile = $("#booking_mobile");
        var mobile = domMobile.val();

        var smsParams = {
            AuthSmsVerify: {
                mobile: mobile,
                actionType: 200 // the action_type, login:102, fast booking:200
            }
        };
        if (mobile.length === 0) {
            
            $('.mobileTip').show();
            setTimeout(function () {
                $(".mobileTip").hide();
            }, 1000);
        } else if (domMobile.hasClass("error")) {

        } else {
            $('#booking_captcha_code-error').remove();
            //check图形验证码
            $.ajax({
                type: 'post',
                url: '<?php echo $urlGetSmsVerifyCode ?>',
                data: smsParams,
                success: function (data) {
                    if (data.status == 'ok') {
                        // sendSmsVerifyCode(domBtn, mobile);
                    } else {
                        // $('#captchaCode').after('<div id="booking_captcha_code-error" class="error">' + data.error + '</div>');
                    }
                }
            });
        }
    }
</script>