<?php

namespace App\HttpController\Common;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDateHelper;

/**
 * @todo    Spreadsheet
 * @version    v1.0.0
 */
class Spreadsheet
{
    /**
     * 读取表格数据 （可读取图片仅支持xlsx）
     * $readFilePath 表格路径
     * $date_cell  哪一行需要转日期 为空则不获取
     * $saveFilePath 是否需要获取图片 为空则不获取
     * @return array
     */
    static public function readExcelData($readFilePath,$date_cell = [],$saveFilePath='')
    {
        $imageFilePath = EASYSWOOLE_ROOT . $saveFilePath; //图片本地存储的路径
        if (!file_exists($imageFilePath)) { //如果目录不存在则递归创建
            mkdir($imageFilePath, 0755, true);
        }
        try {
            $file = EASYSWOOLE_ROOT.$readFilePath;; //包含图片的Excel文件
            $objRead = IOFactory::createReader('Xlsx');
            $objSpreadsheet = $objRead->load($file);
            $objWorksheet = $objSpreadsheet->getActiveSheet();
            $data = $objWorksheet->toArray();
            $img_data = [];// 图片数组
            $number = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; //对应表格的列
            if($saveFilePath){
                foreach ($objWorksheet->getDrawingCollection() as $drawing) {
                    list($startColumn, $startRow) = Coordinate::coordinateFromString($drawing->getCoordinates());
                    $imageFileName = $drawing->getCoordinates() . mt_rand(1000, 9999);
                    switch ($drawing->getExtension()) {
                        case 'jpg':
                            $imageFileName .= '.jpg';
                            $source = imagecreatefromjpeg($drawing->getPath());
                            imagejpeg($source, $imageFilePath . $imageFileName);
                            break;
                        case 'jpeg':
                            $imageFileName .= '.jpeg';
                            $source = imagecreatefromjpeg($drawing->getPath());
                            imagejpeg($source, $imageFilePath . $imageFileName);
                            break;
                        case 'gif':
                            $imageFileName .= '.gif';
                            $source = imagecreatefromgif($drawing->getPath());
                            imagegif($source, $imageFilePath . $imageFileName);
                            break;
                        case 'png':
                            $imageFileName .= '.png';
                            $source = imagecreatefrompng($drawing->getPath());
                            imagepng($source, $imageFilePath . $imageFileName);
                            break;
                    }
                    $key = stripos($number,$startColumn);
                    $data[$startRow-1][$key]=$saveFilePath . $imageFileName; //图片保存后的路径插入对应数组位置
                    $img_data[$startRow-1][$startColumn] = $saveFilePath. $imageFileName;
                }
            }
            if($date_cell){
                foreach ($data as $k=>$v){
                    $cell = $k+1;
                    foreach ($date_cell as $c){
                        $key = stripos($number,$c);
                        $data[$k][$key]= date('Y-m-d H:i:s',SharedDateHelper::excelToDateTimeObject($objWorksheet->getCell('J'.$cell)->getValue())->getTimestamp()-8*3600);
                    }
                }
            }
//            unset($data[0]); //删除表头
            return $data;
//            return $img_data;

        } catch (\Exception $e) {
            return $e->getTrace();
        }
    }

}

