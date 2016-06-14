<?php

class TestController extends WebsiteController {

    public function actionCreateAppUrl() {
        $app_id = 'd06e60ef72a91696';
        $appKey = AppVendor::model()->getByAppId($app_id);
        if(isset($appKey)){
            $key = $appKey->app_secret;
//            $requestUrl = substr($requestUrl, 0, strpos($requestUrl, '&sign'));
//            $sign = md5($requestUrl.$key);
//            $doctor = Yii::app()->createAbsoluteUrl("/apiopen/doctor?disease=1&page=1&timestamp={$now}&app_id={$app_id}");
            $now = time();
            $username = '姓名';
            $disease = "http://localhost/m.mingyizhudao.com/vendor/home/view?appId=d06e60ef72a91696&mobile=13423350003&timestamp={$now}";
//            echo $disease.$key;

            $diseaseSign = $disease . "&sign=" . createSignature(array('appId'=>'d06e60ef72a91696','mobile'=>'13423350003','timestamp'=>$now), $key);

            $doctor = "http://localhost/m.mingyizhudao.com/vendor/booking/patientBookingList?appId=c99ae561f36db004&mobile=13916681596&timestamp={$now}";
            $doctorSign = $doctor . "&sign=" . createSignature(array('mobile'=>'13916681596','appId'=>'d06e60ef72a91696','timestamp'=>$now), $key);

            $booking = Yii::app()->createAbsoluteUrl("/apiopen/booking?timestamp={$now}&app_id={$app_id}");
            $bookingSign = $booking . "&sign=" . md5($booking.$key);

            $bookingfile = Yii::app()->createAbsoluteUrl("/apiopen/bookingfile?timestamp={$now}&app_id={$app_id}");
            $bookingfileSign = $bookingfile . "&sign=" . md5($bookingfile.$key);

            $bookingpayment = Yii::app()->createAbsoluteUrl("/apiopen/bookingpayment?bookingNo=DR160126877882&timestamp={$now}&app_id={$app_id}");
            $bookingpaymentSign = $bookingpayment . "&sign=" . md5($bookingpayment.$key);

            $bookingpayment2 = Yii::app()->createAbsoluteUrl("/apiopen/bookingpayment?timestamp={$now}&app_id={$app_id}");
            $bookingpaymentSign2 = $bookingpayment2 . "&sign=" . md5($bookingpayment2.$key);

            $output = array(
                'status' => EApiViewService::RESPONSE_OK,
                'errorCode' => ErrorList::ERROR_NONE,
                'errorMsg' => 'success',
                'results'=>array(
                'disease' => $diseaseSign,
                'doctor' => $doctorSign,
                'booking' => $bookingSign,
                'bookingfile' => $bookingfileSign,
                'bookingpayment' => $bookingpaymentSign,
                'bookingpayment2' => $bookingpaymentSign2,
                )
            );
            var_dump($output);
        }
    }

    public function actionTest(){

        $values = array(
            'diagnosis'=>'患者名',
            'disease_remark'=>'disease_remark',
            'order_no'=>'QB160325470983',
            'order_status'=>1,
            'order_time'=>'2016-03-30 15:01:03',
            'phone'=>'13100000001',
            'true_name'=>'name',


        );

//        $model = new VendorRest();
//        $requestString = VendorRest::getRequestString($values);
//        $time = time();
//
//        $sign = VendorRest::getSign($requestString, $time, VendorRest::KEY_160);
//
//        $fields = json_encode($values);
//        $data = array('type'=>1,'t'=>$time, 'sign'=>$sign, 'fields'=>$fields);
        $data = VendorRest::getData($values, 1);
        $result = VendorRest::send(VendorRest::URL_160, $data);
        print_r($result);
    }


}
