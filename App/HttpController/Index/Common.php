<?php

namespace App\HttpController\Index;



/**
 * Class Users
 * Create With Automatic Generator
 */
class Common extends Base
{

    /**
     * 上传图片
     * @return bool
     */
    public function uploadPicture(){
        $request=  $this->request();
        $img_file = $request->getUploadedFile('file');//获取一个上传文件,返回的是一个\EasySwoole\Http\Message\UploadFile的对象
        $fileSize = $img_file->getSize();
        $directory = $this->param['directory']??'common';
        $session_user = $this->session()->get('user');
        if(is_dir(EASYSWOOLE_ROOT.'/public/uploads/'.$directory)){
            mkdir(EASYSWOOLE_ROOT.'/public/uploads/'.$directory,0755);
        }

        //上传图片不能大于5M (1048576*5)
        if($fileSize>1048576*5){
            $this->AjaxJson(0,['size'=>$fileSize], 'The maximum file size cannot exceed 5MB'); return false;
        }
        $clientFileName = $img_file->getClientFilename();
        $fileName = date('YmdHis').$session_user['id'].rand(100000,999999).'.'.pathinfo($clientFileName, PATHINFO_EXTENSION);;
        $res = $img_file->moveTo(EASYSWOOLE_ROOT."/public/uploads/{$directory}/".$fileName);
        if(file_exists(EASYSWOOLE_ROOT."/public/uploads/{$directory}/".$fileName)){
            $data['path'] = "/public/uploads/{$directory}/".$fileName;
            $data['show_path'] = $this->host."/public/uploads/{$directory}/".$fileName;
            $this->AjaxJson(1, $data, 'upload picture success');
        }else{
            $this->AjaxJson(0,[], 'upload picture fail');
        }
        return true;
    }


}

