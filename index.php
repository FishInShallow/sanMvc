<?php
include_once 'config.php';
include_once 'core/module.php';
include_once 'core/controller.php';
include_once 'core/view.php';
include_once 'core/route.php';
$route=new route();
//在这里添加路由
$route->addRoute("/","IndexController","index");

//开始分发
$route->distribute($_SERVER['PATH_INFO']);