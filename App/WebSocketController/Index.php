<?php
namespace App\WebSocketController;

use App\Model\ChatRecordModel;
use App\Model\CustomerModel;
use App\Model\FriendModel;
use App\Model\GroupMemberModel;
use App\Model\OfflineMessageModel;
use App\Model\SystemMessageModel;
use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\EasySwoole\Task\TaskManager;
use EasySwoole\FastCache\Cache;
use EasySwoole\Socket\AbstractInterface\Controller;

class Index extends Controller
{
    public function index()
    {
        $info = $this->caller()->getArgs();
        $server =   ServerManager::getInstance()->getSwooleServer();
        $server->disconnect($info['fd'],  1001,  'token expire');
        //var_dump($this->caller()->getArgs());
        //$this->response()->setMessage(['type'=>'test','msg'=>'打酱油的']);
    }
    public function ping()
    {
	    $data = $this->caller()->getArgs();
        $RedisPool = \EasySwoole\RedisPool\RedisPool::defer();
        $user = $RedisPool->get('User_token_' . $data['token']);
        $user = json_decode($user, true);
        $user_id  = $user['id']??0;
	    $num = $data['data']??1;
    	ECHO "来自用户{$user_id}的第{$num}次ping...".date('Y-m-d H:i:s',time()).PHP_EOL;
        $this->response()->setMessage(['code'=>200,'msg'=>'OK,I have been here all the time','type'=>'reply','data'=>[]]);
    }

    public function chatMessage()
    {
        $info = $this->caller()->getArgs();
        $info = $info['data'];

        $RedisPool = \EasySwoole\RedisPool\RedisPool::defer();
        $user = $RedisPool->get('User_token_' . $info['token']);
        $user = json_decode($user, true);

        if ($user == null) {
            $data = [
                "type" => $this->caller()->getArgs()
            ];
            $this->response()->setMessage($data);
            return;
        }
        //获取swooleServer
        $server =   ServerManager::getInstance()->getSwooleServer();


        if ($info['to']['type'] == "friend") {
            //好友消息
            $data = [
                'username' => $info['mine']['username'],
                'avatar' => $info['mine']['avatar'],
                'id' => $info['mine']['id'],
                'type' => $info['to']['type'],
                'content' => $info['mine']['content'],
                'cid' => 0,
                'mine' => $user['id'] == $info['to']['id'] ? true : false,//要通过判断是否是我自己发的
                'fromid' => $info['mine']['id'],
                'timestamp' => time() * 1000
            ];
            if ($user['id'] == $info['to']['id']) {
                return;
            }


            $fd = Cache::getInstance()->get('uid' . $info['to']['id']);//获取接受者fd
            if ($fd == false) {
                //这里说明该用户已下线，日后做离线消息用
                $offline_message = [
                    'user_id' => $info['to']['id'],
                    'data' => json_encode($data),
                ];
                //插入离线消息
                OfflineMessageModel::create()->data($offline_message)->save();
            } else {
                $server->push($fd['value'], json_encode($data));//发送消息
            }

            //记录聊天记录
            $record_data = [
                'user_id' => $info['mine']['id'],
                'friend_id' => $info['to']['id'],
                'group_id' => 0,
                'content' => $info['mine']['content'],
                'time' => time()
            ];
            ChatRecordModel::create()->data($record_data)->save();
        } elseif ($info['to']['type'] == "group") {
            //群消息
            $data = [
                'username' => $info['mine']['username'],
                'avatar' => $info['mine']['avatar'],
                'id' => $info['to']['id'],
                'type' => $info['to']['type'],
                'content' => $info['mine']['content'],
                'cid' => 0,
                'mine' => false,//要通过判断是否是我自己发的
                'fromid' => $info['mine']['id'],
                'timestamp' => time() * 1000
            ];
            $list =GroupMemberModel::create()->alias('gm')->field('u.id')->where('u.id>0')
                ->join('td_user as u', 'u.id = gm.user_id','LEFT')
                ->where('gm.group_id', $info['to']['id'])->all();


            // 异步推送
             TaskManager::getInstance()->async(function () use ($list, $user, $data) {

                $server = ServerManager::getInstance()->getSwooleServer();
                foreach ($list as $k => $v) {
                    if ($v['id'] == $user['id']) {
                        continue;
                    }

                    $fd = Cache::getInstance()->get('uid' . $v['id']);//获取接受者fd
                    if ($fd == false) {
                        //这里说明该用户已下线，日后做离线消息用
                        $offline_message = [
                            'user_id' => $v['id'],
                            'data' => json_encode($data),
                        ];
                        //插入离线消息
                        OfflineMessageModel::create()->data($offline_message)->save();
                    } else {
                        $server->push($fd['value'], json_encode($data));//发送消息
                    }
                }

            });

            //记录聊天记录
            $record_data = [
                'user_id' => $info['mine']['id'],
                'friend_id' => 0,
                'group_id' => $info['to']['id'],
                'content' => $info['mine']['content'],
                'time' => time()
            ];
            ChatRecordModel::create()->data($record_data)->save();

            $this->response()->setMessage(['type'=>'reply','msg'=>'OK']);
        }


    }

