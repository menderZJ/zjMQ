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
namespace Lib\Driver;

use Config\Config;
//use Lib\Driver\IniFile;
class Driver
{
     /**
     * @var null 操作器
     */
    protected $handle=null;

    /**
     * Driver constructor.
     */
    public function __construct()
    {
        $driverClass=Config::$base_on;
       // $this->handle=eval("new {$driverClass}()");
        switch ($driverClass){
            case 'IniFile':
                $this->handle=new IniFile();
                break;
            case  'JsonFile':
                $this->handle=new JsonFile();
                break;
            case  'Mysql':
                $this->handle=new MySql();
                break;
            case 'Redis':
                $this->handle=new Redis();
                break;
            case 'Xml':
                $this->handle=new Xml();
                break;
            default:

        }


    }

    /**
     * @desc 压入一个元素
     * @param string $key 压入的键值
     * @param object|mixed $el 压入的元素
     */
    public function pushIn($key='',$el=null){
        if($key==''){
            $key=(new \DateTime())->getTimestamp();
        }
        return $this->handle->pushIn($key,$el);
    }

    /**
     * @desc 弹出最迫切的元素
     * @return array
     */
    public function popOut(){
        return $this->handle->popOut();
    }

    /**
     * @desc 弹出指定$key的元素
     * @param $key
     */
    public function popByKey($key){
        return $this->handle->popByKey();
    }

    /**
     * @return 列表
     */
    public function getList()
    {
        return $this->handle->getList();
    }





}