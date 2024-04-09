<?php

namespace App\HttpController\Index;



/**
 * Class Users
 * Create With Automatic Generator
 */
class League extends Base
{
    //球队
    public function index()
    {
        $this->view('/index/league/index',$this->assign);
        return false;
    }

}

