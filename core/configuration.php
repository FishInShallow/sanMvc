<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/8/12
 * Time: 下午8:03
 */
namespace core;
class configuration
{
    /**
	 * 配置读取
	 * @access public
	 * @param string $name 配置字段名
	 * @global array $CONFIG 自定义配置
	 */
    public static function getConfig($name='')
    {
    	global $CONFIG;
    	if($name==''){
    		return $CONFIG;
    	}elseif(isset($CONFIG[$name])){
    		return $CONFIG[$name];
    	}else{
    		return false;
    	}
    }
	
    /**
	 * 配置修改
	 * @access public
	 * @param string $name 配置字段名
	 * @param string $value 配置设定值
	 */
    public static function setConfig($name, $value)
    {
        $str = file_get_contents(BASE_PATH . '/config.php');
        $str = preg_replace("/" . $name . "'(\s*)=>(\s*)'(.*)'/", $name."'$1=>$2'{$value}'", $str);
        $result = file_put_contents(BASE_PATH . '/config.php', $str);
        return $str;
    }
}