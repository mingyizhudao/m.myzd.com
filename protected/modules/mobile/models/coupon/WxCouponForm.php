<?php

class WxCouponForm extends EFormModel {

    public $mobile;
    public $verify_code;
    public $coupon_code;
    public $coupon_amount;

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('mobile, verify_code, coupon_code', 'required'),
            array('verify_code, coupon_code, coupon_amount', 'numerical', 'integerOnly' => true),
            array('mobile', 'length', 'max' => 11),
            array('verify_code', 'checkVerifyCode'),
            array('coupon_code', 'checkCouponCode'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'mobile' => '手机号',
            'verify_code' => '验证码',
            'coupon_code' => '优惠券码',
        );
    }

    public function checkVerifyCode() {
        if (isset($this->verify_code) && isset($this->mobile)) {
            $authMgr = new AuthManager();
            $authSmsVerify = $authMgr->verifyCodeForDefault($this->mobile, $this->verify_code, null);
            if ($authSmsVerify->isValid() === false) {
                $this->addError('verify_code', $authSmsVerify->getError('code'));
            }
        }
    }

    public function checkCouponCode() {
        if (isset($this->coupon_code)) {
            $couponMgr = new WxCouponManager();
            $model = $couponMgr->loadCouponCodeByCode($this->coupon_code);
            if (isset($model) === false) {
                $this->addError('coupon_code', '你输入的优惠券码有误');
            }else{
                $this->coupon_amount = $model->coupon_amount;
            }
        }
    }

}
