<?php

class StatManager {

    public function createPatientStat($values) {
        $output['status'] = 'no';
        $output['errorCode'] = 400;
        $model = new PatientStatLog();
        $model->setAttributes($values, true);

        if ($model->save()) {
                $output['status'] = 'ok';
                $output['errorCode'] = 200;
                $output['errorMsg'] = "success";
                $output['result']['id'] = $model->getId();
        } else {
            $output['errorMsg'] = $model->getFirstErrors();
        }
        return $output;
    }

    public function createAppLogStat($values) {
        $output['status'] = 'no';
        $output['errorCode'] = 400;
        $model = new AppLog();
        $model->setAttributes($values, true);
        if (Yii::app()->session['vendorId']) {
            if(Yii::app()->session['vendorSite']){
                $model->site = Yii::app()->session['vendorSite'];
            }
            $model->vendor_id = Yii::app()->session['vendorId'];
        }
        if ($model->save()) {
            $output['status'] = 'ok';
            $output['errorCode'] = 200;
            $output['errorMsg'] = "success";
            $output['result']['id'] = $model->getId();
        } else {
            $output['errorMsg'] = $model->getFirstErrors();
        }
        return $output;
    }
}
