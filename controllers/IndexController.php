<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/7/20
 * Time: 下午5:12
 */
class IndexController extends controller{
    public function index(){
        require VIEWS_BASE_PATH.'/welcome.php';
    }
}