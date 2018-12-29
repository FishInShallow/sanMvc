<?php

/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/7/29
 * Time: 下午4:54
 */
namespace core;
class fileManager
{
    //读取目录
    public static function getDirs($path)
    {
        $pathName = $path;
        $path = UPLOAD_BASE_PATH . $path;
        $dirArray = array();
        $handle = opendir($path);   //目录句柄
        if ($handle) {
            $i = 0;
            while ($dir = readdir($handle)) {
                if ($dir != '.' && $dir != '..') {
                    $filePath = $path . '/' . $dir;
                    if (is_dir($filePath)) {
                        $dirArray[$i]['name'] = $dir;
                        $dirArray[$i]['path'] = $pathName . '/' . $dir;
                        $dirArray[$i]['type'] = 'Folder';
                        $dirArray[$i]['size'] = '-';
                        $dirArray[$i]['date'] = '-';
                    }
                    $i++;
                }
            }
            clearstatcache();   //清除缓存
            closedir($handle);  //关闭句柄
        }
        return $dirArray;
    }
    //读取文件
    public static function getFiles($path)
    {
        $pathName = $path;
        $path = UPLOAD_BASE_PATH . $path;
        $fileArray = array();
        $handle = opendir($path);
        if ($handle) {
            $i = 0;
            while ($file = readdir($handle)) {
                if ($file != '.' && $file != '..') {
                    $filePath = $path . '/' . $file;
                    if (is_file($filePath)) {
                        $fileArray[$i]['name'] = $file;
                        $fileArray[$i]['path'] = $pathName . '/' . $file;
                        $fileArray[$i]['type'] = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $filePath); //文件MIME类型
                        $fileArray[$i]['size'] = round(filesize($filePath) / 1024, 2) . ' kb';  //单位kb取两位小数
                        $fileArray[$i]['date'] = date("Y-m-d h:m:s", filemtime($filePath)); //修改时间格式
                    }
                    $i++;
                }
            }
            clearstatcache();
            closedir($handle);
        }
        return $fileArray;
    }
    //新建目录
    public static function createFolder($dir)
    {
        $dir = UPLOAD_BASE_PATH . $dir;
        $result = false;
        if (!file_exists($dir)) {
            $result = mkdir($dir);
        }
        return $result;
    }
    //上传文件
    public static function upload($dir, $file)
    {
    	$time = date("YmdHis");
        $path = UPLOAD_BASE_PATH . $dir . '/' . $time.''.mt_rand(1, 100).'.'.pathinfo($file['name'], PATHINFO_EXTENSION);
        $result = false;
        $result = move_uploaded_file($file['tmp_name'], iconv('UTF-8', 'UTF-8', $path));
        return $result;
    }
    //删除目录或文件
    public static function delFile($filePath)
    {
        $path = UPLOAD_BASE_PATH . $filePath;
        $result = false;
        if (file_exists($path)) {   //删除文件
            if (is_file($path)) {
                $result = unlink($path);
            } elseif (is_dir($path)) {  //删除目录
                $handle = opendir($path);
                while ($file = readdir($handle)) {
                    if ($file != '.' && $file != '..') {
                        self::delFile($filePath . '/' . $file); //递归直到目录被清空
                    }
                }
                clearstatcache();
                closedir($handle);
                $result = rmdir($path);
            }
        }
        return $result;
    }
    //下载文件
    public static function download($filePath){
        $result=false;
        $path=UPLOAD_BASE_PATH.$filePath;
        $fileName=preg_replace("{^/.*/}","",$filePath);
        $fileName=iconv("UTF-8","UTF-8",$fileName);
        $fileSize=filesize($path);
        if (file_exists($path)){
            header("Content-type: application/octet-stream");
            header("Accept-Ranges: bytes");
            header("Accept-Length: ".$fileSize);
            header("Content-Disposition: attachment; filename=".$fileName);
            $buffer=1024;
            $fileCount=0;
            $handle=fopen($path,"r");
            while (!feof($handle)&&$fileCount<$fileSize){
                $fileCount+=$buffer;
                echo fread($handle,$buffer);
            }
            fclose($handle);
            $result=true;
        }
        return $result;
    }

}