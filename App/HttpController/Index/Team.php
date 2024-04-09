<?php

namespace App\HttpController\Index;



/**
 * Class Users
 * Create With Automatic Generator
 */
class Team extends Base
{
    //球队
    public function index()
    {
        $this->view('/index/team/index',$this->assign);
        return false;
    }

}

