<?php

$fun = new index();
//echo "<pre>";
//$file = $_FILES;
////print_r($_SERVER);
//print_r($_REQUEST);
//print_r($file);
//die();
include("DBCon.php");
include_once("rich.php");
if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == 'xmlhttprequest'){
    // ajax请求
    $action = isset($_REQUEST['action'])?$_REQUEST['action']:"";
    if(!empty($action)){
        switch ($action){
            case "init_data":
                $fun->a_get_article();
                break;
            case "get_data":
                $fun->a_get_list();
                break;
            case "addOrEdit":
                $fun->a_add_edit();
                break;
            case "import_word":
                $fun->a_import_word();
                break;
            case "import_link":
                $fun->a_import_link();
                break;
            case "preview":
                $fun->a_preview();
                break;
            case "violation_check":
                $fun->a_violation_check();
                break;
            case "upload_img":
                $fun->a_upload_img();
                break;

        }
    }
    else
        echo json_encode(["code"=>0,"msg"=>"参数丢失！","data"=>[]]);
}
else {

}


class index{

    /**
     * 获取数据
     * @return false|string
     */
    public function a_get_list(){
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $db =new DB();
        if($id){
            $res = $db->db_getRow('select id,template_title,article_title,only_text,`type`,FROM_UNIXTIME(add_time,"%Y-%m-%d %H:%i") as add_time,rich_text,status from template_library where `status`!=2 AND `status`!=3 AND id='.$id);
            if($res>0)
            {echo json_encode(["code"=>1,"msg"=>"查询成功","data"=>$res]);exit();}
            else{echo json_encode(["code"=>0,"msg"=>"获取数据失败！","data"=>[]]);exit();}
        }
        else {
            $sql = "select id,template_title,article_title,only_text,`type`,FROM_UNIXTIME(add_time,'%Y-%m-%d %H:%i') as add_time,rich_text,status from template_library where `status`!=2 AND `status`!=3";
            $res = $db->db_getAll($sql);
            if($res>0)
            {echo json_encode(["code"=>1,"msg"=>"查询成功","data"=>$res]);exit();}
            else{echo json_encode(["code"=>0,"msg"=>"暂无数据","data"=>[]]);exit();}
        }

    }

    /**
     * 获取文章信息
     */
    public function a_get_article(){
        if(file_exists("article.txt")){
            $file__content = file_get_contents("article.txt");
            echo json_encode(["code"=>1,"msg"=>"操作成功！","data"=>json_decode($file__content)]);
            exit();
        }
        else{
            echo json_encode(["code"=>1,"msg"=>"暂无数据","data"=>[]]);
            exit();
        }
    }

    /**
     * 新增编辑内容
     */
    public function a_add_edit(){
        $id = isset($_REQUEST['id'])?$_REQUEST['id']:0;
        $template['rich_html'] = isset($_REQUEST['rich_html'])?$_REQUEST['rich_html']:"";
        $template['article_title'] = isset($_REQUEST['article_title'])?$_REQUEST['article_title']:"";
        $template['only_text'] = isset($_REQUEST['only_text'])?$_REQUEST['only_text']:"";
//        $template['type'] = isset($_REQUEST['type'])?$_REQUEST['type']:2; //模板or文章
//        $template['template_title'] =  isset($_REQUEST['template_title'])?$_REQUEST['template_title']:""; //模板标题
        $info = ["article_title"=>$template['article_title'],"rich_html"=>$template['rich_html'],"only_text"=>$template['only_text']];
        file_put_contents("article.txt",json_encode($info));
        echo json_encode(["code"=>1,"msg"=>"操作成功！","data"=>[]]);
        exit();
//        if($id){
//            //编辑
//            $db = new DB();
//            $sql = "update template_library set template_title = '{$template['template_title']}',rich_text='{$template['rich_text']}',".
//                "status=0,`type`={$template['type']},article_title ='{$template['article_title']}',only_text='{$template['only_text']}' where id=".$id;
//            $res = $db->db_update($sql);
//            if($res)
//            {
//                echo json_encode(["code"=>1,"msg"=>"操作成功！","data"=>[]]);
//                exit();
//            }
//            else{
//                echo json_encode(["code"=>0,"msg"=>"保存失败！","data"=>[]]);
//                exit();
//            }
//        }
//        else{
//            //新增
//            $db = new DB();
//            $sql = "insert into template_library set template_title = '{$template['template_title']}',rich_text='{$template['rich_text']}',".
//                "status=0,`type`={$template['type']},add_time=".time().",article_title ='{$template['article_title']}',only_text='{$template['only_text']}'";
//            $res = $db->db_insert($sql);
//            if($res)
//            {
//                echo json_encode(["code"=>1,"msg"=>"操作成功！","data"=>[]]);
//                exit();
//            }
//            else{
//                echo json_encode(["code"=>0,"msg"=>"保存失败！","data"=>[]]);
//                exit();
//            }
//        }

    }

