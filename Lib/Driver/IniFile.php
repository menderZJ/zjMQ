<?php
/**
 * Created by ZJ.Mender.yang
 * User: ZJ
 * Date: 2019-07-08
 * Time: 20:40
 * Version:1.0
 * License under MIT.
 */

/**
 *  iniFile文件驱动程序
 *  注意，此处ini文件将按照section划分，
 *  而section名称最终又将会被抛弃，重新使用时间戳作为队列键值，
 *  并且最前的section下的内容将会被最想送出。
 *  特别注意：ini文件被读取后将会被清空。
 */
namespace Lib\Driver;


use  Config\Config;
use  Lib\Model\TimeLine;

class IniFile
{
    private $iniFilePath;
    private $handle;
    /**
     * IniFile constructor.
     */
    public function __construct()
    {
        //print("##");
        $this->iniFilePath=Config::$iniFile['input'];
        $iniCon=$this->getIniContent();
        $this->handle=new TimeLine($iniCon?$iniCon:array());
    }

    /**
     * @return array|bool
     */
    private function getIniContent(){

        if(!is_writable($this->iniFilePath)){//文件写操作被其他程序占用，取消读取
            return array();
        }
        $rt=parse_ini_file($this->iniFilePath,true);
        /**
         * 将文件清空，清空期间，锁定文件，以免期间写入的数据丢失
         */
//        $fs=fopen($this->iniFilePath,'w+b');
//        flock($fs,LOCK_EX);
//        flock($fs,LOCK_UN);
//        fclose($fs);


        return $rt;
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
        $this->write2IniDone($el);
        return $el;
    }

    /**
     * @desc 弹出指定$key的元素
     * @param $key
     */
    public function popByKey($key){
        $el=$this->handle->popBykey($key);
        $this->write2IniDone($el);
        return $el;
    }

    /**
     * @return array
     */
    public function getList(){
        return $this->handle->getTimelineArr();
    }



    public function write2IniDone($arr=[]){
        return $this->write2Ini($arr,Config::$iniFile['outputDone']);
    }





    /**
     * @desc 将数组写入ini文件
     * @param array $arr 要转存的数组
     * @param string $filePath 输出的ini文件路径
     */
    protected function write2Ini($arr=[],$filePath=''){
        //$keys1=array_keys($arr);
        $fs=fopen($filePath,'a+b');
        if(!is_writable($filePath)){return false;}
        flock($fs,LOCK_EX);
        if(count($arr)>0) {
            foreach ($arr as $k => $v) {
                fputs($fs,"[{$k}]\r\n");
                if(count($v)>0){
                    foreach ($v as $k2 => $v2){
                        fputs($fs,"{$k2}=".$v2."\r\n");
                    }
                }
            }
        }
        flock($fs,LOCK_UN);
        fclose($fs);
        return true;
    }
}