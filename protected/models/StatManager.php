<?php

class StatManager {

    public function createStat($values) {
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
}
