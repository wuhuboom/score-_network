<?php

namespace App;

use App\Model\FriendModel;
use App\Model\OfflineMessageModel;
use App\Model\SystemMessageModel;
use App\Model\UserModel;
use EasySwoole\FastCache\Cache;

class WebSocketEvent
{
    /**
     * 打开了一个链接
     * @param swoole_websocket_server $server
     * @param swoole_http_request $request
     */
    public function onOpen(\Swoole\Websocket\Server $server, \Swoole\Http\Request $request)
    {
        $token = $request->get["token"];

        if(!isset($token)){
            $data = [
                "type" => "token expire"
            ];
            $server->push($request->fd, json_encode($data));
            $server->disconnect($request->fd,  1001,  'token expire');
            return;
        }


        $RedisPool =\EasySwoole\RedisPool\RedisPool::defer();

        $user = $RedisPool->get('User_token_'.$token);
        $user = json_decode($user,true);
        if($user == null){
            $data = [
                "type" => "token expire"
            ];
            $server->push($request->fd, json_encode($data));
            $server->disconnect($request->fd,  1002,  'token过期');
            return;
        }

        //绑定fd变更状态
        Cache::getInstance()->set('uid'.$user['id'], ["value"=>$request->fd],3600*24);
        Cache::getInstance()->set('fd'.$request->fd, ["value"=>$user['id']],3600*24);

        UserModel::create()->where('id', $user['id'])->update(['status' => 'online']);//标记为在线
        //给好友发送上线通知，用来标记头像去除置灰
        $friend_list = FriendModel::create()->where('user_id',$user['id'])->select();
        $data = [
            "type"  => "friendStatus",
            "uid"   => $user['id'],
            "status"=> 'online'
        ];
        foreach ($friend_list as $k => $v) {
            $fd = Cache::getInstance()->get('uid'.$v['friend_id']);//获取接受者fd
            if ($fd){
                $server->push($fd['value'], json_encode($data));//发送消息
            }
        }
        //获取未读消息盒子数量
        $count = SystemMessageModel::create()->where('user_id',$user['id'])->where('read',0)->count();
        $data = [
            "type"      => "msgBox",
            "count"     => $count
        ];
        //检查离线消息
        $offline_messgae = OfflineMessageModel::create()->where('user_id', $user['id'])->where('status', 0)->select();
        if ($offline_messgae){
            foreach ($offline_messgae as $k=>$v) {

                $fd = Cache::getInstance()->get('uid'.$user['id']);//获取接受者fd
                if ($fd){
                    $server->push($fd['value'], $v['data']);//发送消息
                    OfflineMessageModel::create()->where('id', $v['id'])->update(['status' => 1]);
                }
            }
        }
        $server->push($request->fd, json_encode($data));

    }

    /**
     * 链接被关闭时
     * @param swoole_server $server
     * @param int $fd
     * @param int $reactorId
     * @throws Exception
     */
    public function onClose(\Swoole\Websocket\Server $server, int $fd, int $reactorId)
    {
        if($reactorId<0){
           // echo'服务器主动断开'.$fd.$reactorId.PHP_EOL;
        }else{
           // echo '客户端主动断开'.$fd.$reactorId.PHP_EOL;
        }
        $uid = Cache::getInstance()->get('fd'.$fd);
	    //var_dump("用户{$fd}断开连接");
	    if(is_array($uid)){
		    $friend_list = FriendModel::create()->where('user_id',$uid['value'])->select();
		    $data = [
			    "type"  => "friendStatus",
			    "uid"   => $uid['value'],
			    "status"=> 'offline'
		    ];

		    if ($friend_list){
			    foreach ($friend_list as $k => $v) {
				    $result = Cache::getInstance()->get('uid'.$v['friend_id']);//获取接受者fd
				    if ($result){
					    $server->push($result['value'], json_encode($data));//发送消息
				    }
			    }
		    }
		    if ($uid !== false) {
			    Cache::getInstance()->unset('uid'.$uid['value']);// 解绑uid映射
		    }
		    Cache::getInstance()->unset('fd' . $fd);// 解绑fd映射
		    UserModel::create()->where('id',$uid['value'])->update(['status' => 'offline']);
	    }

    }

    /**
     * @param \Swoole\Http\Request $request
     * @param \Swoole\Http\Response $response
     * @return bool
     */
    public function onHandShake(\Swoole\Http\Request $request, \Swoole\Http\Response $response)
    {

        /** 此处自定义握手规则 返回 false 时中止握手 */
        if (!$this->customHandShake($request, $response)) {
            $response->end();
            return false;
        }

        /** 此处是  RFC规范中的WebSocket握手验证过程 必须执行 否则无法正确握手 */
        if ($this->secWebsocketAccept($request, $response)) {
            $response->end();
            return true;
        }

        $response->end();
        return false;
    }

    /**
     * @param \Swoole\Http\Request $request
     * @param \Swoole\Http\Response $response
     * @return bool
     */
    protected function customHandShake(\Swoole\Http\Request $request, \Swoole\Http\Response $response): bool
    {
        /**
         * 这里可以通过 http request 获取到相应的数据
         * 进行自定义验证后即可
         * (注) 浏览器中 JavaScript 并不支持自定义握手请求头 只能选择别的方式 如get参数
         */
        $headers = $request->header;
        $cookie = $request->cookie;

        // if (如果不满足我某些自定义的需求条件，返回false，握手失败) {
        //    return false;
        // }
        return true;
    }

    /**
     * RFC规范中的WebSocket握手验证过程
     * 以下内容必须强制使用
     *
     * @param \Swoole\Http\Request $request
     * @param \Swoole\Http\Response $response
     * @return bool
     */
    protected function secWebsocketAccept(\Swoole\Http\Request $request, \Swoole\Http\Response $response): bool
    {
        // ws rfc 规范中约定的验证过程
        if (!isset($request->header['sec-websocket-key'])) {
            // 需要 Sec-WebSocket-Key 如果没有拒绝握手
            var_dump('shake fai1 3');
            return false;
        }
        if (0 === preg_match('#^[+/0-9A-Za-z]{21}[AQgw]==$#', $request->header['sec-websocket-key']) || 16 !== strlen(base64_decode($request->header['sec-websocket-key']))) {
            //不接受握手
            var_dump('shake fai1 4');
            return false;
        }

        $key = base64_encode(sha1($request->header['sec-websocket-key'] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
        $headers = array(
            'Upgrade' => 'websocket',
            'Connection' => 'Upgrade',
            'Sec-WebSocket-Accept' => $key,
            'Sec-WebSocket-Version' => '13',
            'KeepAlive' => 'off',
        );

        if (isset($request->header['sec-websocket-protocol'])) {
            $headers['Sec-WebSocket-Protocol'] = $request->header['sec-websocket-protocol'];
        }

        // 发送验证后的header
        foreach ($headers as $key => $val) {
            $response->header($key, $val);
        }

        // 接受握手 还需要101状态码以切换状态
        $response->status(101);
        var_dump('shake success at fd :' . $request->fd);
        return true;
    }
}