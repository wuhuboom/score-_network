<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbStoreQueryCategory {

    /**
        类目ID
     **/
    public $category_id;

    /**
        类名名称
     **/
    public $name;


    public function getCategoryId() : string{
        return $this->category_id;
    }

    public function setCategoryId(string $categoryId){
        $this->category_id = $categoryId;
    }

    public function getName() : string{
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }


}

