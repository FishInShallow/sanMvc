<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/7/18
 * Time: 上午3:58
 */

//可以匹配下列url类型
//1. /controller
//2. /controller/id
//3. /controller/method
//4. /controller/method/id
include_once 'error_manager.php';
class route
{
    protected $n = 0;
    protected $routes = array();    //路由数组

    //添加路由
    public function addRoute($opt, $controller, $method)
    {
        $n = $this->n;
        $this->routes[$n] = array($opt, $controller, $method);  //将每组路由添加到路由数组
        $this->n++;
    }

    //分发路由
    public function distribute($opt)
    {
        $routes = $this->routes;
        $options = explode("/", $opt);  //分割url获取参数
        $isId=$options[count($options)-1];
        $id=0;
        if (count($options)<=1){    //首页:example.com/
            $model="/"; //与路由数组进行匹配,首页设置路由为 "/"
        }
        elseif ($options[count($options)-1]==''){   //不带参数且末尾为 "/" :example.com/a/b/c/
            $model=preg_replace("{/$}","",$opt);    //与没有末尾 "/" 的请求等同
        }
        elseif(preg_match("{^[0-9]*$}",$isId)==1){  //带参数:example.com/a/b/1
            $model=preg_replace("{(/[0-9]*)$}","/",$opt);   //把纯数字判断为参数进行处理,"/" 代表使用带参数的路由
            $id=$isId;
        }
        else{
            $model=$opt;    //默认情况
        }
        foreach ($routes as $route){
            if ($model==$route[0]){
                $controllerPath = $route[1];    //控制器短路径
                $methodName = $route[2];    //请求的方法名
                include_once CONTROLLERS_BASE_PATH."/{$controllerPath}.php"; //控制器完整路径
                $controllerName=preg_replace("{^.*[/$]}","",$controllerPath);   //最后一个 "/" 后为控制器类名
                new $controllerName($methodName,$id);   //调用控制器和方法,
                exit();
            }
        }
        error_manager::http_error(404); //不满足的请求处理
    }
}
