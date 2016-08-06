<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/8/6
 * Time: 下午2:15
 */
class view{
    //向页面发送临时消息
    public function withError($errorInfo){
        session_start();
        $_SESSION['errorInfo']=$errorInfo;
    }
    public function withSuccess($successInfo){
        session_start();
        $_SESSION['successInfo']=$successInfo;
    }
    //展示页面,支持url和php文件路径
    public function show($url,$arr=array()){
        //arr: 发送到页面的数据
        session_start();
        if (strpos($url,".php")){
            foreach ($arr as $key=>$value){
                 $$key=$value;
            }
            $path=VIEWS_BASE_PATH.'/'.$url;
            require ''.$path.'';
        }
        else {
            header("location:{$url}");
        }
        unset($_SESSION['successInfo']);
        unset($_SESSION['errorInfo']);
        return $this;
    }
}