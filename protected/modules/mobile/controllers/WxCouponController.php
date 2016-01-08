<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WxCouponController
 *
 * @author shuming
 */
class WxCouponController extends MobileController {

    //进入微信领奖页面
    public function actionView() {
        $form = new WxCouponForm();
        $this->render("view", array(
            'model' => $form
        ));
    }

    //微信领奖提交
    public function actionAjaxCreate() {
        $output = array('status' => 'no');
        if (isset($_POST['UserPasswordForm'])) {
            $values = $_POST['UserPasswordForm'];
            $couponMgr = new WxCouponManager();
            $output = $couponMgr->createWxCoupon($values);
        } else {
            $output['errors'] = 'no data...';
        }
        $this->renderJsonOutput($output);
    }

}
