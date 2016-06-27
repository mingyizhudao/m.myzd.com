<?php

/**
 * app 推广
 * Class SpreadController
 */
class SpreadController extends WebsiteController {
    /**
     * 第三方请求记录
     */
    public function actionCreate(){
			
        if(Yii::app()->request->getParam('appid') && Yii::app()->request->getParam('ifa') && Yii::app()->request->getParam('callback_url')){
            $model = AppSpread::model()->getByAttributes(array('appid'=>Yii::app()->request->getParam('appid'),'ifa'=>Yii::app()->request->getParam('ifa') ));
            if(!is_object($model)){
                $model = new AppSpread();
                $model->appid = Yii::app()->request->getParam('appid');
                $model->ifa = Yii::app()->request->getParam('ifa');
                $model->mac = Yii::app()->request->getParam('mac');
                $model->callback_url = Yii::app()->request->getParam('callback_url');
                $model->user_host_ip = Yii::app()->request->getUserHostAddress();
                $model->save();
            }else{
                $model->callback_url = Yii::app()->request->getParam('callback_url');
                $model->user_host_ip = Yii::app()->request->getUserHostAddress();
                $model->save();
            }
        }
    }

    /**
     *  查询callback_url
     */
    public function actionQuery($appid='', $ifa=''){
        $callback_url = '';
        if(!empty($appid) && !empty($ifa)){
            $model = AppSpread::model()->getByAttributes(array('appid'=>$appid,'ifa'=>$ifa));
            if(is_object($model)){
                $callback_url = $model->callback_url;
            }
        }
        $output = array(
            'status' => 'ok',
            'errorCode' => 0,
            'errorMsg' => 'success',
            'results' => $callback_url,
        );
        $this->renderJsonOutput($output);
    }
}