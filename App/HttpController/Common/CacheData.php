<?php

namespace App\HttpController\Common;



use App\Model\RewardMenuGroupModel;
use App\Model\RewardMenuModel;
use App\Model\ShopUserModel;
use App\Model\UserMenuGroupModel;
use App\Model\UserMenuModel;
use App\Model\UserModel;
use EasySwoole\FastCache\Cache;

/**
 * @todo    数据缓存
 * @version    v1.0.0
 */
class CacheData
{
    public static function shopUserInfo($user_id){
        $user = Cache::getInstance()->get('shop_user_'.$user_id);
        if(empty($user)){
            $user = ShopUserModel::create()->where('id',$user_id)->find();
            if($user){
                Cache::getInstance()->set('shop_user_'.$user_id,$user,300);
            }
        }
        return $user;
    }
    public static function updateShopUserInfo($user_id){
        Cache::getInstance()->set('shop_user_'.$user_id,'');
        $user = ShopUserModel::create()->where('id',$user_id)->find();
        if($user){
            Cache::getInstance()->set('shop_user_'.$user_id,$user,300);
        }
        return $user;
    }
    public static function userInfo($user_id){
        $user = Cache::getInstance()->get('user_'.$user_id);
        if(empty($user)){
            $user = UserModel::create()->where('id',$user_id)->find();
            if($user){
                Cache::getInstance()->set('user_'.$user_id,$user,300);
            }
        }
        return $user;
    }
    public static function updateUserInfo($user_id){
        Cache::getInstance()->set('user_'.$user_id,'');
        $user = UserModel::create()->where('id',$user_id)->find();
        if($user){
            Cache::getInstance()->set('user_'.$user_id,$user,300);
        }
        return $user;
    }

    //缓存红包菜单
    public static function userMenu($host=''){
        $menu_group = [];Cache::getInstance()->get('user_menu');
        if(empty($menu_group)){
            $menu_group = UserMenuGroupModel::create()->field('id,name')->order('sort','asc')->select();
            if(empty($host)){
                $host = Common::getSystem()['host'];
            }
            foreach ($menu_group as $k=>$v){
                $field = 'id,type,name,image,path,appid,original_id';
                $menu =UserMenuModel::create()->where('user_menu_group_id',$v['id'])->where('is_show',1)->field($field)->order('sort','asc')->select();
                if(empty($menu)){
                    unset($menu_group[$k]);
                }else{
                    foreach ($menu as $key =>$item){
                        $menu[$key]['image'] = $host.$item['image'];
                    }
                    $menu_group[$k]['menu']  = $menu;
                }
            }
            Cache::getInstance()->set('user_menu',$menu_group);
        }
        return array_values($menu_group);
    }
    //缓存红包菜单
   public static function rewardMenu($host=''){
       $menu_group = [];Cache::getInstance()->get('reward_menu');
       if(empty($menu_group)){
           $menu_group = RewardMenuGroupModel::create()->field('id,name')->order('sort','asc')->select();
           if(empty($host)){
               $host = Common::getSystem()['host'];
           }
           foreach ($menu_group as $k=>$v){
               $field = 'id,type,name,image,path,appid,original_id,platform_type,`desc`';

               $menu =RewardMenuModel::create()
                                     ->where('reward_menu_group_id',$v['id'])
                                     ->where('is_show',1)
                                     ->where('start_time',date('Y-m-d H:i:s'),'<=')
                                     ->where('end_time',date('Y-m-d H:i:s'),'>=')
                                     ->field($field)->order('sort','asc')->select();
               if(empty($menu)){
                    unset($menu_group[$k]);
               }else{
                   foreach ($menu as $key =>$item){
                       $menu[$key]['image'] = Common::autoCompleteImage($item['image']);
                   }
                   $menu_group[$k]['menu']  = $menu;
               }

           }
           Cache::getInstance()->set('reward_menu',$menu_group);
       }
       return array_values($menu_group);
   }


}

