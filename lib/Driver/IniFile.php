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
namespace Driver;


use \config\Config;
use Lib\Model\TimeLine;

class IniFile
{
    private $iniFilePath;
    private $handle;
    /**
     * IniFile constructor.
     */
    public function __construct()
    {
        $this->iniFilePath=Config::$iniFile;
        $iniCon=$this->getIniContent();
        $this->handle=new TimeLine($iniCon?$iniCon:array());
    }

    /**
     * @return array|bool
     */
    private function getIniContent(){
        $rt=parse_ini_file($this->iniFilePath);
        $fs=fopen($this->iniFilePath,'w+');
        if(!is_writable($fs)){//文件写操作被其他程序占用，取消读取
            return array();
        }
        flock($fs,LOCK_EX);
        fputs($fs,'');
        flock($fs,LOCK_UN);
        fclose($fs);
        /**-----以上将文件清空，清空期间，锁定文件，以免期间写入的数据丢失--**/
        return $rt;
    }
    /**
     * @desc 放入对象元素,时间线模型中，时间点的timestamp作为键，需要进行的操作任务（动作、行为）对象为值
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
        return $this->handle->popOut();
    }

    /**
     * @desc 弹出指定$key的元素
     * @param $key
     */
    public function popByKey($key){
        return $this->handle->popBykey($key);
    }

    /**
     * @return array
     */
    public function getList(){
        return $this->handle->getTimelineArr();
    }





}