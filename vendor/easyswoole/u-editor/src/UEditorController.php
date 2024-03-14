<?php
/**
 * Created by PhpStorm.
 * User: Tioncico
 * Date: 2020/4/27 0027
 * Time: 11:05
 */

namespace EasySwoole\UEditor;


use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\UEditor\Config\CatcherConfig;
use EasySwoole\UEditor\Config\FileConfig;
use EasySwoole\UEditor\Config\FileManagerConfig;
use EasySwoole\UEditor\Config\ImageConfig;
use EasySwoole\UEditor\Config\ImageManagerConfig;
use EasySwoole\UEditor\Config\ScrawlConfig;
use EasySwoole\UEditor\Config\SnapScreenConfig;
use EasySwoole\UEditor\Config\VideoConfig;

abstract class UEditorController extends Controller
{
    protected $rootPath = EASYSWOOLE_ROOT . '/Static/uploads';

    /** @var UEditor */
    protected $UEditor;

    public function __construct()
    {
        $this->UEditor = new UEditor($this->rootPath);
        $configList = [
            new CatcherConfig(),
            new FileConfig(),
            new FileManagerConfig(),
            new ImageConfig(),
            new ImageManagerConfig(),
            new ScrawlConfig(),
            new SnapScreenConfig(),
            new VideoConfig(),
        ];
        $this->UEditor->setConfigList($configList);
        parent::__construct();
    }

    function index()
    {
        $action = $this->request()->getRequestParam('action');
        $this->runAction($action);
    }


    protected function runAction($actionName)
    {
        switch ($actionName) {
            case "config":
                $this->config();
                break;
            case "uploadImage":
                $this->uploadImage();
                break;
            case "uploadScrawl":
                $this->uploadScrawl();
                break;
            case "catchImage":
                $this->catchImage();
                break;
            case "uploadVideo":
                $this->uploadVideo();
                break;
            case "uploadFile":
                $this->uploadFile();
                break;
            case "listImage":
                $this->listImage();
                break;
            case "listFile":
                $this->listFile();
                break;

        }

    }

    protected function catchImage()
    {
        $catchImageConfig = new CatcherConfig();
        $field = $catchImageConfig->getCatcherFieldName();
        $remoteList = $this->request()->getRequestParam($field);
        $result = $this->UEditor->catchImage($catchImageConfig, $remoteList);
        $this->writeData($result);
    }

    protected function uploadImage()
    {
        $result = $this->UEditor->uploadImage($this->request());
        $data = $result->toArray();
        @chmod($this->rootPath. $data['url'], 0755);
        $data['url'] = '/Static/uploads'. $data['url'];
        $this->writeData(json_decode(json_encode($data)));
    }

    protected function uploadScrawl()
    {
        $result = $this->UEditor->uploadScrawl($this->request());
        $this->writeData($result);
    }

    protected function uploadVideo()
    {
        $result = $this->UEditor->uploadVideo($this->request());
        $this->writeData($result);
    }

    protected function uploadFile()
    {
        $result = $this->UEditor->uploadFile($this->request());
        $this->writeData($result);
    }

    protected function listImage()
    {
        try {
            $result = $this->UEditor->listImage();

            if(!empty($result->getList())){
                $list = $result->getList();
                foreach ($list as $k=>$v){
                    $list[$k]['url'] = '/Static/uploads'.$v['url'];
                }
                $result->setList($list);
            }
            $this->writeData($result);
        }catch (\Throwable $e){
            $this->writeJson(200,[],$e->getMessage());
        }

    }

    protected function listFile()
    {
        $result = $this->UEditor->listFile();
        $this->writeData($result);
    }

    protected function config()
    {
        $this->writeData($this->UEditor->getConfig());
    }

    protected function writeData($result)
    {
        $data = json_encode($result);
        $callback = $this->request()->getRequestParam('callback');
        if (empty($callback)) {
            $this->response()->write($data);
            return true;
        }
        if (preg_match("/^[\w_]+$/", $callback)) {
            $this->response()->write(htmlspecialchars($callback) . '(' . $data . ')');
        } else {
            $this->response()->write(json_encode([
                'state' => 'callback参数不合法'
            ]));
        }
    }
}
