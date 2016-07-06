<?php

class QuestionnaireManager {

    public function apiCreateQuestionnaire($values){
        $output = array('status' => 'no','errorMsg' =>'0');
        $values['userHostIp'] = Yii::app()->request->userHostAddress;
        if(isset($values['questionnaireNumber']) == false || isset($values['answer']) == false || isset($values['userHostIp']) == false){
            $output = array('status' => 'no', 'errorCode' => '400','errorMsg' =>'Wrong parameters');
            return $output;
        }else{
           $values['questionnaireNumber'] = trim($values['questionnaireNumber']);
           $values['answer'] = trim($values['answer']);
        }
        $key = session_id();
        $alive = '3600';
        $anwerList=Yii::app()->cache->get($key);
        $VerificationNum=count($anwerList)-1;
        if($VerificationNum == $values['questionnaireNumber']){
            $value = isset($anwerList) ? $anwerList : '';
            if(isset($values['is_picture'])){
                if(is_array($values['answer'])){
                    unset($value[$values['questionnaireNumber']]);
                    foreach ($values['answer'] as $k=>$v){
                        $value[$values['questionnaireNumber']][$k]['file_name'] = $v['file_name'];
                        $value[$values['questionnaireNumber']][$k]['file_url'] = $v['file_url'];
                        $value[$values['questionnaireNumber']][$k]['file_size'] =$v['file_size'];
                        $value[$values['questionnaireNumber']][$k]['mime_type'] =$v['mime_type'];
                        $value[$values['questionnaireNumber']][$k]['file_ext'] =$v['file_ext'];
                        $value[$values['questionnaireNumber']][$k]['remote_domain'] =$v['remote_domain'];
                        $value[$values['questionnaireNumber']][$k]['remote_file_key'] =$v['remote_file_key'];
                    }
                     $value[$values['questionnaireNumber']] =  $value[$values['questionnaireNumber']];
                     yii::app()->cache->set($key, $value ,$alive);
                     return $output = array('status' => 'ok');
                }   
            }else{
                $value[$values['questionnaireNumber']] = $values['answer'];
                yii::app()->cache->set($key, $value ,$alive);
                return $output = array('status' => 'ok');
            }
        }else{
            Yii::app()->cache->delete(Yii::app()->request->userHostAddress);
            return $output = array('status' => 'no','errorMsg' =>'error');
        }
    }
}
