<?php

class SalesOrderSearch extends ESearchModel {

    public function __construct($searchInputs, $with = null) {
        parent::__construct($searchInputs, $with);
    }

    public function model() {
        $this->model = new SalesOrder();
    }

//refNo orderType crmNo bkType finalAmount isPaid
    public function getQueryFields() {
        return array('refNo', 'bkType', 'orderType', 'pingId', 'finalAmount', 'isPaid', 'dateOpen', 'dateClosed');
    }

    public function addQueryConditions() {
        if ($this->hasQueryParams()) {
            //patientBooking的参数
            if (isset($this->queryParams['refNo'])) {
                $refNo = $this->queryParams['refNo'];
                $this->criteria->compare('t.ref_no', $refNo, true);
            }
            if (isset($this->queryParams['bkType'])) {
                $bkType = $this->queryParams['bkType'];
                $this->criteria->compare("t.bk_type", $bkType);
            }
            if (isset($this->queryParams['orderType'])) {
                $orderType = $this->queryParams['orderType'];
                $this->criteria->compare("t.order_type", $orderType);
            }
            if (isset($this->queryParams['pingId'])) {
                $pingId = $this->queryParams['pingId'];
                $this->criteria->compare("t.ping_id", $pingId, true);
            }
            if (isset($this->queryParams['finalAmount'])) {
                $finalAmount = $this->queryParams['finalAmount'];
                $this->criteria->compare("t.final_amount", $finalAmount);
            }
            if (isset($this->queryParams['isPaid'])) {
                $isPaid = $this->queryParams['isPaid'];
                $this->criteria->compare("t.is_paid", $isPaid);
            }

            if (isset($this->queryParams['dateOpen'])) {
                $dateOpen = $this->queryParams['dateOpen'];
                $this->criteria->compare("t.date_open", $dateOpen, true);
            }
            if (isset($this->queryParams['dateClosed'])) {
                $dateClosed = $this->queryParams['dateClosed'];
                $this->criteria->compare("t.date_closed", $dateClosed, true);
            }
        }
    }

}
