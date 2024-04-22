<?php
namespace App\HttpController;
use App\Model\ArticleModel;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Template\Render;



class UEditor extends  \EasySwoole\UEditor\UEditorController
{
    public function word(){

    }
    public function save(){
        $param = $this->request()->getRequestParam(); //接收请求参数
        $id = isset($param['id'])?$param['id']:0;
        $template['rich_html'] = isset($param['rich_html'])?$param['rich_html']:"";
        $template['article_title'] = isset($param['article_title'])?$param['article_title']:"";
        $template['only_text'] = isset($param['only_text'])?$param['only_text']:"";
        $field = $param['save_type']==1?'public_contents':'pay_contents';
        if(ArticleModel::create()->where('id',$id)->update([$field=>$param['rich_html'],'title'=>$param['article_title'],'update_time'=>time()])){
            $this->writeJson(1,$param,'保存成功');return false;
        }else{
            $this->writeJson(0,[],'保存失败');return false;
        }


    }
    /**
     * 生成预览
     */
    public function savePreview(){
        $param = $this->request()->getRequestParam(); //接收请求参数
        $html= isset($param['html_content'])?$param['html_content']:[];
        if(!empty($html)){
            $time =time();
            $preview_link = "http://".$this->request()->getHeaders()['host'][0]."/UEditor/preview?name=".$time; //预览链接
            $previewPC_link = "http://".$this->request()->getHeaders()['host'][0]."/UEditor/preview?name=".$time; //预览链接
            $info = ["rich_html"=>$html];
            file_put_contents(EASYSWOOLE_ROOT."/UEditor/preview/".$time.".txt",json_encode($info));
            @chown(EASYSWOOLE_ROOT."/UEditor/preview/".$time.".txt",0755);
            //生成二维码图片
            $radom = rand(1000,9999);
            $this->writeJson(1,['file'=>EASYSWOOLE_ROOT."/UEditor/preview/".$time.".txt","preview_link"=>$preview_link,"previewPC_link"=>$previewPC_link, "qrCode_src"=>'http://'.$this->request()->getHeaders()['host'][0]."/UEditor/static/QRCode/qrcode.png?".$radom],'ok');
        } else{
                $this->writeJson(0,[],'暂无数据');return false;
        }
    }
    public function preview(){
        $param = $this->request()->getRequestParam(); //接收请求参数
        if(file_exists(EASYSWOOLE_ROOT."/UEditor/preview/".$param['name'].".txt")){
            $data = file_get_contents(EASYSWOOLE_ROOT."/UEditor/preview/".$param['name'].".txt");
            if($this->is_mobile()){
                $this->view('/index/index/preview_mobile',json_decode($data,1));return false;
            }else{
                $this->view('/index/index/preview_pc',json_decode($data,1));return false;
            }
        }else{
            $this->response()->withHeader('Content-type', 'text/html;charset=utf-8');
            $this->response()->write('<h1>内容不存在</h1>');
        }

    }
    public function view($tpl,$data,$is_reload=0){
        if($is_reload){
            Render::getInstance()->restartWorker();
        }
        $this->response()->write(Render::getInstance()->render($tpl, $data));
        return true;
    }
    /**
     * 检测PC手机端
     */
    public function is_mobile() {
        $user_agent = $this->request()->getHeaders()['user-agent'][0];
        if ( empty($user_agent) ) {
            $is_mobile = false;
        } elseif ( strpos($user_agent, 'Mobile') !== false
            || strpos($user_agent, 'Android') !== false
            || strpos($user_agent, 'Silk/') !== false
            || strpos($user_agent, 'Kindle') !== false
            || strpos($user_agent, 'BlackBerry') !== false
            || strpos($user_agent, 'Opera Mini') !== false
            || strpos($user_agent, 'Opera Mobi') !== false ) {
            $is_mobile = true;
        } else {
            $is_mobile = false;
        }
        return $is_mobile;
    }
    /**
     * 获取文章信息
     */
    public function getArticle(){
        if(file_exists("/UEditor/article.txt")){
            $file__content = file_get_contents("article.txt");
            $this->writeJson(1,json_decode($file__content,true),'操作成功');return false;
        }
        else{
            $this->writeJson(1,[],'暂无数据');return false;
        }
    }
    /**
     * 导入文章链接
     */
    public function articleImportLink(){
        $param = $this->request()->getRequestParam(); //接收请求参数
        $link = $param['link']??'';
        if(empty($link)) {
            $this->writeJson(0,$param,"参数丢失！");return false;
        } else{
            $crawler = new WxCrawler();
            $content = $crawler->crawByUrl($link);
            if(isset($content['content_html']) && !empty($content['content_html'])){
                $this->writeJson(200,$content,$content['content_html']);return false;
            } else {
                $this->writeJson(0,[],$content['content_html']);return false;

            }
        }
    }

}