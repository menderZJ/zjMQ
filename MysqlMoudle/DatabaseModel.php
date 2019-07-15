<?php
/**
 * Created by ZJ.Mender.yang
 * User: ZJ
 * Date: 2019-07-18
 * Time: 20:49
 */

namespace MysqlMoudle;


use \MysqlMoudle\Config;

class DatabaseModel
{
    /**
     * @var array 以表名称为键的数据表对象数组
     */
    private $dbs=array();
    /**
     * @var \mysqli 数据连接
     */
    private $db;


    /**
     * DatabaseModel constructor.
     */
    public function __construct()
    {
        $this->db = new \mysqli(
            Config::$Config['host'],
            Config::$Config['user'],
            Config::$Config['pass'],
            Config::$Config['schema'],
            Config::$Config['port']
        );
        if(!is_object($this->db)){
            return false;
        }
    }

}