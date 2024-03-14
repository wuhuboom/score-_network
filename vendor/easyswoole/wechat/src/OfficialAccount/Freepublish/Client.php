<?php

namespace EasySwoole\WeChat\OfficialAccount\Freepublish;

use EasySwoole\WeChat\Kernel\BaseClient;
use EasySwoole\WeChat\Kernel\Exceptions\HttpException;
use EasySwoole\WeChat\Kernel\ServiceProviders;

/**
 * 发布能力
 * 包括:发布接口,发布状态轮询,事件推送发布结果,删除发布,通过 article_id 获取已发布文章,获取成功发布列表
 * 参考微信文档 https://developers.weixin.qq.com/doc/offiaccount/Publish/Publish.html
 *
 * Class Client
 * @author: 67066
 * @date: 2020/11/25 11:21
 * @package EasySwoole\WeChat\OfficialAccount\Menu
 */
class Client extends BaseClient
{
    /**
     * 发布接口
     * doc link: https://developers.weixin.qq.com/doc/offiaccount/Publish/Publish.html
     *
     * @param  $media_id 要发布的草稿的media_id
     * @return bool
     * @throws HttpException
     */
    public function submit($media_id)
    {
        // 发布接口
        $response = $this->getClient()
                         ->setMethod('POST')
                         ->setBody($this->jsonDataToStream(['media_id' => $media_id]))
                         ->send($this->buildUrl('/cgi-bin/freepublish/submit', [
                             'access_token' => $this->app[ServiceProviders::AccessToken]->getToken()
                         ]));

        return $this->checkResponse($response);
    }
    /**
     * 发布状态轮询接口
     * doc link: https://developers.weixin.qq.com/doc/offiaccount/Publish/Get_status.html
     *
     * @param  $publish_id 发布任务id
     * @return bool
     * @throws HttpException
     */
    public function get($publish_id)
    {
        // 发布状态轮询接口
        $response = $this->getClient()
                         ->setMethod('POST')
                         ->setBody($this->jsonDataToStream(['publish_id' => $publish_id]))
                         ->send($this->buildUrl('/cgi-bin/freepublish/get', [
                             'access_token' => $this->app[ServiceProviders::AccessToken]->getToken()
                         ]));

        $this->checkResponse($response, $parseData);
        return $parseData;
    }
    /**
     * 删除发布
     * doc link: https://developers.weixin.qq.com/doc/offiaccount/Publish/Get_status.html
     *
     * @param  $article_id  成功发布时返回的 article_id
     * @param  index  要删除的文章在图文消息中的位置，第一篇编号为1，该字段不填或填0会删除全部文章
     * @return bool
     * @throws HttpException
     */
    public function delete($article_id,$index=0)
    {
        // 删除发布
        $response = $this->getClient()
                         ->setMethod('POST')
                         ->setBody($this->jsonDataToStream(['article_id' => $article_id,'index'=>$index]))
                         ->send($this->buildUrl('/cgi-bin/freepublish/delete', [
                             'access_token' => $this->app[ServiceProviders::AccessToken]->getToken()
                         ]));

        $this->checkResponse($response, $parseData);
        return $parseData;
    }



    /**
     * 通过 article_id 获取已发布文章
     * doc link: https://developers.weixin.qq.com/doc/offiaccount/Publish/Get_article_from_id.html
     *
     * @param article_id  要获取的草稿的article_id
     * @return mixed
     * @throws HttpException
     */
    public function getarticle($article_id)
    {
        $response = $this->getClient()
                         ->setMethod('POST')
                        ->setBody($this->jsonDataToStream(['article_id' => $article_id]))
                         ->send($this->buildUrl('/cgi-bin/freepublish/getarticle', [
                             'access_token' => $this->app[ServiceProviders::AccessToken]->getToken()
                         ]));

        $this->checkResponse($response, $parseData);
        return $parseData;
    }
    /**
     * 获取成功发布列表
     * doc link: https://developers.weixin.qq.com/doc/offiaccount/Publish/Get_publication_records.html
     *
     * @param offset  要获取的草稿的article_id 从全部素材的该偏移位置开始返回，0表示从第一个素材返回
     * @param count  要获取的草稿的article_id 返回素材的数量，取值在1到20之间
     * @param no_content  要获取的草稿的article_id 1 表示不返回 content 字段，0 表示正常返回，默认为 0
     * @return mixed
     * @throws HttpException
     */
    public function batchget($offset,$count,$no_content=0)
    {
        $response = $this->getClient()
                         ->setMethod('POST')
                         ->setBody($this->jsonDataToStream(['offset' => $offset,'count' => $count,'no_content' => $no_content]))
                         ->send($this->buildUrl('/cgi-bin/freepublish/batchget', [
                             'access_token' => $this->app[ServiceProviders::AccessToken]->getToken()
                         ]));

        $this->checkResponse($response, $parseData);

        return $parseData;
    }
}