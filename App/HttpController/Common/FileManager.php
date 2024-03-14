<?php

namespace App\HttpController\Common;

/**
 * @todo       文件管理器
 * @version    v1.0.0
 */
class FileManager
{
    static public $directory = EASYSWOOLE_ROOT . '/public/uploads/'; //限制只能删出上传目录的文件

    /**
     * 获取当前目录下的所有文件夹
     *
     * @param string $folder 操作目录
     *
     * @return array 目录下的所有文件夹
     */
    static public function getFolderList($folder)
    {
        $path       = rtrim($folder, '/');
        $folderList = [];    //最终返回的数组
        $keysValue  = [];    //二维数组需要排序的值
        //扫描目录内的所有目录和文件并返回数组
        $data = scandir($path);
        $k    = 0;
        foreach ($data as $value) {
            //判断如果不是文件夹则进入下一次循环
            if (!is_dir($path . "/" . $value)) {
                continue;
            }
            if ($value != '.' && $value != '..') {
                $folderList[$k] = array(
                    "name"        => $value,
                    "create_time" => date('Y-m-d H:i:s', fileatime($path . "/" . $value)),
                );
                $keysValue[$k]  = $value;   //记录排序值
                $k++;
            }
        }
        //对二维数组进行排序
        array_multisort($keysValue, SORT_DESC, $folderList);
        return $folderList;
    }

    /**
     * 获取当前目录下的所有文件
     *
     * @param string $folder 操作目录
     *
     * @return array 目录下的所有文件
     */
    static public function getFileList($folder)
    {
        $path     = rtrim($folder, '/');
        $fileList = [];    //最终返回的数组
        //扫描目录内的所有目录和文件并返回数组
        $data = scandir($path);
        foreach ($data as $value) {
            //判断如果不是文件夹则进入下一次循环
            if (is_dir($path . "/" . $value)) {
                continue;
            }
            $file_name  = $path . "/" . $value;
            $fileList[] = [
                'name'        => $file_name,
                'create_time' => date('Y-m-d H:i:s', fileatime($file_name))
            ];
        }
        return $fileList;
    }

    /**
     * 删除指定文件夹
     *
     * @param $folder 指定目录
     *
     * @return bool
     */
    static public function deleteFolder($folder)
    {
        $path = rtrim($folder, '/');
        if (strpos($path, self::$directory) === false) {
            return '只能删除' . self::$directory . '下的目录';
        }
        $dh = opendir($path);
        //先删除目录下的文件：
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {
                $full_path = $path . "/" . $file;
                if (!is_dir($full_path)) {
                    @unlink($full_path);
                } else {
                    //如果是文件夹则递归清空目录
                    self::deleteFolder($full_path);
                }
            }
        }
        closedir($dh);
        //删除当前文件夹：
        if (rmdir($path)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除指定文件夹下的过期文件
     */
    static public function deleteFile($folder, $datetime)
    {
        $path = rtrim($folder, '/');
        if (strpos($path, self::$directory) === false) {
            return '只能删除' . self::$directory . '下的目录';
        }
        $dh  = opendir($path);
        $num = 0;
        //先删除目录下的文件：
        while ($file = readdir($dh)) {
            $full_path = $path . "/" . $file;
            if (!is_dir($full_path)) {
                //如果指定了时间，过期文件才删除
                if ($datetime) {
                    if ($datetime && strtotime($datetime) >= filectime($full_path)) {
                        @unlink($full_path);
                        $num++;
                    }
                } else {
                    @unlink($full_path);
                    $num++;
                }
            } else {
                continue;
            }
        }
        closedir($dh);
        return $num;
    }

}

