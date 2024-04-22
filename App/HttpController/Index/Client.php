<?php

namespace App\HttpController\Index;



use App\Service\CountryService;
use EasySwoole\HttpClient\HttpClient;

class Client extends Base
{
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

