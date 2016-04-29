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
        
        if($_POST['refNo']){
            $refno = $_POST['refNo'];
            
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
                        echo '成功';
                       // $this->redirect(array('booking/userBooking', 'id' => $booking->getId()));
                    }
                } else {
                    echo '原页面';
//                     $this->redirect(array('booking/userBooking', 'id' => $booking->getId()));
                }
            }else{
                echo'未取到订单支付信息';
            }
            
        }else{
           echo '参数错误';
        }
    }
    
}
