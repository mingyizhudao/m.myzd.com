<div class="text-center">    
    <h3>注册成功！</h3>
    <h5 class="mt20">为了帮您更快地预约到专家，我们建议您先实名认证！</h5>
    <h5 class="mt20">请务必填写真实信息，我们会对该信息完全保密。</h5>
    <br/>
    <form class="form-horizontal">
        <div data-role="fieldcontain">
            <div class="ui-field-contain">
                <label for="UserRegisterForm_fullname" class="text-left">姓名:</label>
                <input type="text" name="UserRegisterForm[fullname]" id="UserRegisterForm_fullname" class="" placeholder="请输入姓名">
                <div class="errorMessage" id="UserRegisterForm_fullname_em_" style=""></div>
            </div>
            <div class="ui-field-contain">
                <label for="UserRegisterForm_idcard" class="text-left">身份证:</label>
                <input type="text" name="UserRegisterForm[idcard]" id="UserRegisterForm_idcard" maxlength="18" class="" placeholder="请输入身份证号">
                <div class="errorMessage" id="UserRegisterForm_idcard_em_" style=""></div>
            </div>
            <div class="ui-field-contain">
                <input id="UserRegisterForm_btnSubmitEnquiry" class="btn-success" data-icon="check" data-iconpos="right" type="submit" name="UserRegisterForm[yt0]" value="提交">
            </div>
        </div>
    </form>
    <a class="pull-right" data-ajax=false  href="<?php echo $this->getHomeUrl(); ?>">稍后填写 >></a>
</div>
