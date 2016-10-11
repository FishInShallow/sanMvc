<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/7/31
 * Time: 下午12:41
 */
//项目所在完整路径
define('BASE_PATH',dirname(__FILE__));
//mvc核心和插件
define('CORE_PATH',BASE_PATH.'/core');
//上传文件夹
define('UPLOAD_BASE_PATH',BASE_PATH.'/upload');
//控制器文件夹
define('CONTROLLERS_BASE_PATH',BASE_PATH.'/controllers');
//模型文件夹
define('MODELS_BASE_PATH',BASE_PATH.'/models');
//视图文件夹
define('VIEWS_BASE_PATH',BASE_PATH.'/views');
//数据库配置
define('DATABASE_URL','localhost');
define('DATABASE_USER','root');
define('DATABASE_PASSWORD','root');
define('DATABASE_NAME','Mydb');
