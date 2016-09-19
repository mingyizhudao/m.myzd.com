<?php
class AuthCaptchaManage {
       /**
	 * 
	 * 根据不同的用户验证请求显示不同验证码
	 * @param model $captchamodel active record class name.
	 * @return output AuthCaptcha model 
	 */
        public function createCaptcha($captchamodel)
        {
            $model = new AuthCaptcha();
            $output=new stdClass();
            $output->result=array();
            $output->status = 'no';
            $model->image=$captchamodel->src;
            $model->code=$captchamodel->code;
            $model->user_host_ip= Yii::app()->request->getUserHostAddress();
            $model->is_active=1;
            $model->time_expiry=time()+600;
            $model->date_created=date("Y-m-d H:i:s");
            if ($model->save()) {
		$output->status = 'ok';
		$output->errorCode = 200;
		$output->errorMsg = "success";
                $resultcaptcha=new stdClass();
                $resultcaptcha->id=$model->getId();
                $resultcaptcha->image=$captchamodel->src;
                $resultcaptcha->code=$captchamodel->code;
		$output->result = $resultcaptcha;

	    } else {
		$output->errorMsg= $model->getFirstErrors();
            }
            return $output;
        }
         /**
	 * 
	 * 得到验证码信息
	 * @param $id--验证码ID
	 * @return  AuthCaptcha model 
	 */
        public function getCaptcha($id)
        {
            if($id){
                $model=  AuthCaptcha::model()->getById($id);
                return $model;
            }
            else{
                return null;
            }
        }
        /**
	 * 
	 * 验证验证码信息是否正确
	 * @param $values-captcha_code 验证CODE，id--验证码ID 值
	 * @return  验证状态  验证码通过
	 */
        public function  checkCaptcha($values){
            $model=$this->getCaptcha($values['id']);
            $Captcha=new stdClass();
            $Captcha->status= 'no';
            $Captcha->errorCode = 200;
            if($model){
                if (strcmp($values['captcha_code'], $model->code)!= 0){
                     $Captcha->errorMsg = '验证码错误';
                }
                 else{
                    if($model->time_expiry<time()){
                        $Captcha->errorMsg= '验证码已经失效';
                    }
                     else{
                        $Captcha->status= 'ok';
                        $Captcha->errorMsg= 'success';
                    }
                }    
            }
            else{
                $Captcha->status= 'no';
                $Captcha->errorMsg= '验证码错误';
            }
            $Captcha->result= array();
            return  $Captcha;
      
        }

}
