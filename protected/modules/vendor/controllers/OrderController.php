<?php

class OrderController extends MobileController {

    public function actionView() {
        $refNo = Yii::app()->request->getParam('refNo');
        if (empty($refNo)) {
            $refNo = Yii::app()->request->getParam('refno');
        }
        $apiSvc = new ApiViewSalesOrder($refNo);
        $output = $apiSvc->loadApiViewData();
        $this->render('view', array(
            'data' => $output
        ));
    }

}
