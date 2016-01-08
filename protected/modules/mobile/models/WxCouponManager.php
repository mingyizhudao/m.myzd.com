<?php

class WxCouponManager {

    /**
     * 保存领奖信息
     * @param type $values
     */
    public function createWxCoupon($values) {
        $output['status'] = 'no';
        $form = new WxCouponForm();
        $form->setAttributes($values, true);
        if ($form->validate() === false) {
            $output['errors'] = $form->getErrors();
            return $output;
        }
        $mobile = $form->mobile;
        //判断用户是否存在
        $user = User::model()->getByUsername($mobile);
        if (isset($user) === false) {
            $userMgr = new UserManager();
            $user = $userMgr->createUserPatient($mobile);
        }
        //创建领奖信息
        $attributes = $form->getSafeAttributes();
        $coupon = new WxCoupon();
        $coupon->setAttributes($attributes, true);
        $coupon->user_id = $user->getId();
        if ($coupon->save()) {
            $output['status'] = 'ok';
            $output['id'] = $coupon->getId();
        } else {
            $output['errors'] = $coupon->getErrors();
        }
        return $output;
    }

}
