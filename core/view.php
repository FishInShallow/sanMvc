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
    /**
	 * 临时消息
	 * @access public
	 * @param string $errorInfo 消息文本
	 * @param string $successInfo 消息文本
	 */
    public function withError($errorInfo)
    {
        $_SESSION['errorInfo'] = $errorInfo;
    }

    public function withSuccess($successInfo)
    {
        $_SESSION['successInfo'] = $successInfo;
    }

    /**
	 * 展示页面,支持url和php文件路径
	 * @access public
	 * @param string $url url或模板相对路径
	 * @param array $arr 模板要使用的变量数组
	 * @param boolean $cache 是否缓存页面
	 */
    public function show($url,$arr = array(),$cache=false)
    {
        if ($cache){
            $pagePath=''.STATIC_PAGES_PATH.'/'.md5($_SERVER['QUERY_STRING']).'.html';
            if(!is_file($pagePath) || (is_file($pagePath) && (time()-filemtime($pagePath))>300)){
                $this->createStaticPage($url,$arr);
            }
            require_once ''.$pagePath.'';
        }
        else{
            if (strpos($url, '.php')) {
            	if(count($arr) > 0){
	                foreach ($arr as $key => $value) {
	                    $$key = $value;
	                }
				}
                $path = VIEWS_BASE_PATH . '/' . $url;
                require_once '' . $path . '';
            }else {
                header("location:{$url}");
            }
        }
        unset($_SESSION['successInfo']);
        unset($_SESSION['errorInfo']);
        return $this;
    }

    /**
	 * 生成静态页面
	 * @access private
	 */
    private function createStaticPage($url,$arr){
        ob_start();
        if (strpos($url, ".php")) {
            foreach ($arr as $key => $value) {
                $$key = $value;
            }
            $path = VIEWS_BASE_PATH . '/' . $url;
            require_once '' . $path . '';
        } else {
            header("location:{$url}");
        }
        file_put_contents(STATIC_PAGES_PATH.'/'.md5($_SERVER['QUERY_STRING']).'.html',ob_get_clean());
        return $this;
    }
    
    /**
	 * 计算页数
	 * @access private
	 * @param int $count 数据总数
	 * @param int $lines 每页条数
	 */
    private function totalPage($count,$lines){
        if ($count<$line){
            $totalPage=1;
        }
        elseif($count%$line){
            $totalPage=(int)($count/$lines)+1;
        }
        else{
            $totalPage=$count/$line;
        }
        return $totalPage;
    }

    /**
	 * 分页
	 * @access public
	 * @param array $arr 要分页的数据
	 * @param int $page 页码
	 * @param int $lines 数据条数
	 */
    public function pageData($arr,$page,$lines){
    	$data=array();
        $start=($page-1)*$lines;
		$data['totalPage'] = $this -> totalPage(count($arr), $lines);
        $data['pageData']=array_slice($arr,$start,$lines);
        return $data;
    }

    /**
	 * 模糊查询
	 * @access public
	 * @param array $arr 要查询的数据
	 * @param string $name 要查询的字段
	 * @param any $value 关键字
	 */
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

    /**
	 * 分页组件
	 * @access public
	 * @param int $totalPage 总页数
	 */
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