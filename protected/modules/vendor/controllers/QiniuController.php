<?php

class QiniuController extends MobileController {

    /**
     * 安卓获取病人病历七牛上传权限
     */
    public function actionAjaxBookingToken() {
//        $url = 'http://file.mingyizhudao.com/api/tokenbookingmr';
        $url = 'http://121.40.127.64:8089/api/tokenbookingmr';
        $data = $this->send_get($url);
        $output = array('uptoken' => $data['results']['uploadToken']);
        $this->renderJsonOutput($output);
    }

    //保存文件信息
    public function actionAjaxBookingFile() {
        $output = array('status' => 'no');
        if (isset($_POST['booking'])) {
            $values = $_POST['booking'];
            $form = new BookingFileForm();
            $form->setAttributes($values, true);
            $form->user_id = Yii::app()->session['userId'];
            $form->initModel();
            if ($form->validate()) {
                $file = new BookingFile();
                $file->setAttributes($form->attributes, true);
                if ($file->save()) {
                    $output['status'] = 'ok';
                    $output['fileId'] = $file->getId();
                } else {
                    $output['errors'] = $file->getErrors();
                }
            }
        } else {
            $output['errors'] = 'no data....';
        }
        $this->renderJsonOutput($output);
    }

}
