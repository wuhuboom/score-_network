<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemStoreDetailGetCategory {

    /**
        分类ID
     **/
    public $category_id;

    /**
        分类名称
     **/
    public $name;

    /**
        父分类ID
     **/
    public $parent_category_id;


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

    public function getParentCategoryId() : string{
        return $this->parent_category_id;
    }

    public function setParentCategoryId(string $parentCategoryId){
        $this->parent_category_id = $parentCategoryId;
    }


}

