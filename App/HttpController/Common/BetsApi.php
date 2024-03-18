<?php

namespace App\HttpController\Common;



use EasySwoole\HttpClient\HttpClient;

/**
 * @todo    BetsApi请求
 * @version    v1.0.0
 */
class BetsApi
{
	/**
	 * 获取联赛
	 *
	 * @param int    $sport_id
	 * @param string $page
	 * @param string $cc
	 * @return mixed|string
	 */
    static public function getLeague($sport_id,$page='',$cc=''){
	    $system = Common::getSystem();
	    $api = "https://api.b365api.com/v1/league?token={$system['apikey']}&sport_id={$sport_id}&page={$page}&cc={$cc}";
	    $result = BetsApi::request($api);
        return $result;
    }

	//发起请求
	static public function request($api){
		try {
			$client = new HttpClient($api);
			$body = $client->get()->getBody();
			$res = json_decode($body,1);
			return $res;
		}catch (\Throwable $e){
			return $e->getMessage();
		}


	}








}

