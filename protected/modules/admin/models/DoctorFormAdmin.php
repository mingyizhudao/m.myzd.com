<?php

/**
 * Description of DoctorFormAdmin
 * @author shuming
 */
class DoctorFormAdmin extends EFormModel {

    public $id;
    public $name;
    public $fullname;
    public $state_id;
    public $city_id;
    public $hospital_id;
    public $hospital_name;
    public $hp_dept_id;
    public $hp_dept_name;
    public $medical_title;
    public $academic_title;
    public $description;
    public $country_id;
    public $options_hospital;
    public $options_m_title;
    public $options_a_title;
    public $options_state;
    public $options_city;

    public function rules() {
        return array(
            array('name, fullname, state_id, city_id, hospital_id, hp_dept_id, medical_title, academic_title', 'required', 'message' => '请输入{attribute}'),
            array('description', 'length', 'max' => 200),
            array('hp_dept_name, hospital_name','safe'),
            array("hospital_name", "validateHospitalName"),
        );
    }

    public function validateHospitalName() {
        if ($this->hospital_id == 0) {
            if (trim($this->hospital_name) == "") {
                $this->addError("hospital_name", "请输入" . $this->getAttributeLabel("hospital_name"));
            }
        }
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => '姓名（展示）',
            'fullname' => '姓名',
            'state_id' => "省份",
            'city_id' => "城市",
            'hospital_id' => '所属医院',
            'hospital_name' => '所属医院',
            'hp_dept_id' => '所属科室',
            'hp_dept_name' => '所属科室',
            'medical_title' => '临床职称',
            'academic_title' => '学术职称',
            'description' => '描述',
        );
    }

    public function initModel(Doctor $doctor = null) {
        if (isset($doctor)) {
            $this->setScenario('update');
            $this->attributes = $doctor->attributes;
        } else {
            $this->setScenario('new');
        }
        $this->loadOptions();
    }

    public function loadOptions() {
        $this->loadOptionsHospital();
        $this->loadOptionsMedicalTitle();
        $this->loadOptionsAcademicTitle();
        $this->loadOptionsState();
        $this->loadOptionsCity();
    }

    public function loadOptionsHospital() {
        if (is_null($this->options_hospital)) {
            $this->options_hospital = CHtml::listData(Hospital::model()->getAll(null, array('order' => 't.name ASC')), 'id', 'name');
        }
        return $this->options_hospital;
    }

    public function loadOptionsMedicalTitle() {
        if (is_null($this->options_m_title)) {
            $this->options_m_title = Doctor::model()->getOptionsMedicalTitle();
        }
        return $this->options_m_title;
    }

    public function loadOptionsAcademicTitle() {
        if (is_null($this->options_a_title)) {
            $this->options_a_title = Doctor::model()->getOptionsAcademicTitle();
        }
        return $this->options_a_title;
    }

    public function loadOptionsState() {
        if (is_null($this->options_state)) {
            $this->options_state = CHtml::listData(RegionState::model()->getAllByCountryId($this->country_id), 'id', 'name_cn');
        }
        return $this->options_state;
    }

    public function loadOptionsCity() {
        if (is_null($this->state_id)) {
            $this->options_city = array();
        } else {
            $this->options_city = CHtml::listData(RegionCity::model()->getAllByStateId($this->state_id), 'id', 'name_cn');
        }
        return $this->options_city;
    }

}
