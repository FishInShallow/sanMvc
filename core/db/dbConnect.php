<?php
class dbConnect{
    public static function dbConn(){
        $dc=new mysqli('192.168.2.100','wenwei915','wenwei915','Mydb');
        $dc->set_charset('utf8');
        return $dc;
    }
}
