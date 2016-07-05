<?php

class QuestionnaireManager {

    public function apiCreateQuestionnaire($values){
        $output = array('status' => 'no', 'errorCode' => '0','errorMsg' =>'0','results'=> array());
        if(isset($values['questionnaireNumber']) == false || isset($values['answer']) == false || isset($values['userHostIp']) == false){
            $output = array('status' => 'no', 'errorCode' => '400','errorMsg' =>'Wrong parameters','results'=> array());
            return $output;
        }
        $key = md5($values['userHostIp']);
        $alive = '3600';
        $anwerList=Yii::app()->cache->get($key);
        $value = isset($anwerList) ? $anwerList : '';
        $value['answer_'.$values['questionnaireNumber']] = $values['answer'];
        yii::app()->cache->set($key, $value ,$alive);
        return $output = array('status' => 'ok', 'errorCode' => '200','errorMsg' =>'200','results'=> array('view'=>$values['questionnaireNumber']+1));
    }
    
   
}
