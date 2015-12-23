<?php
/*
 * $model DoctorForm.
 */
$this->setPageID('pAccount');
$this->setPageTitle('个人中心');
$urlResImage = Yii::app()->theme->baseUrl . "/images/";

$urlPatientBookingList = $this->createUrl('booking/patientBookingList', array('addBackBtn' => 1));
$urlChangePassword = $this->createUrl('user/changePassword', array('addBackBtn' => 1));
$urlAboutus = $this->createUrl('home/page', array('view'=>'aboutus','addBackBtn' => 1));
$urlLogout = $this->createUrl('user/logout');
?>

<div id="<?php echo $this->getPageID(); ?>" data-role="page" data-title="<?php echo $this->getPageTitle(); ?>" data-nav-rel="#f-nav-account">
    <div data-role="content">
        <div class="">
            <div class="row user-header">
                <div><img src="<?php echo $urlResImage; ?>icons/user-header.png"/></div>
                <div class="mt10">您好,<?php echo $user->username; ?></div>
            </div>
            <div class="menu-list">
                <a href="<?php echo $urlPatientBookingList; ?>">
                    <div class="menu-item order">预约单</div>
                </a>
                <a href="<?php echo $urlChangePassword; ?>" data-ajax="false">
                    <div class="menu-item password">修改密码</div>
                </a>
                <a href="<?php echo $urlAboutus; ?>">
                    <div class="menu-item aboutus">关于我们</div>
                </a>
                <a href="javascript:void(0);" class="logout mt2">
                    <div class="menu-item ui-icon-power ui-btn-icon-left ">退出登录</div>
                </a>
            </div>
        </div>
        <div id="logoutConfirm" class="confirmPage">
            <div class="text-center confirmcontent">
                <h4>确认退出?</h4>
                <div><a class="btn btn-default cancel">取消</a></div>
                <div class="mt10"><a href="<?php echo $urlLogout; ?>" data-ajax="false" class="btn btn-yes confirm">确认</a></div>
            </div>
        </div>
    </div> 
    <script>
        $(document).ready(function () {
            $(".ui-page a").click(function () {
                if ($(this).attr("data-ajax") === "false") {
                    $(".ui-loader").show();
                }
            });
            $(".logout").click(function () {
                $("#logoutConfirm").show();
            });
            $(".confirmPage .cancel").click(function () {
                $(".confirmPage").hide();
            });
        });
    </script>    
</div>

