<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/8/12
 * Time: 下午8:03
 */
class configuration
{
    //配置读取
    public static function getConfig($name)
    {
        $str = file_get_contents(BASE_PATH . '/config.php');
        preg_match("/" . preg_quote($name) . "='(.*)';/", $str, $value);
        return $value[1];
    }
    //配置修改
    public static function updateConfig($name, $value)
    {
        $str = file_get_contents(BASE_PATH . '/config.php');
        $str = preg_replace("/" . preg_quote($name) . "=(.*);/", $name . "='{$value}';", $str);
        $result = file_put_contents(BASE_PATH . '/config.php', $str);
        return $result;
    }
}