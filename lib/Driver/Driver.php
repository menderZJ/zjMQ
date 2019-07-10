<?php
/**
 * Created by ZJ.Mender.yang
 * User: ZJ
 * Date: 2019-07-08
 * Time: 20:54
 * Version:1.0
 * License under MIT.
 */

/**
 * 整合封装为统一的调用方法
 */
namespace Driver;

use \Config\Config;
use \Driver\IniFile;
use \Driver\MySql;
use \Driver\Dom;
use  \Driver\JsonFile;
use \Driver\Redis;

class Driver
{
    /**
     * @var 配置文件
     */
    protected $config;

    /**
     * @var null 操作器
     */
    protected $handle=null;

    /**
     * Driver constructor.
     */
    public function __construct()
    {
        $this->config=Config::$base_on;
        $handle=new $this->config();

 /*       switch ($this->config){
            case 'iniFile':
                $handle=new IniFile();
                berak;
            case  'jsonFile':
                $handle=new JsonFile();
                break;
            case  'mysql':
                $handle=new MySql();
                break;
            case 'redis':
                 $handle=new Redis();
                break;
            case 'xml':
                $handle=new Xml();
                break;
        }*/
    }

    /**
     * @desc 压入一个元素
     * @param string $key 压入的键值
     * @param object|mixed $el 压入的元素
     */
    public function pushIn($key='',$el=null){
        return $this->handle->pushIn($key,$el);
    }

    /**
     * @desc 弹出最迫切的元素
     * @return array
     */
    public function popOut(){
        return $$this->handle->popOut();
    }

    /**
     * @desc 弹出指定$key的元素
     * @param $key
     */
    public function popByKey($key){
        return $$this->handle->popByKey();
    }

    /**
     * @return 时间线
     */
    public function getList()
    {
        return $this->getList();
    }





}