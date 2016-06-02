<?php

class ApiViewSubCategory extends EApiViewService {
    private $sub_category;
    public function __construct($id) {
        parent::__construct();
        $this->sub_category = $id;
    }

    /**
     * loads data by the given $id (Disease.id).
     * @param integer $diseaeId Disease.id     
     */
    protected function loadData() {

        $this->loadSubCategory();
    }

    protected function createOutput() {
        if (is_null($this->output)) {
            $this->output = array(
                'status' => self::RESPONSE_OK,
                'errorCode' => 0,
                'errorMsg' => 'success',
                'results' => $this->results,
            );
        }
    }

    /**
     *
     * @throws CException
     */
    private function loadSubCategory() {

        $model = DiseaseCategory::model()->getByAttributes(array('sub_cat_id'=>$this->sub_category, 'app_version'=>7));
        if (is_null($model)) {
            $this->throwNoDataException();
        }
        $this->setSubCategory($model);

    }

    private function setSubCategory(DiseaseCategory $model) {
        $data = new stdClass();
        $data->id = $model->getSubCategoryId();
        $data->name = $model->getSubCategoryName();

        $this->results = $data;
    }
}
