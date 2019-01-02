<?php
/**
 * Created by PhpStorm.
 * User: vincent_mac
 * Date: 16/7/17
 * Time: 下午3:58
 */
namespace core;
use core\dbConnect;
class module
{
    protected $tableName;

    function __construct($tableName)
    {
        $this->tableName = $tableName;  //初始化表名
    }

    /**
	 * 查询所有
	 * @access public
	 */
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

    /**
	 * 条件查询
	 * @access public
	 * @param string $name 条件字段名
	 * @param string $value 条件字段值
	 */
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

    /**
	 * 单条查询
	 * @access public
	 * @param int $id 要查询的目标id
	 */
    public function findById($id)
    {
        $tableName = $this->tableName;
        $data = array();
        $dc = dbConnect::dbConn();
        $findByIdSql = "select * from $tableName where id='$id'";
        $findById = $dc->query($findByIdSql);
        if (mysqli_num_rows($findById) > 0) {
            $data = mysqli_fetch_array($findById);
        }
        return $data;
    }

    /**
	 * 条件删除
	 * @access public
	 * @param string $name 条件字段名
	 * @param string $value 条件字段值
	 */
    public function delete($name, $value)
    {
        $tableName = $this->tableName;
        $dc = dbConnect::dbConn();
        $deleteSql = "delete from $tableName where $name='$value'";
        $delete = $dc->query($deleteSql);
        return $delete;
    }

    /**
	 * 条目更新
	 * @access public
	 * @param array $data 字段-值对应数组
	 * @param int $id 要更新的条目id
	 */
    public function update($data, $id)
    {
        $set = '';
        $name = array();
        $val = array();
        $tableName = $this->tableName;
        foreach ($data as $key => $value) {
            $name[] = $key;
            if(is_string($value)){
                $value=str_replace("'","''",$value);
                $val[]="'".$value."'";
            }
            else {
                $val[] = $value;
            }
        }
        for ($i = 0; $i < count($data); $i++) { //格式化为 "set key1='value1',key2='value2',..."
            if ($i < count($data) - 1) {
                $set = $set.' '.$name[$i].'='.$val[$i].',';
            } else {
                $set = $set.' '.$name[$i].'='.$val[$i];
            }
        }
        $dc = dbConnect::dbConn();
        $updateSql = "update $tableName set $set where id='$id'";
        $update = $dc->query($updateSql);
        return $update;
    }

    /**
	 * 添加条目
	 * @access public
	 * @param array $data 字段-值对应数组
	 */
    public function insert($data)
    {
        $tableName = $this->tableName;
        $sql_names = '';
        $sql_values = '';
        $name = array();
        $val = array();
        foreach ($data as $key => $value) {
            $name[] = $key;
            if(is_string($value)){
                $value=str_replace("'","''",$value);
                $val[]="'".$value."'";
            }
            else {
                $val[] = $value;
            }
        }
        for ($i = 0; $i < count($data); $i++) { //格式化为 "key1,key2,..."和"value1,value2,..."
            if ($i < count($data) - 1) {
                $sql_names = $sql_names . $name[$i] . ',';
                $sql_values = $sql_values.$val[$i].',';
            } else {
                $sql_names = $sql_names . $name[$i];
                $sql_values = $sql_values.$val[$i];
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
        $data = array();
        $dc = dbConnect::dbConn();
        $loginSql = "select * from $tableName where username='$username' and password='$password'";
        $login = $dc->query($loginSql);
        if (mysqli_num_rows($login) > 0) {
            $data=mysqli_fetch_array($login);
        }
        return $data;
    }

}