<?php

namespace App\HttpController\Admin;


use App\HttpController\Common\Common;
use App\Model\PosterModel;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use EasySwoole\FastCache\Cache;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


class Poster extends \App\HttpController\Admin\Base
{
    /**
     * 列表
     */
    public function lists(){
        try {
            $page = (int)($this->param['page']??1);
            $limit = (int)($this->param['limit']??20);
            $model = PosterModel::create();

            if(!empty($this->param['name'])){ $model->where('name like "%'.$this->param['name'].'%"'); }

            $field = "*";
            $list = $model->withTotalCount()->alias('c')->order('sort', 'asc')->field($field)->limit($limit * ($page - 1), $limit)->all();
            $total = $model->lastQueryResult()->getTotalCount();;
            $this->AjaxJson(1, ['total'=>$total,'list'=>$list], 'success');
            return true;
        }catch (\Throwable $e){
            $this->AjaxJson(0, [], $e->getMessage());
            return true;
        }


    }
    /**
     * 新增
     */
    public function add(){
        $data = $this->param;

        $data['create_time'] = date('Y-m-d H:i:s');
        $data['update_time'] = date('Y-m-d H:i:s');
        $result = PosterModel::create()->validateData($data,'add');
        if($result!==true) {
            $this->AjaxJson(0,$data,$result);return false;
        }
        try{
            if($last_id = PosterModel::create()->data($data)->save()){

                $this->AjaxJson(1, ['status'=>1], '新增成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '新增失败');return false;
            }
        }catch (\Exception $e){
            $this->AjaxJson(0,['status'=>0], '插入数据库错误：'.$e->getMessage());return false;
        }
    }

    /**
     * 更新
     */
    public function edit(){

        try {
            if (!empty($this->param['id'])) {
                $data = $this->param;
                $data['update_time'] = date('Y-m-d H:i:s');
                $PosterModel = PosterModel::create();
                $result = $PosterModel->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }

                if ($PosterModel->where('id',$this->param['id'])->update($data)) {
                    Cache::getInstance()->unset('category_'.$this->param['id']);
                    $this->AjaxJson(1, ['status' => 1,'data'=>$data], '更新成功');
                    return false;
                } else {
                    $this->AjaxJson(0, ['status' => 0], '更新失败');
                    return false;
                }

            } else {
                $this->AjaxJson(0, ['status' => 0], 'ID不存在');
            }
        } catch (\Exception $e) {
            $this->AjaxJson(0, ['status' => 0], '更新出错：' . $e->getMessage());
        }
        return false;
    }

    /**
     * 排序
     */
    public function sort(){
        try {
            if (!empty($this->param['id'])) {
                $data[$this->param['field']] = $this->param['value'];
                $data['update_time'] = date('Y-m-d H:i:s');

                if (PosterModel::create()->update($data, ['id' => $this->param['id']])) {
                    $this->AjaxJson(1, ['status' => 1], '更新成功');
                    return false;
                } else {
                    $this->AjaxJson(0, ['status' => 0], '更新失败');
                    return false;
                }

            } else {
                $this->AjaxJson(0, ['status' => 0], 'ID不存在');
            }
        } catch (\Exception $e) {
            $this->AjaxJson(0, ['status' => 0], '更新出错：' . $e->getMessage());
        }
        return false;
    }

    /**
     * 上传图片
     * @return bool
     */
    public function upload(){
        $request=  $this->request();
        $img_file = $request->getUploadedFile('file');//获取一个上传文件,返回的是一个\EasySwoole\Http\Message\UploadFile的对象
        $fileSize = $img_file->getSize();
        //上传图片不能大于5M (1048576*5)
        if($fileSize>1048576*10){
            $this->AjaxJson(0,['size'=>$fileSize], '文件最大不能超过1MB'); return false;
        }
        $clientFileName = $img_file->getClientFilename();
        $fileName = date('YmdHis').rand(100000,999999).'.'.pathinfo($clientFileName, PATHINFO_EXTENSION);;
        $res = $img_file->moveTo(EASYSWOOLE_ROOT.'/public/uploads/poster/'.$fileName);
        if(file_exists(EASYSWOOLE_ROOT.'/public/uploads/poster/'.$fileName)){
            $data['image'] = '/public/uploads/poster/'.$fileName;
            $this->AjaxJson(1, $data, '海报上传成功');
        }else{
            $this->AjaxJson(0,EASYSWOOLE_ROOT.'/public/uploads/poster/'.$fileName, '文件上传失败');
        }
        return true;
    }
    /**
     * H5推广二维码
     * @return void
     */
    public function preview(){
        try {
            $poster = PosterModel::create()->where('id',$this->param['id'])->find();
            $system  = Common::getSystem();
            $distribution = $system['distribution'];
            $writer  = new PngWriter(); //png格式
            // 创建二维码
            $qrCode = \Endroid\QrCode\QrCode::create($this->host)
                                            ->setEncoding(new Encoding('UTF-8'))
                                            ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh())
                                            ->setSize(300)
                                            ->setMargin(10)
                                            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                                            ->setForegroundColor(new Color(0, 0, 0))
                                            ->setBackgroundColor(new Color(255, 255, 255));
            // 加入logo
            $logo = Logo::create(EASYSWOOLE_ROOT .'/public/logo.png')->setResizeToHeight(80)->setResizeToWidth(80);
            if(!file_exists(EASYSWOOLE_ROOT . '/public/uploads/poster/preview')){
                mkdir(EASYSWOOLE_ROOT . '/public/uploads/poster/preview');
            }
            $result = $writer->write($qrCode, $logo);
            $result->saveToFile(EASYSWOOLE_ROOT . '/public/uploads/poster/preview' . $poster['id'] . '.png'); //保存图片到本地edriver是什么
            $filename = EASYSWOOLE_ROOT .'/public/uploads/poster/preview' . $poster['id'] . '.png';
            $bg =EASYSWOOLE_ROOT .$poster['image'];
            $url = \App\HttpController\Common\Poster::createPoster($poster['id'],$poster['id'],$filename,$bg,'preview',$poster['left'],$poster['top'],$poster['width'],$poster['height'],1);
            $this->AjaxJson(1,['url'=>$url],'ok');return false;
        } catch (\Exception $e) {
            $this->AjaxJson(0, ['status' => 0], $e->getMessage());
        }


    }

    /**
     * 排序
     */
    public function doStatus(){
        try {
            if (!empty($this->param['id'])) {
                $data[$this->param['field']] = $this->param['value'];
                $data['update_time'] = date('Y-m-d H:i:s');

                if (PosterModel::create()->update($data, ['id' => $this->param['id']])) {
                    $this->AjaxJson(1, ['status' => 1], '更新成功');
                    return false;
                } else {
                    $this->AjaxJson(0, ['status' => 0], '更新失败');
                    return false;
                }

            } else {
                $this->AjaxJson(0, ['status' => 0], 'ID不存在');
            }
        } catch (\Exception $e) {
            $this->AjaxJson(0, ['status' => 0], '更新出错：' . $e->getMessage());
        }
        return false;
    }
    /**
     * 删除
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);


            if( PosterModel::create()->where('id',$ids,'in')->destroy()){
                $this->AjaxJson(1, ['status'=>1], '删除海报成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除海报失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的海报');
        }
        return false;
    }



    /**
     * 全部
     */
    public function all(){
        $model  = PosterModel::create();
        $list = $model->withTotalCount()->field('id as value, name')->order('sort', 'asc')->select();
        $this->AjaxJson(1, $list, 'OK');
        return true;
    }



}

