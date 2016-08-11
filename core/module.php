<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/7/17
 * Time: 下午3:58
 */
include 'db/dbConnect.php';
class module
{
    protected $tableName;

    function __construct($tableName)
    {
        $this->tableName = $tableName;  //初始化表名

    }

    //数据页数
    public function totalPage($line){
        $count=count($this->All());
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

    //完整查询
    public function All()
    {
        $tableName = $this->tableName;
        $data = array();
        $dc = dbConnect::dbConn();
        $findAllSql = "select * from $tableName ORDER BY id DESC";
        $findAll = $dc->query($findAllSql);
        if (mysqli_num_rows($findAll) > 0) {
            while ($arr = mysqli_fetch_array($findAll)) {
                $data[] = $arr;
            }
        }
        return $data;
    }

    //条件查询
    public function find($name, $value)
    {
        $tableName = $this->tableName;
        $data = array();
        $dc = dbConnect::dbConn();
        $findSql = "select * from $tableName where $name='$value' ORDER BY id DESC";
        $find = $dc->query($findSql);
        if (mysqli_num_rows($find) > 0) {
            while ($arr = mysqli_fetch_array($find)) {
                $data[] = $arr;
            }
        }
        return $data;
    }

    //单条查询
    public function findById($id)
    {
        $tableName = $this->tableName;
        $data = null;
        $dc = dbConnect::dbConn();
        $findByIdSql = "select * from $tableName where id='$id'";
        $findById = $dc->query($findByIdSql);
        if (mysqli_num_rows($findById) > 0) {
            $data = mysqli_fetch_array($findById);
        }
        return $data;
    }

    //条件删除
    public function delete($name, $value)
    {
        $tableName = $this->tableName;
        $dc = dbConnect::dbConn();
        $deleteSql = "delete from $tableName where $name='$value'";
        $delete = $dc->query($deleteSql);
        return $delete;
    }

    //更新
    public function update($data, $id)
    {
        $set = '';
        $name = array();
        $val = array();
        $tableName = $this->tableName;
        foreach ($data as $key => $value) {
            $name[] = $key;
            $val[] = $value;
        }
        for ($i = 0; $i < count($data); $i++) { //格式化为 "set key1='value1',key2='value2',..."
            if ($i < count($data) - 1) {
                $set = "$set $name[$i]='$val[$i]',";
            } else {
                $set = "$set $name[$i]='$val[$i]'";
            }
        }
        $dc = dbConnect::dbConn();
        $updateSql = "update $tableName set $set where id='$id'";
        $update = $dc->query($updateSql);
        return $update;
    }

    //插入
    public function insert($data)
    {
        $tableName = $this->tableName;
        $sql_names = '';
        $sql_values = '';
        $name = array();
        $val = array();
        foreach ($data as $key => $value) {
            $name[] = $key;
            $val[] = $value;
        }
        for ($i = 0; $i < count($data); $i++) { //格式化为 "key1,key2,..."和"value1,value2,..."
            if ($i < count($data) - 1) {
                $sql_names = $sql_names . $name[$i] . ',';
                $sql_values = "$sql_values'$val[$i]',";
            } else {
                $sql_names = $sql_names . $name[$i];
                $sql_values = "$sql_values'$val[$i]'";
            }
        }
        $dc = dbConnect::dbConn();
        $insertSql = "INSERT INTO $tableName ($sql_names) VALUES ($sql_values)";
        $insert = $dc->query($insertSql);
        return $insert;
    }

    //登陆
    public function login($user)
    {
        $tableName = $this->tableName;
        $username = $user['username'];
        $password = md5($user['password']);
        $dc = dbConnect::dbConn();
        $loginSql = "SELECT id FROM $tableName WHERE username='$username' AND password='$password'";
        $login = $dc->query($loginSql);
        if (mysqli_num_rows($login) > 0) {
            $data = mysqli_fetch_array($login);
            $login = $data['id'];
        } else {
            $login = false;
        }
        return $login;
    }

    //分页查询
    public function paginate($page, $line)
    {
        $data = array();
        $start=($page-1)*$line;
        $tableName = $this->tableName.'_desc';
        $dc = dbConnect::dbConn();
        $paginateSql = "SELECT * FROM $tableName LIMIT $start,$line";
        $paginate = $dc->query($paginateSql);
        if (mysqli_num_rows($paginate) > 0) {
            while ($arr = mysqli_fetch_array($paginate)) {
                $data[] = $arr;
            }
            return $data;
        }
        return $data;
    }
}