<?php

class OrderController extends MobileController {

    public function actionView($refNo) {
        $apiSvc = new ApiViewSalesOrder($refNo);
        $output = $apiSvc->loadApiViewData();
        $this->render('view', array(
            'data' => $output
        ));
    }

    public function actionPayDeposit(){
        $output = array('status' => 'no','errorCode' => 0,'errorMsg' =>'' ,'results' => array()); // default status is false.
        if($_POST['order']['ref_no']){
            $refno = $_POST['order']['ref_no'];
            $model = SalesOrder::model()->getByAttributes(array('bk_ref_no' => $refno ,'order_type' => 'deposit'));
            if($model){
                $booking = Booking::model()->getByRefNo($model->bk_ref_no);
                if ($booking->booking_service_id == BookingServiceConfig::BOOKING_SERVICE_FREE_LIINIC) {
                    $adminBooking=new AdminBooking();
                    $adminBooking = $adminBooking->getByAttributes(array('ref_no' => $model->bk_ref_no));
                    $model->is_paid = SalesOrder::ORDER_PAIDED;
                    $model->date_closed = new CDbExpression('NOW()');
                    $booking->bk_status = StatCode::BK_STATUS_PROCESSING;
                     $adminBooking->booking_status = StatCode::BK_STATUS_PROCESSING;
                     $adminBooking->work_schedule = StatCode::BK_STATUS_PROCESSING;
                    if ($booking->save() && $model->save() && $adminBooking->save()) {
                         $output['status'] = ok;
                         $output['error_code'] = 200;
                         $output['errorMsg'] = 'no';
                         return $output;
                    }
                } else {
                     $output['error_code'] = 200;
                     $output['errorMsg'] = 'SaleOrder is not free.';
                     return $output;
                }
            }else{
                 $output['error_code'] = 200;
                 $output['errorMsg'] = 'SaleOrder not found.';
                 return $output;
            }
            
        }else{
            $output['error_code'] = 200;
            $output['errorMsg'] = 'Wrong parameters.';
            return $output;
        }
    }
    
}
