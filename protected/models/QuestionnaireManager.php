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
        $num = count($anwerList);
        if ($values['questionnaireNumber'] == 1) {
            $num = 1;
        }
        $qustNum = $values['questionnaireNumber'] - 1;
        $value = isset($anwerList) ? $anwerList : '';
        if ($num >= $qustNum) {
            if (isset($values['type'])){
                $value[$values['questionnaireNumber']] = $values['type'];
                yii::app()->cache->set($key, $value, $alive);
            }else{
                $value[$values['questionnaireNumber']] = $values['answer'];
                yii::app()->cache->set($key, $value, $alive);
            }
//             if ($values['answer'] != 'picture') {
//                 $value[$values['questionnaireNumber']] = $values['answer'];
//                 yii::app()->cache->set($key, $value, $alive);
//             }
        } else {
            Yii::app()->cache->delete($key);
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
            $value[$values['questionnaireNumber']][$values['file_num']]['file_name'] = $values['file_name'];
            $value[$values['questionnaireNumber']][$values['file_num']]['file_url'] = $values['file_url'];
            $value[$values['questionnaireNumber']][$values['file_num']]['file_size'] = $values['file_size'];
            $value[$values['questionnaireNumber']][$values['file_num']]['mime_type'] = $values['mime_type'];
            $value[$values['questionnaireNumber']][$values['file_num']]['file_ext'] = $values['file_ext'];
            $value[$values['questionnaireNumber']][$values['file_num']]['remote_domain'] = $values['remote_domain'];
            $value[$values['questionnaireNumber']][$values['file_num']]['remote_file_key'] = $values['remote_file_key'];
            yii::app()->cache->set($key, $value, $alive);
        } else {
            Yii::app()->cache->delete($key);
            return $output = array('status' => 'no', 'errorMsg' => 'faile answer');
        }

        return $output = array('status' => 'ok');
    }

}
