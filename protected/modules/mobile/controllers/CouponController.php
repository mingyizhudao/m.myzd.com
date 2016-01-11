<?php


class CouponController extends MobileController {

    //进入微信领奖页面
    public function actionGetcoupon() {
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

//    public function actionCreateList() {
//        for ($index = 6000; $index < 6501; $index++) {
//            $wx = new WxCouponCodeList();
//            $wx->coupon_code = $index . '';
//            $wx->coupon_amount = 500;
//            $wx->save();
//        }
//    }

}
