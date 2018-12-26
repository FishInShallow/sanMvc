<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/7/19
 * Time: 下午8:15
 */
namespace core;
class controller
{
    function __construct($methodName, $id = 0)
    {
        $this->auth();
        $this->option($methodName, $id);
    }

    function option($methodName, $id)
    {
        $_method = isset($_POST['_method']) ? $_POST['_method'] : 0;
        if ($_method) {   //交给处理表单的方法选择方法来执行
            $this->formMethods($_method, $id);
        } elseif ($id > 0) {
            $this->$methodName($id);//实现传id的方法
        } else {
            $this->$methodName();//实现一般方法
        }

    }

    function formMethods($_method, $id)
    {
        //这里可以对各种表单请求进行判断和方法调用(子控制器中)
        //例如:if($_method=="ADD"){ $this->add();}
        //然后自定义add(){ code}
    }

    function auth()
    {

    }

}