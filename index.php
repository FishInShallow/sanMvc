<?php
include_once 'core/route.php';
include_once 'config.php';
$route=new route();
//在这里添加路由
$route->addRoute("/","IndexController","index");

//开始分发
$route->distribute($_SERVER['PATH_INFO']);