<?php

namespace App\HttpController\Common;

use EasySwoole\HttpClient\HttpClient;

class QePay
{
	static public $version = '1.0';
	static public $mch_id = '901002070';
	static public $key = 'e6777025603945a8aefe50d7603db68c';
	static public $recharge_key = 'a3a0b75ae9964c7ab08d8b8125cb6715';
	static public $pay_key = 'QMHYTGCP3CSHQROIMRI9FATYKQ1HPQ3Q';
	static public $pay_type  =  '521';
	static public $sign_type  =  'MD5';

	/**
	 * https://payment.qeaepay.com/pay/web
	 * 参数值    参数名    类型    是否必填    说明
	 * version    版本号    String    N    需同步返回JSON 必填，固定值 1.0
	 * mch_id    商户号    String    Y    平台分配唯一
	 * notify_url    异步通知地址    String    Y    不超过 200 字节,支付成功后发起,不能携带参数
	 * page_url    同步跳转地址    String    N    不超过 200 字节,支付成功后跳转地址,不能携带参数
	 * mch_order_no    商家订单号    String    Y    保证每笔订单唯一
	 * pay_type    支付类型    String    Y    请查阅商户后台通道编码
	 * trade_amount    交易金额    String    Y    当地货币 精确到元
	 * order_date    订单时间    String    Y    时间格式(北京时间) yyyy-MM-dd HH:mm:ss
	 * bank_code    银行代码    String    N    网银通道必填，其他类型一定不能填该参数
	 * goods_name    商品名称    String    Y    不超过 50 字节
	 * mch_return_msg    透传参数    String    N    不超过200字节
	 * payer_phone    手机号码    String    N    付款人手机号码,肯尼亚、代收必填(手机号前需加上国际区号,例:254798371123
	 * sign_type    签名方式    String    Y    固定值 MD5，不参与签名
	 * sign    签名    String    Y    不参与签名
	 */
	static public function web($mch_order_no,$trade_amount,$order_date,$goods_name,$notify_url,$page_url,$bank_code='',$mch_return_msg=''){
		$result = null;
		$merchant_key = self::$key;//支付秘钥
		$version = self::$version;
		$mch_id = self::$mch_id;
		$pay_type = self::$pay_type;
		$sign_type = self::$sign_type;

		$signStr = "";

		if($bank_code != ""){
			$signStr = $signStr."bank_code=".$bank_code."&";
		}

		$signStr = $signStr."goods_name=".$goods_name."&";
		$signStr = $signStr."mch_id=".$mch_id."&";
		$signStr = $signStr."mch_order_no=".$mch_order_no."&";
		if($mch_return_msg != ""){
			$signStr = $signStr."mch_return_msg=".$mch_return_msg."&";
		}
		$signStr = $signStr."notify_url=".$notify_url."&";
		$signStr = $signStr."order_date=".$order_date."&";
		if($page_url != ""){
			$signStr = $signStr."page_url=".$page_url."&";
		}
		$signStr = $signStr."pay_type=".$pay_type."&";
		$signStr = $signStr."trade_amount=".$trade_amount."&";
		$signStr = $signStr."version=".$version;

		$sign = self::sign($signStr,$merchant_key);

		$post_data = [
			'goods_name'   => $goods_name,
			'mch_id'       => $mch_id,
			'mch_order_no' => $mch_order_no,
			'notify_url'   => $notify_url,
			'order_date'   => $order_date,
			'pay_type'     => $pay_type,
			'trade_amount' => $trade_amount,
			'version'      => $version,
			'sign_type'    => $sign_type,
			'sign'         => $sign
		];
		/** 下面这些参数有填写才需要提交，不填写的不需要提交也不需要参与签名 */
		/**'bank_code'=>$bank_code,
		 * 'mch_return_msg'=>$mch_return_msg,
		 * 'page_url'=>$page_url,*/
		if($bank_code){
			$post_data['bank_code'] = $bank_code;
		}
		if($page_url){
			$post_data['page_url'] = $page_url;
		}
		if($mch_return_msg){
			$post_data['mch_return_msg'] = $mch_return_msg;
		}
		$url = 'https://payment.qeaepay.com/pay/web';
		return self::http_post_res($url,$post_data);
	}

