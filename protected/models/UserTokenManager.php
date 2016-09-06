<?php
class UserTokenManager{  
    public function __construct() {
        
    }
    //$condition 条件 $sort--排序   $limit 多少条记录  $offset--从那里开始
    public function SelectAll($conditions,$sort,$limit=10,$offset=0){
        $criteria = new EMongoCriteria();
        $criteria->setConditions($conditions);
        if(!empty($sort)){
            $criteria->setSort($sort);
        }
        $criteria->limit($limit);
        $criteria->offset($offset);
        $UserTokenMongo = UserTokenMongo::model()->findAll($criteria);
        return $UserTokenMongo;
    }
    //$condition 条件 $sort--排序   $limit 多少条记录  $offset--从那里开始
    public function SelectOne($conditions,$sort,$limit=10,$offset=0){
        $criteria = new EMongoCriteria();
        $criteria->setConditions($conditions);
        if(!empty($sort)){
            $criteria->setSort($sort);
        }
        $criteria->limit($limit);
        $criteria->offset($offset);
        $UserTokenMongo = UserTokenMongo::model()->findAll($criteria);
        return $UserTokenMongo[0];
    }
}  
?>
