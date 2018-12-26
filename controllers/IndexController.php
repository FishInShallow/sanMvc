<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/7/20
 * Time: 下午5:12
 */
namespace controllers;
use core\controller;
use core\view;
class IndexController extends controller{
    public function index(){
        $view=new view();
		$hello = 'San';
        $view->show('/welcome.php',['hello' => $hello],true);
    }
}