	/**
	 * 参数值    参数名    类型    是否必填    说明
	 * sign_type    签名方式    String    Y    固定值MD5，不参与签名
	 * sign    签名    String    Y    不参与签名
	 * mch_id    商户代码    String    Y    平台分配唯一
	 * mch_transferId    商家转账订单号    String    Y    保证每笔订单唯一
	 * transfer_amount    转账金额    String    Y    以当地货币 精确到元
	 * apply_date    申请时间    String    Y    时间格式 （北京时间）：yyyy-MM-dd HH:mm:ss
	 * bank_code    收款银行代码    String    Y    详见商户后台银行代码表
	 * receive_name    收款银行户名    String    Y    银行户名
	 * receive_account    收款银行账号    String    Y    银行账号(巴西PIX代付填对应的类型账号)
	 * remark    备注    String    N    印度代付必填IFSC码，（哥伦比亚、厄瓜多尔、埃及、澳大利亚填写证件号码），秘鲁、阿尔及利亚必填CCI码
	 * back_url    异步通知地址    String    N    若填写则需参与签名,不能携带参数
	 * receiver_telephone    收款人手机号码    String    N    若填写则需参与签名(肯尼亚、加纳、埃及、巴基斯坦代付必填)
	 * 以下参数仅巴西PIX代付、加纳代付、玻利维亚代付、危地马拉代付需要填写
	 * document_type    密钥类型    String    N    PIX填写(CPF,CNPJ,PHONE, EMAIL,EVP)请注意！！！账号是CPF税号这里就填CPF、是手机号就填PHONE、是邮箱就填EMAIL！！！
	 *
	 * 加纳手机号代付填写运营商，常用运营商：MTN、Vodafone、AirtelTigo大小写敏感(可根据实际情况传值)
	 * 注：加纳手机号代付银行编码(bank_code)填写GHSMTN
	 *
	 * 危地马拉 Monetaria、Ahorro、Préstamo、Tarjeta de crédito 这是必须的
	 * document_id    巴西证件号码    String    N    巴西代付 填 CPF 账号
	 *
	 * 加纳银行代付填写身份证号码（必填）
	 *
	 * 玻利维亚代付 收款人身份证号CI
	 * 以下参数仅欧美代付需要填写
	 * aba    美国金融机构识别码    String    N    ABA中转号码，也称为ABA路由或路由传输号码，用于识别特定的美国金融机构，并出现在标准支票上。它是每个银行的9位数字地址
	 * bank_address    银行地址    String    N    银行地址
	 * user_address    收款人地址    String    N    收款人地址
	 */
	static public function transfer($mch_transferId,$transfer_amount,$apply_date,$bank_code,$receive_name,$receive_account,$back_url){
		//https://payment.qeaepay.com/pay/transfer
		$merchant_key = self::$pay_key;//支付秘钥
		$mch_id = self::$mch_id;
		$sign_type = self::$sign_type;

		$signStr = "";
		$signStr = $signStr."apply_date=".$apply_date."&";
		$signStr = $signStr."back_url=".$back_url."&";
		if($bank_code != ""){
			$signStr = $signStr . "bank_code=" . $bank_code . "&";
		}
		$signStr = $signStr."mch_id=".$mch_id."&";
		$signStr = $signStr."mch_transferId=".$mch_transferId."&";
		$signStr = $signStr."receive_account=".$receive_account."&";
		$signStr = $signStr."receive_name=".$receive_name."&";
		$signStr = $signStr."transfer_amount=".$transfer_amount;
		$sign = self::sign($signStr, $merchant_key);

		$post_data = [
			'apply_date'      => $apply_date,
			'back_url'       => $back_url,
			'bank_code'       => $bank_code,
			'mch_id'          => $mch_id,
			'mch_transferId'  => $mch_transferId,
			'receive_account' => $receive_account,
			'receive_name'    => $receive_name,
			'transfer_amount' => $transfer_amount,
			'sign_type'       => $sign_type,
			'sign'            => $sign
		];

		//var_dump($postdata);

		$url = 'https://payment.qeaepay.com/pay/transfer';

		return self::http_post($url,http_build_query($post_data));

	}

    //代付订单查询
    static public function queryTransfer($mch_transferId){
        //https://payment.qeaepay.com/query/transfer
        $merchant_key = self::$pay_key;//支付秘钥
        $mch_id = self::$mch_id;
        $sign_type = self::$sign_type;

        $signStr="";
        $signStr=$signStr."mch_id=".$mch_id."&";
        $signStr=$signStr."mch_transferId=".$mch_transferId;
        $sign = self::sign($signStr, $merchant_key);

        $post_data = [
            'mch_id'=>$mch_id,
            'mch_transferId'=>$mch_transferId,
            'sign_type'=>$sign_type,
            'sign'=>$sign
        ];

        //var_dump($postdata);

        $url = 'https://payment.qeaepay.com/query/transfer';
    
        return self::http_post($url,http_build_query($post_data));

    }

    public static function pay_http_post($url, $data){
	    $client = new HttpClient($url);
	    $client->setContentType($client::CONTENT_TYPE_X_WWW_FORM_URLENCODED);
	    $client->setTimeout(15);
	    $body = $client->post($data)->getBody();
	    return json_decode($body,1);
    }
	public static function http_post($url, $data)
	{

		$options = array(
			'http' => array(
				'method' => 'POST',
				'header' => 'Content-type:application/x-www-form-urlencoded',
				'header' => 'Content-Encoding : gzip',
				'content' => $data,
				'timeout' => 15 * 60
			)
		);
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		$res = json_decode($result,1);
		$res['data'] = $data;
		return $res;
	}



	public static function http_post_res($url, $data)
	{
		$client = new HttpClient($url);
		$client->setHeader('USERAGENT',"Mozilla/5.0 (Windows NT 5.1; zh-CN) AppleWebKit/535.12 (KHTML, like Gecko) Chrome/22.0.1229.79 Safari/535.12");
		$client->setTimeout(15);
		$body = $client->post($data)->getBody();
		return json_decode($body,1);
	}


	public static function convToGBK($str) {
		if( mb_detect_encoding($str,"UTF-8, ISO-8859-1, GBK")!="UTF-8" ) {
			return  iconv("utf-8","gbk",$str);
		} else {
			return $str;
		}
	}


	public static function sign($signSource,$key) {
		if (!empty($key)) {
			$signSource = $signSource."&key=".$key;
		}
		return     md5($signSource);
	}



	public static function validateSignByKey($signSource, $key, $retsign) {
		if (!empty($key)) {
			$signSource = $signSource."&key=".$key;
		}
		$signkey = md5($signSource);
		if($signkey == $retsign){
			return true;
		}
		return false;
	}

}