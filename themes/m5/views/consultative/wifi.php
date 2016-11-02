
<?php
/**
 * $data.
 */
$this->setPageTitle('名医主刀');
$this->show_footer = false;
$urlGetSmsVerifyCode = $this->createAbsoluteUrl('/api/smsverifycode');
$urlGetBooking = $this->createAbsoluteUrl('/api/quickbooking');
?>
<style type="text/css">
    .wifi-contain{
        display: box;             /* OLD - Android 4.4- */
        display: -webkit-box;     /* OLD - iOS 6-, Safari 3.1-6 */
        display: -moz-box;       /* OLD - Firefox 19- (buggy but mostly works) */
        display: -ms-flexbox;     /* TWEENER - IE 10 */
        display: -webkit-flex;   /* NEW - Chrome */
        display: flex;           /* NEW, Spec - Opera 12.1, Firefox 20+ */
        /* 12版 */
        -webkit-flex-direction: column;
        -moz-flex-direction: column;
        -ms-flex-direction: column;
        -o-flex-direction: column;
        flex-direction: column;
        height: 100%;
    }
    .mid-contain{
        -webkit-box-flex: 1;
        -moz-box-flex: 1;
        -webkit-flex: 1;          /* Chrome */
        -ms-flex: 1;              /* IE 10 */
        flex: 1;        
        overflow-y: scroll;
    }
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
    h3,h4{
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
        margin-top: 30px;
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
        padding: 0 5px;
    }
    .w-b-3 li>div button{    
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
        padding: 0;
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
    .w-b-4 >img{
        margin: 20px 0;
    }
    .w-b-4 .w-b-4-2l img{
        margin: 20px 0;
        height: 100px;
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
        margin: 50px 0 10px 0;
    }

    .w-b-8{
        padding: 10px 20px;
        background-color: #858585;
        height: 60px;
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
    <div class="wifi-contain">
        <div class="mid-contain">
            <div class="w-b-1">
                <p class="d-color-t f-size-l"><i class="w-b-logo"></i>做手术就找名医主刀</p>
                <div>
                    <h3 class="w-color-t">想找北上广名医动手术？</h3>
                    <p class="w-color-t"><span class="l-color-t">3万</span>三甲主刀名医帮您约，<span class="l-color-t">不用等床位</span>！</p>
                </div>
                <button class="w-btn freePhone">电话快速预约 ></button>
            </div>
            <div class="w-b-2">
                <h4 class="d-color-t">直约全国知名主刀医生做手术</h4>
                <p>手术档期、床位安排，<span class="g-color-t">一站搞定</span>！</p>
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
                        <li><span>姓名：</span><input id="booking_name" placeholder="请输入您的姓名" type="text" name=""></li>
                        <li><span>电话：</span><input id="booking_mobile" placeholder="请输入您的电话" type="tel" name=""></li>
                        <!-- <li><span>所在城市：</span><input placeholder="请选择您所在的城市" type="" name=""></li> -->
                        <li>
                            <span>验证码：</span>
                            <div>
                                <input id="booking_code" placeholder="请输入验证码" type="number" name="">
                                <button id="btn-sendSmsCode">验证码</button>
                            </div>
                        </li>
                        <li><span>预约医生：</span><input id="booking_doctor" placeholder="请输入医生名字，没有可不填" type="text" name=""></li>
                    </ul>
                    <p>
                        <button id="btn-booking" class="w-btn-rx">提交预约</button>
                    </p>
                </form>
            </div>
            <div class="w-b-4">
                <h4>别让等待延误了生命健康</h4>
                <p><span class="g-color-t">12h内</span>预估面诊时间，<span class="g-color-t">7天内</span>筹备住院手术</p>
                <img src="http://static.mingyizhudao.com/147799414536383">
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
                <h4>帮助一个人，幸福一家人</h4>
                <p>成立至今帮助<span class="g-color-t">数万患者</span>及时获得手术</p>
                <div>
                    <p>案例一 是什么夺去了11岁小女孩奔跑的权利？</p>
                    <iframe frameborder="0" width="100%" src="http://v.qq.com/iframe/player.html?vid=l0326dsrvqi&tiny=0&auto=0" allowfullscreen></iframe>
                </div>
                <div>
                    <p>案例二 扭曲的人生：名医主刀还我18年正直梦！（上）</p>
                    <iframe frameborder="0" width="100%" src="http://v.qq.com/iframe/player.html?vid=y0332exruz4&tiny=0&auto=0" allowfullscreen></iframe>
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
                <img class="online-adv" src="http://static.mingyizhudao.com/147799406273789">
            </div>
        </div>
        <div class="w-b-8">
            <button class="freePhone"><i></i>电话预约三甲主刀名医</button>
        </div>
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
            window.open('http://dct.zoosnet.net/LR/Chatpre.aspx?id=DCT73779034&lng=cn', '_blank');
            // location.href = 'http://dct.zoosnet.net/LR/Chatpre.aspx?id=DCT73779034&lng=cn';
        });
        // $('.w6video').click(function(){

        //     if (this.paused) {
        //        this.play();
        //        this.controls = 'controls';
        //     } else {
        //        this.pause();
        //     }
        // });

        
        $("#btn-sendSmsCode").click(function (e) {
            e.preventDefault();
            checkCaptchaCode($(this));
        });

        $("#btn-booking").click(function (e) {
            e.preventDefault();
            commitBookingInfo();
        });
  
    });

    function checkCaptchaCode(domBtn) {
        var domMobile = $("#booking_mobile");
        var mobile = domMobile.val();
        if (mobile.length === 0) {
            J.showToast('手机号不得为空', '', '1500');
            return false;
        }
        var smsParams = {
            smsVerifyCode: {
                mobile: mobile,
                action_type: 200 // the action_type, login:102, fast booking:200
            }
        };
        $.ajax({
            type: 'post',
            url: '<?php echo $urlGetSmsVerifyCode ?>',
            data: smsParams,
            success: function (data) {
                if (data.status) {
                    J.showToast('验证码已发送', '', '1500');
                    $(domBtn).prop('disabled', true);
                    $(domBtn).html('已发送');
                    setTimeout(function () {
                        $("#btn-sendSmsCode").prop('disabled', false);
                        $("#btn-sendSmsCode").html('验证码');
                    }, 60000);
                    return true;
                } else {
                    console.log('err',data);
                    J.showToast('获取验证码失败，请重试', '', '1500');
                    return false;
                }
            }
        });
    }

    function commitBookingInfo() {
        var domMobile = $("#booking_mobile");
        var mobile = domMobile.val();
        if (mobile.length === 0) {
            J.showToast('手机号不得为空', '', '1500');
            return false;
        }
        var domVerify = $("#booking_code");
        var verify = domVerify.val();
        if (verify.length === 0) {
            J.showToast('验证码不得为空', '', '1500');
            return false;
        }
        var domName = $("#booking_name");
        var name = domName.val();
        if (name.length === 0) {
            J.showToast('姓名不得为空', '', '1500');
            return false;
        }
        var docName = $("#booking_doctor");
        var doctor = docName.val();

        var formdata = {
            booking: {
                mobile: mobile,
                verify_code: verify,
                contact_name: name,
                doctor_name: doctor 
            }
        };
        $.ajax({
            type: 'post',
            url: '<?php echo $urlGetBooking ?>',
            data: formdata,
            success: function (data) {
                if (data.status == 'ok') {
                    J.showToast('预约成功！我们的客服人员会尽早联系你！', '', '1500');
                }else{
                    J.showToast(data.errorMsg,'','1500');
                }
            }
        });
    }
    
</script>