    /**
     * 导入word文档
     */
    public function a_import_word(){
        //获取文件。上传至服务器
        $file = isset($_FILES['file'])?$_FILES['file']:[];
//        echo "<pre>";
//        print_r($file);
//        die();
        if (!empty($file)){
            $file_name = $file['name'];
            $new_name = date('YmdHis').rand(10000,99999).substr($file_name,strrpos($file_name,'.'));
            $file_url =  $_SERVER['DOCUMENT_ROOT']."/static/upload/file/". $new_name;
            try{
                if(move_uploaded_file($file['tmp_name'],$file_url)){
                    $rich =new \rich();
                    $html_res = $rich->word2html($file_url);
                   echo json_encode(["code"=>1,"msg"=>$html_res,"data"=>[]]);
                    exit();
                }
                else
                {
                    echo json_encode(["code"=>0,"msg"=>"文件上传失败！","data"=>[]]);
                    exit();
                }

            }
            catch (Exception $e){
                echo json_encode(["code"=>0,"msg"=>"错误！".$e->getMessage(),"data"=>[]]);
                exit();
            }

        }
        echo json_encode(["code"=>1,"msg"=>"文件获取失败！","data"=>[]]);
        exit();
    }

    /**
     * 导入文章链接
     */
    public function a_import_link(){
        $link = isset($_REQUEST['link'])?$_REQUEST['link']:"";
        if(empty($link))
        {
            echo json_encode(["code"=>0,"msg"=>"参数丢失！"]);
        }
        else{
            include ("wxCrawler.php");
            //$link = 'https://mp.weixin.qq.com/s/On9kOAn51oTpNsLXV5d2TQ';
            $crawler = new WxCrawler();
            $content = $crawler->crawByUrl($link);
            if(isset($content['content_html']) && !empty($content['content_html'])){
                echo json_encode(["code"=>1,"msg"=>$content['content_html'],"data"=>$content]);
                die();
            }
            else
            {
                echo json_encode(["code"=>1,"msg"=>$content['content_html'],"data"=>[]]);
                die();
            }
        }
    }

    /**
     * 生成预览
     */
    public function a_preview(){
        $html= isset($_REQUEST['html_content'])?$_REQUEST['html_content']:[];
        //$temp_id= isset($_REQUEST['temp_id'])?$_REQUEST['temp_id']:[]; //扫码或者链接访问预览
        $type = isset($_REQUEST['type'])?intval($_REQUEST['type']):0; //type="1" 扫码或者链接访问预览

        if(!empty($html) && empty($type)){
            $preview_link = "http://".$_SERVER['HTTP_HOST']."/preview_mobile.html?type=1"; //预览链接
            $previewPC_link = "http://".$_SERVER['HTTP_HOST']."/preview_pc.html?type=1"; //预览链接
            $info = ["rich_html"=>$html];
            file_put_contents("article_preview.txt",json_encode($info));
            //生成二维码图片
            $fileName_url= "static/QRCode/qrcode.png";
            if(file_exists($fileName_url))
                unlink($fileName_url);
            include_once("vendor/phpqrcode.php");
            $errorCorrectionLevel = 'M';//容错级别
            $matrixPointSize = 3;//生成图片大小
            QRcode::png($preview_link, $fileName_url, $errorCorrectionLevel, $matrixPointSize, 2);
            $radom = rand(1000,9999);
            echo json_encode(["code"=>1,"msg"=>"ok",
                    "data"=>["preview_link"=>$preview_link,"previewPC_link"=>$previewPC_link,
                        "qrCode_src"=>"http://".$_SERVER['HTTP_HOST']."/static/QRCode/qrcode.png?".$radom]]);
            exit();
//            $db = new DB();
//            $sql = "insert into template_library set rich_text='{$html}',".
//                "status=3"; //status=3表示仅用于预览
//            $sql2 = "delete from template_library where status=3";
//            $res = $db->db_delete($sql2);
//            $insert_id=$db->db_insert($sql);
//            if($insert_id){
//                //生成二维码图片
//                $fileName_url= "static/QRCode/qrcode.png";
//                if(file_exists($fileName_url))
//                    unlink($fileName_url);
//                include_once("vendor/phpqrcode.php");
//                $errorCorrectionLevel = 'M';//容错级别
//                $matrixPointSize = 3;//生成图片大小
//                QRcode::png($preview_link, $fileName_url, $errorCorrectionLevel, $matrixPointSize, 2);
//                $radom = rand(1000,9999);
//                echo json_encode(["code"=>1,"msg"=>"ok",
//                    "data"=>["preview_link"=>$preview_link,"previewPC_link"=>$previewPC_link,
//                        "qrCode_src"=>"http://".$_SERVER['HTTP_HOST']."/static/QRCode/qrcode.png?".$radom]]);
//                exit();
//            }
//            else{
//                echo json_encode(["code"=>0,"msg"=>"ok",[]]);
//                exit();
//            }
        }
        else if($type){
            if(file_exists("article_preview.txt")){
                $file__content = file_get_contents("article_preview.txt");
                echo json_encode(["code"=>1,"msg"=>"操作成功！","data"=>json_decode($file__content)]);
                exit();
            }
            else{
                echo json_encode(["code"=>1,"msg"=>"暂无数据","data"=>[]]);
                exit();
            }

//            $db =new DB();
//            $sql = "select id,rich_text,`status` from template_library where status=3 AND id=".intval($temp_id);
//            $res = $db->db_getRow($sql);
//            if(sizeof($res)>0)
//            {
//                echo json_encode(["code"=>1,"msg"=>"查询成功","data"=>$res]);
//                exit();
//            }

        }

    }

