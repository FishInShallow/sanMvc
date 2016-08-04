<?php
class dbConnect{
    public static function dbConn(){
        $dc=new mysqli(DATABASE_URL,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);
        $dc->set_charset('utf8');
        return $dc;
    }
}
