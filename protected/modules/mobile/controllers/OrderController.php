<?php

class OrderController extends MobileController {

    public function actionView($refNo) {
        if(empty($refNo)){
            $refNo = Yii::app()->request->getParam('refno');
        }
        $apiSvc = new ApiViewSalesOrder($refNo);
        $output = $apiSvc->loadApiViewData();
        $this->render('view', array(
            'data' => $output
        ));
    }

    public function actionPayDeposit(){
        $output = array('status' => 'no','errorCode' => 0,'errorMsg' =>'' ,'results' => array()); // default status is false.
        if($_POST['order']['bk_ref_no']){
            $refno = $_POST['order']['bk_ref_no'];
            $model = SalesOrder::model()->getByAttributes(array('bk_ref_no' => $refno ,'order_type' => 'deposit'));
            if($model){
                $booking = Booking::model()->getByRefNo($model->bk_ref_no);
                if ($booking->booking_service_id == BookingServiceConfig::BOOKING_SERVICE_FREE_LIINIC) {
                    $adminDate = AdminBooking::model()->updateAllByAttributes(array('booking_status'=> StatCode::BK_STATUS_PROCESSING,'work_schedule'=> StatCode::BK_STATUS_PROCESSING ,'date_updated'=>new CDbExpression("NOW()")), array('ref_no' =>$refno));
                    $orderDate = SalesOrder::model()->updateAllByAttributes(array('is_paid'=> SalesOrder::ORDER_PAIDED,'date_closed'=> new CDbExpression("NOW()")), array('bk_ref_no' => $refno ,'order_type' => 'deposit'));
                    $bookingDate = Booking::model()->updateAllByAttributes(array('bk_status'=>  StatCode::BK_STATUS_PROCESSING), array('ref_no' => $refno));
                    if ($bookingDate && $orderDate && $adminDate) {
                         $output['status'] = 'ok';
                         $output['error_code'] = 200;
                         $output['errorMsg'] = 'no';
                         $this->renderJsonOutput($output);
                    }
                } else {
                     $output['error_code'] = 200;
                     $output['errorMsg'] = 'SaleOrder is not free.';
                     $this->renderJsonOutput($output);
                }
            }else{
                 $output['error_code'] = 200;
                 $output['errorMsg'] = 'SaleOrder not found.';
                 $this->renderJsonOutput($output);
            }
            
        }else{
            $output['error_code'] = 200;
            $output['errorMsg'] = 'Wrong parameters.';
            $this->renderJsonOutput($output);
        }
    }
    
}
