<?php
/**
 * Created by ZJ.Mender.yang
 * User: ZJ
 * Date: 2019-07-08
 * Time: 20:40
 *  Version:1.0
 * License under MIT.
 */

/**
 * mySql数据库存储驱动
 */
namespace Lib\Driver;


use Config\Config;
use Lib\Model\TimeLine;

class MySql
{
    //数据库配置
    private $dbConfig;

    //数据对象
    protected $db;

    //数据表前缀
    protected $prefix;
    //TimeLine操作器
    private $handle;

    /**
     * MySql constructor.
     * todo
     */
    public function __construct()
    {

        $this->db = new \mysqli(
            Config::$mysql['host'],
            Config::$mysql['user'],
            Config::$mysql['pass'],
            Config::$mysql['schema'],
            Config::$mysql['port']
        );
        if(!is_object($this->db)){
            return false;
        }
        $this->dbConfig = Config::$mysql;

        $this->handle=new TimeLine($this->fetchAll());

    }

    /**
     * @desc 获取表中所有元素，每一行作为一个TImeLine的元素
     * @param string $sql
     * @return array|mixed
     */
    private function fetchAll($sql=''){
        if($sql==''){
            return array();
        }
        $rs=$this->db->query("select * from ".Config::$mysql['prefix'].Config::$mysql['table']."} limit");
        if($rs->num_rows>0){
            return $rs->fetch_all();
        }
        else{
            return array();
        }
    }

    /**
     * @desc 放入对象元素,时间线模型中，时间点的timestamp作为键，
     *       需要进行的操作任务（动作、行为）对象为值，请将自己的元素封装在section下面
     * @param $timeKey
     * @param $el
     * @return bool,成功返回true，失败返回false
     */
    public function pushIn($timeKey,$el){
        return $this->handle->pushIn($timeKey,$el);
    }

    /**
     * @desc 弹出最迫切的元素
     * @return array
     */
    public function popOut(){
        $el=$this->handle->popOut();
        $this->insert($el);
        return $el;
    }

    /**
     * @desc 弹出指定$key的元素
     * @param $key
     */
    public function popByKey($key){
        $el=$this->handle->popBykey($key);
        $this->insert($el);
        return $el;
    }



    /**
     * @desc 存入已处理数据表
     * @param $el
     */
    private function insert($el){
        $sql='';
        $fields='';
        $values='';
        if (count($el)>0){
            foreach ($el as $k=>$v){
                $fields.=" ".$k.", ";
                $values.=" ".$v.", ";
            }
            $sql=" insert into ".Config::$mysql['prefix'].Config::$mysql['outputTable']."（".substr($fields,1,strlen($fields)-1).")";
            return $this->db->query($sql);
        }
        else{
            return false;
        }
    }




}