    public function addFriend()
    {
        $info = $this->caller()->getArgs();
        $RedisPool =\EasySwoole\RedisPool\RedisPool::defer();

        $user = $RedisPool->get('User_token_' . $info['token']);
        $user = json_decode($user, true);
        if ($user == null) {
            $data = [
                "type" => $this->caller()->getArgs()
            ];
            $this->response()->setMessage($data);
            return;
        }

        $friend_id = $info['to_user_id'];
        $system_message_data = [
            'user_id' => $friend_id,//接受者
            'from_id' => $user['id'],//来源者
            'remark' => $info['remark'],
            'type' => 0,
            'group_id' => $info['to_friend_group_id'],
            'time' => time()
        ];
        $isFriend =  FriendModel::create()->where('friend_id', $friend_id)->where('user_id', $user['id'])->get();
        if ($isFriend) {
            $data = [
                'type' => 'layer',
                'code' => 500,
                'msg' => '对方已经是你的好友，不可重复添加'
            ];
            $this->response()->setMessage($data);

            return;
        }
        if ($friend_id == $user['id']) {
            $data = [
                'type' => 'layer',
                'code' => 500,
                'msg' => '不能添加自己为好友'
            ];
            $this->response()->setMessage($data);
            return;
        }
        SystemMessageModel::create()->data($system_message_data)->save();

        //获取该接受者未读消息数量
        $count = SystemMessageModel::create()->where('user_id', $friend_id)->where('read', 0)->count();
        $data = [
            "type" => "msgBox",
            "count" => $count
        ];

        //获取swooleServer
        $server = ServerManager::getInstance()->getSwooleServer();

        $fd = Cache::getInstance()->get('uid' . $friend_id);//获取接受者fd
        if ($fd == false) {
            //这里说明该用户已下线，日后做离线消息用
            $offline_message = [
                'user_id' => $friend_id,
                'data' => json_encode($data),
            ];
            //插入离线消息
            OfflineMessageModel::create()->data($offline_message)->save();
        } else {
            $server->push($fd['value'], json_encode($data));//发送消息
        }
        $my_fd = Cache::getInstance()->get('uid' . $user['id']);
        $server->push($my_fd, json_encode(['code'=>200,'msg'=>'ok']));//发送消息
    }


    public function addList()
    {
        $info = $this->caller()->getArgs();
        $RedisPool =\EasySwoole\RedisPool\RedisPool::defer();

        $user = $RedisPool->get('User_token_' . $info['token']);
        $user = json_decode($user, true);
        if ($user == null) {
            $data = [
                "type" => $this->caller()->getArgs()
            ];
            $this->response()->setMessage($data);
            return;
        }
        $data = [
            "type" => "addList",
            "data" => [
                "type" => "friend",
                "avatar" => $user['avatar'],
                "username" => $user['nickname'],
                "groupid" => $info['fromgroup'],
                "id" => $user['id'],
                "sign" => $user['sign']
            ]
        ];
        //获取未读消息盒子数量
        $count = SystemMessageModel::create()->where('user_id', $info['id'])->where('read', 0)->count();
        $data1 = [
            "type" => "msgBox",
            "count" => $count
        ];

        //获取swooleServer
        $server = ServerManager::getInstance()->getSwooleServer();

        $fd = Cache::getInstance()->get('uid' . $info['id']);//获取接受者fd

        if ($fd == false) {
            //这里说明该用户已下线，日后做离线消息用
            $offline_message = [
                'user_id' => $info['id'],
                'data' => json_encode($data1),
            ];
            //插入离线消息
            OfflineMessageModel::create()->data($offline_message)->save();
        } else {
            $server->push($fd['value'], json_encode($data));//发送消息
            $server->push($fd['value'], json_encode($data1));//发送消息
        }
    }

    public function refuseFriend()
    {
        $info = $this->caller()->getArgs();
        $server = ServerManager::getInstance()->getSwooleServer();

        $id = $info['id'];//消息id
        $system_message = SystemMessageModel::create()->where('id',$id)->get();
        //获取该接受者未读消息数量
        $count = SystemMessageModel::create()->where('user_id', $system_message['from_id'])->where('read', 0)->count();
        $data = [
            "type" => "msgBox",
            "count" => $count
        ];

        $fd = Cache::getInstance()->get('uid' . $system_message['from_id']);//获取接受者fd

        if ($fd) {
            $server->push($fd['value'], json_encode($data));//发送消息
        }

    }

    public function joinNotify(){
        $info = $this->caller()->getArgs();

        $RedisPool =\EasySwoole\RedisPool\RedisPool::defer();

        $user = $RedisPool->get('User_token_' . $info['token']);
        $user = json_decode($user, true);
        if ($user == null) {
            $data = [
                "type" => $this->caller()->getArgs()
            ];
            $this->response()->setMessage($data);
        }



        $groupid = $info['groupid'];
        $list = GroupMemberModel::create()->where('group_id',$groupid)->get();
        $data = [
            "type" => "joinNotify",
            "data"  => [
                "system"    => true,
                "id"        => $groupid,
                "type"      => "group",
                "content"   => $user['nickname']."加入了群聊，欢迎下新人吧～"
            ]
        ];

        // 异步推送
        TaskManager::async(function () use ($list, $user, $data) {
            $server = ServerManager::getInstance()->getSwooleServer();
            foreach ($list as $k => $v) {
                $fd = Cache::getInstance()->get('uid' . $v['user_id']);//获取接受者fd
                if ($fd) {
                    $server->push($fd['value'], json_encode($data));//发送消息
                }

            }

        });
    }
}