    /**
     * 上传裁剪后的图片
     */
    public function a_upload_img(){
        $__URL__ = '/';
        $base64_image = $_REQUEST['dataImg'];
        $fileName = time().rand(100000,999999);
        $put_url = "upload/image";
        try {
            // 分割base64码，获取头部编码部分
            $headData = explode ( ';', $base64_image );
            // 再获取编码前原文件的后缀信息
            $postfix = explode ( '/', $headData [0] );
            // 判断源文件是否是图片
            if (strstr ( $postfix [0], 'image' )) {
                // 判断是否是jpeg图片，并赋正确后缀名
                $postfix = $postfix [1] == 'jpeg' ? 'jpg' : $postfix [1];
                // 拼接要合成图片的完整路径及扩展名
                // DIRECTORY_SEPARATOR目录分隔符，由于win与linux目录分隔符不同，PHP根据当前系统返回正确目录分隔符。windows返回\ 或 /，linux返回/
                $file_url = $put_url . DIRECTORY_SEPARATOR . $fileName . '.' . $postfix;
                // 去掉$base64_image码中头部内容，获取文件编码部分内容
                $base64Arr = explode(",",$base64_image);
                // 经base64_decode解码
                $image_decode = base64_decode ($base64Arr[1] );
                try {
                    // 合成文件
                    file_put_contents ( $file_url, $image_decode);
                    // 返回可在浏览器访问的图片地址
                    echo json_encode(["code"=>1,"msg"=> $__URL__ . $file_url,"data"=>[]]);
                    exit();
                } catch ( Exception $e ) {
                    echo json_encode(["code"=>0,"msg"=> $e->getMessage(),"data"=>[]]);
                    exit();
                }
            }
        } catch ( Exception $e ) {
            echo json_encode(["code"=>0,"msg"=> $e->getMessage(),"data"=>[]]);
            exit();
        }
    }

    /**
     * 违规检测
     */
    public function a_violation_check(){
        $article_title = isset($_REQUEST['article_title'])?$_REQUEST['article_title']:"";
        $text = isset($_REQUEST['text'])?$_REQUEST['text']:"";
        $html = isset($_REQUEST['html'])?$_REQUEST['html']:"";
        $text = $article_title.$text;
        $res_text = ["code"=>1,"msg"=>"合规"];
        $richHandle = new \rich();
        if(!empty($text)){
            $res_text = $richHandle->violation_check("text",$text,"");
        }
        $res_img=[];
        $img_preg = '/src="(.*?)"/i';
        preg_match_all($img_preg,$html,$preg_match);
        if(count($preg_match[1])>0){
            $img_src_arr = $preg_match[1];
            foreach ($img_src_arr as $k=>$item){
                $url = "http://".$_SERVER["HTTP_HOST"].$item;
                $res=["code"=>1,"msg"=>"合规"];
                if(file_exists(substr($item,1)))
                    $res=$richHandle->violation_check("img","",$url);
                $res_img[]=$res;
            }
        }
        echo json_encode(["code"=>1,"msg"=>"","data"=>["text_res"=>$res_text,"img_res"=>$res_img]]);
        exit();
    }
}

