<?php

class QuestionnaireManager {

    public function apiCreateQuestionnaire($values) {
        $output = array('status' => 'no', 'errorCode' => '0', 'errorMsg' => '0');
        $values['userHostIp'] = Yii::app()->request->userHostAddress;
        if (isset($values['questionnaireNumber']) == false || isset($values['userHostIp']) == false) {
            $output = array('status' => 'no', 'errorCode' => '400', 'errorMsg' => 'Wrong parameters');
            return $output;
        } else {
            $values['questionnaireNumber'] = trim($values['questionnaireNumber']);
            $values['answer'] = trim($values['answer']);
        }
        $key = session_id();
        $alive = '3600';
        $anwerList = Yii::app()->cache->get($key);
        var_dump($anwerList); echo '</br>';
        $num = count($anwerList);
        if ($values['questionnaireNumber'] == 1) {
            $num = 1;
        }
        $qustNum = $values['questionnaireNumber'] - 1;
        $value = isset($anwerList) ? $anwerList : '';
        if ($num >= $qustNum) {
            if (isset($values['type'])){
                if($values['type'] == 1){
                    $value[$values['questionnaireNumber']]['answer'] = $values['type'];
                    $value[$values['questionnaireNumber']]['answer_note'] = StatCode::QUESTIONNAIRE_PICTURE_EXISTENCE;
                }else{
                    $value[$values['questionnaireNumber']] = array('answer'=>$values['type'],'answer_note'=>StatCode::QUESTIONNAIRE_PICTURE_WITHOUT);
                }
                yii::app()->cache->set($key, $value, $alive);
            }else{
                $value[$values['questionnaireNumber']] = array('answer'=>$values['answer'],'answer_note'=>$values['answer_note']);
                yii::app()->cache->set($key, $value, $alive);
            }
        } else {

            Yii::app()->cache->delete($key);

            echo $num.'  |  '.$qustNum;exit;
            return $output = array('status' => 'no', 'errorMsg' => 'faile answer');
        }
        return $output = array('status' => 'ok', 'errorCode' => '200', 'errorMsg' => '200');
    }

    public function apiUploadQuestionnaireFile($values) {
        $output = array('status' => 'no', 'errorCode' => '0', 'errorMsg' => '0');
        $values['userHostIp'] = Yii::app()->request->userHostAddress;
        if (isset($values['questionnaireNumber']) == false || isset($values['file_num']) == false || isset($values['userHostIp']) == false) {
            $output = array('status' => 'no', 'errorCode' => '400', 'errorMsg' => 'Wrong parameters');
            return $output;
        }
        $key = session_id();
        $alive = '3600';
        $anwerList = Yii::app()->cache->get($key);
        $num = count($anwerList);
        if ($values['questionnaireNumber'] == 1) {
            $num = 1;
        }
        $qustNum = $values['questionnaireNumber'] - 1;
        $value = isset($anwerList) ? $anwerList : '';
        if ($num >= $qustNum) {
            $value[$values['questionnaireNumber']]['picture'][$values['file_num']]['file_name'] = $values['file_name'];
            $value[$values['questionnaireNumber']]['picture'][$values['file_num']]['file_url'] = $values['file_url'];
            $value[$values['questionnaireNumber']]['picture'][$values['file_num']]['file_size'] = $values['file_size'];
            $value[$values['questionnaireNumber']]['picture'][$values['file_num']]['mime_type'] = $values['mime_type'];
            $value[$values['questionnaireNumber']]['picture'][$values['file_num']]['file_ext'] = $values['file_ext'];
            $value[$values['questionnaireNumber']]['picture'][$values['file_num']]['remote_domain'] = $values['remote_domain'];
            $value[$values['questionnaireNumber']]['picture'][$values['file_num']]['remote_file_key'] = $values['remote_file_key'];
            yii::app()->cache->set($key, $value, $alive);
        } else {
            Yii::app()->cache->delete($key);
            return $output = array('status' => 'no', 'errorMsg' => 'faile answer');
        }
        return $output = array('status' => 'ok');
    }

}
