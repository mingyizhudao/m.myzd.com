<?php

class ApiViewHospitalSearchV2 extends EApiViewService {

    private $searchInputs;
    private $getCount = false;    // whether to count the total no. of Hospitals satisfying the search conditions.
    private $pageSize = 10;
    private $hospitalSearch;
    private $hospitals;
    private $locations;
    private $cityId;
    private $currentLocation;
    private $count;
    private $hospitalCityList;

    public function __construct($searchInputs) {
        parent::__construct();
        $this->searchInputs = $searchInputs;
        $this->searchInputs['is_show'] = 1;
        $this->getCount = isset($searchInputs['getcount']) && $searchInputs['getcount'] == 1 ? true : false;
        $this->searchInputs['pagesize'] = isset($searchInputs['pagesize']) && $searchInputs['pagesize'] > 0 ? $searchInputs['pagesize'] : $this->pageSize;
        if(isset($this->searchInputs['city'])){
            if($this->searchInputs['city'] == 0){
                unset($this->searchInputs['city']);
            }
        }
        if($this->searchInputs['isNotPaging']){
            $this->searchInputs['pagesize'] = 1000;
        }
        $this->hospitalSearch = new HospitalSearch($this->searchInputs);
    }

    protected function loadData() {
        // load Hospitals.
        $this->loadHospitals();
        $this->loadHospitalCityList();
        // load Location Navigation.
//        $this->loadLocations();
        if ($this->getCount) {
            $this->loadCount();
        }
    }

    private function loadCount() {
        if (is_null($this->count)) {
            $count = $this->hospitalSearch->count();
            $this->count = $count;
        }
    }

    protected function createOutput() {
        if (is_null($this->output)) {
            $this->output = array(
                'status' => self::RESPONSE_OK,
                'dataCity' => $this->hospitalCityList,
//                'currentLocation' => $this->currentLocation,
//                'locations' => $this->locations, //@used by app.
                'hospitals' => $this->hospitals,
                'count' => $this->count,
            );
        }
    }

    private function loadHospitals() {
        if (is_null($this->hospitals)) {
            $this->hospitals = array();
            $hospitals = $this->hospitalSearch->search();
            //$hospitalSearch = new HospitalSearch();
            //$hospitals = $hospitalSearch->search($this->searchInputs);
            if (arrayNotEmpty($hospitals)) {
                $this->setHospitals($hospitals);
            }
        }
    }

    private function loadLocations() {
        if (is_null($this->locations)) {
            $this->locations = array();
            $data = array(
                array(
                    'id' => 1, 'name' => '北京'
                ),
                array(
                    'id' => 73, 'name' => '上海'
                ),
                array(
                    'id' => 74, 'name' => '南京'
                ),
                array(
                    'id' => 87, 'name' => '杭州'
                ),
                array(
                    'id' => 200, 'name' => '广州'
                )
            );
            $this->setLocationList($data);
            $this->setCurrentLocation($this->cityId);
        }
    }

    private function setHospitals(array $models) {
        foreach ($models as $model) {
            $data = new stdClass();
            $data->id = $model->getId();
            $data->name = $model->getName();
            $data->ShortName = $model->getName(true);
            $data->imageUrl = $model->getAbsUrlAvatar();
            $data->hpClass = $model->getClass();
            $data->hpType = $model->getType();
            $data->phone = $model->getPhone();
            $this->hospitalCityList[] = $model->getCityId();
            $this->hospitals[] = $data;
        }
    }

    private function setLocationList(array $list) {
        foreach ($list as $city) {
            $data = new stdClass();
            $data->id = $city['id'];
            $data->name = $city['name'];
            $this->locations[] = $data;
        }
    }

    private function setCurrentLocation($cityId) {
        foreach ($this->locations as $location) {
            if ($location->id == $cityId) {
                $this->currentLocation = $location;
                break;
            }
        }
    }
    
    private function loadHospitalCityList() {
        $hospitalCityList = $this->hospitalCityList;
        if (arrayNotEmpty($hospitalCityList)) {
            $this->setHospitalCityList($hospitalCityList);
        }
    }
    
    private function setHospitalCityList($hospitalCityList) {
        $cityList = array_unique($hospitalCityList);
        unset($this->hospitalCityList);
        foreach ($cityList as $k=>$v) {
            $model = RegionCity::model()->getByAttributes(array('id'=> $v));
            if(isset($model)){
               $cityobj=new stdClass();
               $cityobj->id=  $model->id;
               $cityobj->name = $model->name;
               $this->hospitalCityList[] = $cityobj;
            }
        }
       // $this->hospitalCityList = $cityDate;
    }
    

}
