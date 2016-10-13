<?php

class QiniuManager {
    
   /**
     * 安卓获取病人病历七牛上传权限
     */
    public function apiBookingToken() {
        $url = 'http://file.mingyizhudao.com/api/tokenbookingmr';
//        $url = 'http://192.168.31.118/file.myzd.com/api/tokenbookingmr';
        return $url;
    }

    //保存文件信息
    public function apiBookingFile($values) {
        $output = array('status' => 'no');
            $form = new BookingFileForm();
            $form->setAttributes($values, true);
            $form->user_id = $this->getCurrentUserId();
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
        return $output;
    }
  }
