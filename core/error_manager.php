<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/7/21
 * Time: 上午2:01
 */
class error_manager{
    public static function http_error($code){
        switch ($code){
            case 404:
                require './404.html';
                break;
            case 403:
                require './404.html';
        }
    }
}