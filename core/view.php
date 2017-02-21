<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/8/6
 * Time: 下午2:15
 */
namespace core;
class view
{
    //向页面发送临时消息
    public function withError($errorInfo)
    {
        session_start();
        $_SESSION['errorInfo'] = $errorInfo;
    }

    public function withSuccess($successInfo)
    {
        session_start();
        $_SESSION['successInfo'] = $successInfo;
    }

    //展示页面,支持url和php文件路径
    public function show($url, $arr = array())
    {
        //arr: 发送到页面的数据
        session_start();
        if (strpos($url, ".php")) {
            foreach ($arr as $key => $value) {
                $$key = $value;
            }
            $path = VIEWS_BASE_PATH . '/' . $url;
            require '' . $path . '';
        } else {
            header("location:{$url}");
        }
        unset($_SESSION['successInfo']);
        unset($_SESSION['errorInfo']);
        return $this;
    }
    //总页数
    public function totalPage($count,$line){
        if ($count<$line){
            $totalPage=1;
        }
        elseif($count%$line){
            $totalPage=(int)($count/$line)+1;
        }
        else{
            $totalPage=$count/$line;
        }
        return $totalPage;
    }

    //读取每页数据
    public function pageData($arr,$page,$lines){
        $start=($page-1)*$lines;
        $data=array_slice($arr,$start,$lines);
        return $data;
    }

    //模糊查询
    public function search($arr,$name,$value){
        $data=array();
        foreach ($arr as $item){
            $val=$item[$name];
            if (strpos($val,$value)!==false){
                $data[]=$item;
            }
        }
        return $data;
    }

    //分页
    public static function paginate($totalPage){
        $url=$_SERVER['PHP_SELF'];
        $url=preg_replace("{/index.php}","",$url);
        echo "<nav>";
        echo "<ul class='pagination'>";
        echo "<li><a href='{$url}?page=1' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
        $page=$_GET['page']?$_GET['page']:1;
            for ($i=1;$i<=$totalPage;$i++) {
                if ($page == $i) {
                    echo "<li class='active'><a href='{$url}?page={$i}'><span aria-hidden='true'>{$i}</span></a></li>";
                }else {
                    echo "<li><a href='{$url}?page={$i}'><span aria-hidden='true'>{$i}</span></a></li>";
                }
            }
            echo "<li><a href='{$url}?page={$totalPage}'><span aria-hidden='true'>&raquo;</span></a></li>";
        echo "</ul>";
        echo "</nav>";
    }
}