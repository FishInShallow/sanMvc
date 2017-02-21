<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/7/31
 * Time: 下午12:41
 */
require_once 'core/controller.php';
require_once 'core/db/dbConnect.php';
require_once 'core/configuration.php';
require_once 'core/error_manager.php';
require_once 'core/fileManager.php';
require_once 'core/module.php';
require_once 'core/route.php';
require_once 'core/view.php';

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
//数据库配置
define('DATABASE_URL','');
define('DATABASE_USER','');
define('DATABASE_PASSWORD','');
define('DATABASE_NAME','');
