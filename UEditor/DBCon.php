<?php

class DB{
    //属性
    private $host;
    private $port;
    private $user;
    private $pass;
    private $dbname;
    private $charset;
    private $prefix;            //表前缀
    private $link;                //连接资源（连接数据库，一般会返回一个资源，所以需要定义一个link属性）

    public function __construct(){
        //初始化
        $config = include("config.php");
        $this->host = isset($config['host']) ? $config['host'] : 'localhost';
        $this->port = isset($config['port']) ? $config['port'] : '3306';
        $this->user = isset($config['username']) ? $config['username'] : '';
        $this->pass = isset($config['password']) ? $config['password'] : '';
        $this->dbname = isset($config['database']) ? $config['database'] : '';
        $this->charset = isset($config['charset']) ? $config['charset'] : 'utf8';
        $this->prefix = isset($config['prefix']) ? $config['prefix'] : '';

        //连接数据库（类是要操作数据库，因此要连接数据库）
        $this->connect();

        //设置字符集
        $this->setCharset();

        //选择数据库
        $this->setDbname();
    }

    /*
     * 连接数据库
    */
    private function connect(){
        //mysql扩展连接
//        echo $this->host . ':' . $this->port,$this->user,$this->pass;
//        die();
        $this->link = mysqli_connect($this->host ,$this->user,$this->pass,$this->dbname,$this->port);
        //判断结果
        if(!$this->link){
            echo '出现错误：<br/>';
            echo mysqli_errno($this->link) .':'. mysqli_error($this->link) . '<br/>';
            exit;
        }
    }

    /*
     * 设置字符集
    */
    private function setCharset(){
        //设置
        $this->db_query("set names {$this->charset}");
    }

    /*
     * 选择数据库
    */
    private function setDbname(){
        $this->db_query("use {$this->dbname}");
    }

    /*
     * 增加数据
     * @param1 string $sql，要执行的插入语句
     * @return boolean，成功返回是自动增长的ID，失败返回FALSE
    */
    public function db_insert($sql){
        //发送数据
        $this->db_query($sql);

        //成功返回自增ID
        return mysqli_affected_rows($this->link) ? mysqli_insert_id($this->link) : FALSE;
    }

    /*
     * 删除数据
     * @param1 string $sql，要执行的删除语句
     * @return Boolean，成功返回受影响的行数，失败返回FALSE
    */
    public function db_delete($sql){
        //发送SQL
        $this->db_query($sql);

        //判断结果
        return mysqli_affected_rows($this->link) ? mysqli_affected_rows($this->link) : FALSE;
    }

    /*
     * 更新数据
     * @param1 string $sql，要执行的更新语句
     * @return Boolean，成功返回受影响的行数，失败返回FALSE
    */
    public function db_update($sql){
        //发送SQL
        $this->db_query($sql);

        //判断结果
        return mysqli_affected_rows($this->link) ? mysqli_affected_rows($this->link) : FALSE;
    }

    /*
     * 查询：查询一条记录
     * @param1 string $sql，要查询的SQL语句
     * @return mixed，成功返回一个数组，失败返回FALSE
    */
    public function db_getRow($sql){
        //发送SQL\
        $res = $this->db_query($sql);

        //判断返回
        return mysqli_num_rows($res) ? mysqli_fetch_assoc($res) : FALSE;
    }

    /*
     * 查询：查询多条记录
     * @param1 string $sql，要查询的SQL语句
     * @return mixed，成功返回一个二维数组，失败返回FALSE
    */
    public function db_getAll($sql){
        //发送SQL
        $res = $this->db_query($sql);

        //判断返回
        if(mysqli_num_rows($res)){
            //循环遍历
            $list = array();

            //遍历
            while($row = mysqli_fetch_assoc($res)){
                $list[] = $row;
            }

            //返回
            return $list;
        }

        //返回FALSE
        return FALSE;
    }

    /*
     * mysql_query错误处理
     * @param1 string $sql，需要执行的SQL语句
     * @return mixed，只要语句不出错，全部返回
    */
    private function db_query($sql){
        //发送SQL

        $res = mysqli_query($this->link,$sql);

        //判断结果
        if(!$res){
            echo '出现错误：<br/>';
            echo mysqli_errno($this->link) .':'. mysqli_error($this->link) . '<br/>';
            exit;
        }
        //没有错误
        return $res;
    }
    //__sleep方法
    public function __sleep(){
        //返回需要保存的属性的数组
        return array('host','port','user','pass','dbname','charset','prefix');
    }

    //__wakeup方法
    public function __wakeup(){
        //连接资源
        $this->connect();
        //设置字符集和选中数据库
        $this->setCharset();
        $this->setDbname();
    }

}
?>