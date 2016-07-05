<?php

class QuestionnaireManager {

    public function apiCreateQuestionnaire($values){
        $output = array('status' => 'no', 'errorCode' => '0','errorMsg' =>'0','results'=> array());
        $values['userHostIp'] = Yii::app()->request->userHostAddress;
        if(isset($values['questionnaireNumber']) == false || isset($values['answer']) == false || isset($values['userHostIp']) == false){
            $output = array('status' => 'no', 'errorCode' => '400','errorMsg' =>'Wrong parameters','results'=> array());
            return $output;
        }else{
           $values['questionnaireNumber'] = trim($values['questionnaireNumber']);
           $values['answer'] = trim($values['answer']);
        }
        $key = md5($values['userHostIp']);
        $alive = '3600';
        $anwerList=Yii::app()->cache->get($key);
        $value = isset($anwerList) ? $anwerList : '';
        if($values['questionnaireNumber'] == 5){
            if(is_array($values['answer'])){
                foreach ($value['answer'] as $k=>$v){
                    $value['file']['file_name'] =$v['file_name']; 
                    $value['file']['file_url'] =$v['file_url'];
                    $value['file']['file_size'] =$v['file_size'];
                    $value['file']['mime_type'] =$v['mime_type'];
                    $value['file']['file_ext'] =$v['file_ext'];
                    $value['file']['remote_domain'] =$v['remote_domain'];
                    $value['file']['remote_file_key'] =$v['remote_file_key'];
                }
                $value['answer_'.$values['questionnaireNumber']] = $value['file'];
            }   
        }else{
            $value['answer_'.$values['questionnaireNumber']] = $values['answer'];
            yii::app()->cache->set($key, $value ,$alive);
        }
        return $output = array('status' => 'ok', 'errorCode' => '200','errorMsg' =>'200','results'=> array('view'=>$values['questionnaireNumber']+1));
    }
    
   
}
