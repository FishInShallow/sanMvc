<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/7/31
 * Time: 下午12:41
 */
function __autoload($class_name){
    $class_name=preg_replace('/\\\/','/',$class_name);
    require $class_name.'.php';
}

//项目所在完整路径
define('BASE_PATH',dirname(__FILE__));
//mvc核心和插件
define('CORE_PATH',BASE_PATH.'/core');
//控制器文件夹
define('CONTROLLERS_BASE_PATH',BASE_PATH.'/controllers');
//模型文件夹
define('MODELS_BASE_PATH',BASE_PATH.'/models');
//视图文件夹
define('VIEWS_BASE_PATH',BASE_PATH.'/views');
//上传文件夹
define('UPLOAD_BASE_PATH',BASE_PATH.'/upload');
//静态页面地址
define('STATIC_PAGES_PATH',BASE_PATH.'/staticPages');