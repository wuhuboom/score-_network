<?php

namespace App\HttpController\Index;



use App\Service\CountryService;
use App\Service\EndedService;
use App\Service\InplayService;
use EasySwoole\HttpClient\HttpClient;

class Client extends Base
{
	public function odds(){
		$inplay = InplayService::create()->joinOddsList([],'i.id',1,1,'i.id desc')['list']??[];
		$this->AjaxJson(1,$inplay,'ok');
	}
    public function getEndedTime(){
        $data = EndedService::create()->order('time asc')->val('time');
        $this->AjaxJson(1,$data,'ok');
    }
    //获取国家
    public function getCountry()
    {
    	$api = 'https://cn.betsapi.com/docs/samples/countries.json';
    	$client = new HttpClient($api);
    	$res = $client->get()->getBody();
    	$data = json_decode($res,1);
    	if($data['results']){
    		foreach ($data['results'] as $k=>$v){
    			$country_data = $v;
    			$country_data['sort'] =$k+1;
    			$country_data['create_time'] =date('Y-m-d H:i:s');
    			$country_data['update_time'] =date('Y-m-d H:i:s');

			    if($country = CountryService::create()->getOne(['cc'=>$country_data['cc'],'name'=>$country_data['name']])){
				    CountryService::create()->update($country['id'],$country_data );
			    }else{
				    CountryService::create()->save($country_data);
			    }
		    }
	    }
       $this->writeJson(1,$data,'OK');

    }



  







}

