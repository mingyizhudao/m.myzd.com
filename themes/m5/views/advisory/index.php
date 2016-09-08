
<?php
/**
 * $data.
 */
$this->setPageTitle('WIFI落地页');
$this->show_footer = false;
$urlDoctorcase = $this->createAbsoluteUrl('/api/successfulcase/');
$urlSucCase = $this->createAbsoluteUrl('/api/expertsshow');
$feedbackwifi = $this->createAbsoluteUrl('/api/feedbackwifi');
?>
<style type="text/css">
    .tshadow{text-shadow:1px 1px 1px #666}.a-log{background:url('http://static.mingyizhudao.com/147322867742061') no-repeat 50% 5px;background-size:contain;padding:55px 0 0 0}.a-log .des{background-color:#20a69f}.a-log .des .des1{color:#efc825;font-size:18px;padding-top:30px;padding-bottom:10px;text-align:center}.a-log .des .des2,.a-log .des .des3{color:#fff;font-size:22px;text-align:center}.a-log .des .des2{text-indent:-3rem;padding-bottom:10px}.a-log .des .des3{text-indent:3rem;padding-bottom:20px}.a-doc .a-wrap-doc-list{overflow-x:hidden;height:260px}.a-doc-list{width:1300px;padding:5px;overflow:hidden}.a-doc-list:after{display:block;content:'';clear:both}.a-doc-list li{height:250px;list-style-type:none;width:120px;background-color:#efc825;margin:0 5px;float:left;padding:5px;text-align:center;font-size:14px}.a-doc-list li img{width:80px;background:#eee;height:80px}.a-doc-list li .a-doc-name{font-size:16px}.a-doc-adv{padding:10px 0;text-align:center;background-color:#efc825}.a-doc-adv button{background:#3ee0d5;border-radius:10px;box-shadow:1px 1px 1px #989898;font-size:24px;animation:bling 1s infinite;-webkit-animation:bling 1s infinite}@keyframes bling{0%{background:#3ee0d5}50%{background:#3ee0d5}51%{background:#989898}100%{background:#989898}}@-webkit-keyframes bling{0%{background:#3ee0d5}50%{background:#3ee0d5}51%{background:#989898}100%{background:#989898}}.a-suc{background:#f32323;padding:5px 20px;-moz-box-shadow:inset 0 -1px 1px #2f2f2f;-webkit-box-shadow:inset 0 -1px 1px #2f2f2f;box-shadow:inset 0 -1px 1px #2f2f2f}.a-suc .a-suc-inner{background:#fff;padding:10px 5px;display:flex;-moz-box-shadow:inset 0 1px 1px #2f2f2f;-webkit-box-shadow:inset 0 1px 1px #2f2f2f;box-shadow:inset 0 1px 1px #2f2f2f}.a-suc .a-suc-inner:after{content:'';display:block;clear:both}.a-suc .a-suc-inner li{text-decoration:underline}.a-suc .a-suc-inner>p{float:left;width:10%;text-align:center;border-right:2px solid #efc825;color:#f32323;font-size:24px;line-height:26px;display:flex;align-items:center}.a-suc .a-suc-inner>ul{float:left;width:90%;list-style-type:decimal;padding:5px 5px 5px 25px}.a-booking{padding:5px;border-bottom:50px solid #efc825}.a-booking:after{content:'';display:block;clear:both}.a-booking .a-booking-phone{width:49%;min-height:90px;float:left;background:#20a69e;border-radius:8px;padding:5px 10px;margin:0 1% 0 0;color:#fff}.a-booking .a-booking-phone i{display:inline-block;width:20px;height:20px;background:url('http://static.mingyizhudao.com/147332503949054');background-size:contain;transform:translateY(4px)}.a-booking .a-booking-phone span{padding:5px 0;border-bottom:1px solid #fff}.a-booking .a-booking-phone p{padding:10px 0 0 0;font-size:18px;text-align:center}.a-booking .a-booking-form{width:50%;background:#20a69e;border-radius:8px;padding:5px 10px;text-align:center;color:#fff;min-height:90px;float:left}.a-booking .a-booking-form input{width:80%;height:20px;margin:0}.a-booking .a-booking-form span{width:20%;min-width:35px;display:inline-block}.a-booking .a-booking-form p{display:flex;margin:1px 0 0 0}.a-booking .a-booking-form button{padding:5px;background:#efca24;margin:5px 0 0 0}#advisory_article #freePhone{color:#fff;width:57px;height:57px;padding:8px 13px;z-index:999;position:fixed;right:0;top:50%;background:#00b38a;border-radius:28px}
</style>
<article id="advisory_article" class="active" data-scroll="true" class="advisory-page">
    <div class="a-log">
        <div class="des">
            <p class="des1 tshadow">三万三甲名医/数千床位/24小时全天候</p>
            <p class="des2 tshadow">随时随地快速预约</p>
            <p class="des3 tshadow">做手术就找名医主刀</p>
        </div>
    </div>
    <div id="clickService" class="a-doc" data-track="wifi点击免费咨询">
        <div class="a-wrap-doc-list">
            <ul id="doc-list" class="a-doc-list">
            </ul>
        </div>
        <div class="a-doc-adv">
            <button>点击免费咨询</button>
        </div>
    </div>
    <div class="a-suc">
        <div class="a-suc-inner">
            <p>成功案例</p>
            <ul id="suc-list">
            </ul>
        </div>
    </div>
    <div class="a-booking">
        <div class="a-booking-phone" id="dial">
            <span><i></i>400-6277-120</span>
            <p>免费电话咨询</p>
        </div>
        <div class="a-booking-form">
            <p><span>姓名:</span><input id="bookingName" type="text" name=""></p>
            <p><span>电话:</span><input id="bookingMobile" type="number" name=""></p>
            <button data-track="wifi点击预约回电" class="tshadow" id="bookingServiceBtn">免费预约回电</button>
        </div>


    </div>
    <div id="freePhone" href="javascript:;" data-track="wifi点击免费咨询">
        免费咨询
    </div>
</article>
<script>
    $(document).ready(function(){J.showMask();$("#dial").click(function(){location.href="tel://4006277120"});$("[data-track]").on("click",function(){var label=$(this).data("track");window._hmt&&window._hmt.push(["_trackEvent",label,"click"])});$("#bookingServiceBtn").click(function(){var name=$("#bookingName").val();var mobile=$("#bookingMobile").val();if(name.length==""){J.showToast("请输入姓名","toast",1000)}else{if(mobile.length===0){J.showToast("请输入手机号","toast",1000)}else{if(!validatorMobile(mobile)){J.showToast("请输入有效的手机号","toast",1000)}else{bookingService(name,mobile)}}}});$("#clickService,#freePhone").click(function(){location.href="http://p.qiao.baidu.com/im/index?siteid=9290674&ucid=10135139"});$.ajax({type:"get",url:"<?php echo $urlDoctorcase; ?>",success:function(data){J.hideMask();if(data.status=="ok"){if(data.results!=null){getDocList(data.results)}}else{J.showToast("加载失败，请重试","toast",1000)}},error:function(){J.hideMask()}});$.ajax({type:"get",url:"<?php echo $urlSucCase; ?>"+"?limit="+8,success:function(data){J.hideMask();if(data.status=="ok"){if(data.doctors!=null){getSucList(data.doctors)}}else{J.showToast("加载失败，请重试","toast",1000)}},error:function(){J.hideMask()}})});function getDocList(res){var sucList="";for(var i=0;i<res.length;i++){var li;li='<li data-href="'+res[i].link+'" data-track="wifi'+res[i].content+'">'+res[i].content+"</li>";sucList+=li}$(sucList).appendTo($("#suc-list"));$("#suc-list li").click(function(){var url=$(this).attr("data-href");window.location=url})}var _docLiLength,_docLiAnimatime,sucList,_tFlag=0,_docLiW=130;function getSucList(res){sucList="";for(var i=0;i<res.length;i++){var li;li="<li>"+'<img class="imgDoc" alt="白继教授" src="'+res[i].imageUrl+'">'+'<p class="a-doc-name">'+res[i].docName+"</p>"+"<p>"+res[i].hpName+"</p>"+"<p>"+res[i].mTitle+"</p>"+"<p>"+res[i].desc+"</p>"+"</li>";sucList+=li}sucList+=sucList;$(sucList).appendTo($("#doc-list"));_docLiLength=res.length*_docLiW;$(".a-doc-list").css("width",_docLiLength*2+_docLiW);_docLiAnimatime=setInterval(function(){$(".a-wrap-doc-list").scrollLeft(_tFlag);_tFlag+=0.5;if(_tFlag>_docLiLength){_tFlag=0}},10)}function bookingService(name,mobile){J.showMask();$.ajax({type:"post",url:"<?php echo $feedbackwifi; ?>",data:{"wifi[username]":name,"wifi[mobile]":mobile},success:function(data){J.hideMask();J.showToast("免费预约成功！请等待客服致电！","toast",3000)}})}function validatorMobile(mobile){var mobileReg=/^1[3|4|5|7|8]\d{9}$/;return mobileReg.test(mobile)};
</script>