<?php
namespace core;
use mysqli;
use core\configuration;

class dbConnect{
    public static function dbConn(){
    	$url = configuration::getConfig('DATABASE_URL');
    	$user = configuration::getConfig('DATABASE_USER');
    	$pwd = configuration::getConfig('DATABASE_PASSWORD');
    	$database = configuration::getConfig('DATABASE_NAME');
		
        $dc=new mysqli($url,$user,$pwd,$database);
        $dc->set_charset('utf8');
        return $dc;
    }
}
