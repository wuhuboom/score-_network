<?php

namespace EasySwoole\WeChat\OfficialAccount\Draft;

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
     * 生成草稿图文结构
     * doc link: https://developers.weixin.qq.com/doc/offiaccount/Publish/Publish.html
     *
     * @param  articles 生成草稿图文结构
     *
     * @param  title    是    标题
     * @param  author    否    作者
     * @param  digest    否    图文消息的摘要，仅有单图文消息才有摘要，多图文此处为空。如果本字段为没有填写，则默认抓取正文前54个字。
     * @param  content    是    图文消息的具体内容，支持 HTML 标签，必须少于2万字符，小于1M，且此处会去除 JS ,涉及图片 url 必须来源 "上传图文消息内的图片获取URL"接口获取。外部图片 url 将被过滤。
     * @param  content_source_url    否    图文消息的原文地址，即点击“阅读原文”后的URL
     * @param  thumb_media_id    是    图文消息的封面图片素材id（必须是永久MediaID）
     * @param  need_open_comment    否    Uint32 是否打开评论，0不打开(默认)，1打开
     * @param  only_fans_can_comment    否    Uint32 是否粉丝才可评论，0所有人可评论(默认)，1粉丝才可评论
     *
     * @return bool
     * @throws HttpException
     */
    public function create($title,$thumb_media_id,$content,$author='',$digestr='',$content_source_url='',$need_open_comment=0,$only_fans_can_comment=0)
    {
       $article =  [
            'title' => $title,
            'thumb_media_id' => $thumb_media_id,
            'content' => $content,
            'author' => $author,
            'digestr' => $digestr,
            'content_source_url' => $content_source_url,
            'need_open_comment' => $need_open_comment,
            'only_fans_can_comment' => $only_fans_can_comment,
        ];

        return $article;
    }
    /**
     * 新建草稿
     * doc link: https://developers.weixin.qq.com/doc/offiaccount/Draft_Box/Add_draft.html
     *
     * @param  $articles                单篇或者多篇图文
     * 'title' => $title,
     * 'thumb_media_id' => $thumb_media_id,
     * 'content' => $content,
     * 'author' => $author,
     * 'digestr' => $digestr,
     * 'content_source_url' => $content_source_url,
     * 'need_open_comment' => $need_open_comment,
     * 'only_fans_can_comment' => $only_fans_can_comment,
     *
     * @return bool
     * @throws HttpException
     */
    public function add($articles)
    {
        // 发布接口
        $response = $this->getClient()
                         ->setMethod('POST')
                         ->setBody($this->jsonDataToStream($articles))
                         ->send($this->buildUrl('/cgi-bin/draft/add', [
                             'access_token' => $this->app[ServiceProviders::AccessToken]->getToken()
                         ]));

        $this->checkResponse($response, $parseData);
        return $parseData;
    }
    /**
     * 获取草稿
     * doc link: https://developers.weixin.qq.com/doc/offiaccount/Draft_Box/Get_draft.html
     *
     * @param  $media_id 要获取的草稿的media_id
     * @return bool
     * @throws HttpException
     */
    public function get($media_id)
    {
        // 发布状态轮询接口
        $response = $this->getClient()
                         ->setMethod('POST')
                         ->setBody($this->jsonDataToStream(['media_id' => $media_id]))
                         ->send($this->buildUrl('/cgi-bin/draft/get', [
                             'access_token' => $this->app[ServiceProviders::AccessToken]->getToken()
                         ]));
        $this->checkResponse($response, $parseData);
        return $parseData;

    }
    /**
     * 删除草稿
     * doc link: https://developers.weixin.qq.com/doc/offiaccount/Draft_Box/Delete_draft.html
     *
     * @param  $media_id  成功新增时返回的 $media_id
     * @return bool
     * @throws HttpException
     */
    public function delete($media_id)
    {
        // 删除草稿
        $response = $this->getClient()
                         ->setMethod('POST')
                         ->setBody($this->jsonDataToStream(['media_id' => $media_id]))
                         ->send($this->buildUrl('/cgi-bin/draft/delete', [
                             'access_token' => $this->app[ServiceProviders::AccessToken]->getToken()
                         ]));

        return $this->checkResponse($response);
    }



    /**
     * 修改草稿
     * doc link: https://developers.weixin.qq.com/doc/offiaccount/Publish/Get_article_from_id.html
     *
     * @param $media_id  要修改的图文消息的id
     * @param $index  要更新的文章在图文消息中的位置（多图文消息时，此字段才有意义），第一篇为0
     * @param $articles  图文结构体
     * @return mixed
     * @throws HttpException
     */
    public function update($media_id,$index,$articles)
    {
        $response = $this->getClient()
                         ->setMethod('POST')
                        ->setBody($this->jsonDataToStream(['media_id' => $media_id,'index'=>$index,'articles'=>$articles]))
                         ->send($this->buildUrl('/cgi-bin/draft/update', [
                             'access_token' => $this->app[ServiceProviders::AccessToken]->getToken()
                         ]));

        $this->checkResponse($response, $parseData);

        return $parseData;
    }
    /**
     * 获取草稿总数
     * doc link: https://developers.weixin.qq.com/doc/offiaccount/Draft_Box/Count_drafts.html
     *
     * @return ["total_count"=>TOTAL_COUNT] 草稿总数
     * @throws HttpException
     */
    public function count()
    {
        $response = $this->getClient()
                         ->setMethod('GET')
                         ->send($this->buildUrl('/cgi-bin/draft/count', [
                             'access_token' => $this->app[ServiceProviders::AccessToken]->getToken()
                         ]));

        $this->checkResponse($response, $parseData);

        return $parseData;
    }
    /**
     * 获取草稿列表
     * doc link: https://developers.weixin.qq.com/doc/offiaccount/Draft_Box/Count_drafts.html
     *
     * @param offset    是    从全部素材的该偏移位置开始返回，0表示从第一个素材返回
     * @param count    是    返回素材的数量，取值在1到20之间
     * @param no_content    否    1 表示不返回 content 字段，0 表示正常返回，默认为 0
     * @return ["total_count"=>TOTAL_COUNT] 草稿总数
     * @throws HttpException
     */
    public function batchget($offset,$count,$no_content=0)
    {
        $response = $this->getClient()
                         ->setMethod('POST')
                         ->setBody($this->jsonDataToStream(['offset' => $offset,'count' => $count,'no_content' => $no_content]))
                         ->send($this->buildUrl('/cgi-bin/draft/batchget', [
                             'access_token' => $this->app[ServiceProviders::AccessToken]->getToken()
                         ]));

        $this->checkResponse($response, $parseData);

        return $parseData;
    }
}