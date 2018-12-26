<?php
require 'config.php';
use core\route;

$route=new route();
//在这里添加路由
$route->addRoute("/","IndexController","index");

//开始分发
$opt = isset($_GET['opt']) ? $_GET['opt'] : '';
$route->distribute($opt);