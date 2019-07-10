<?php
/**
 * Created by ZJ.Mender.yang
 * User: ZJ
 * Date: 2019-07-04
 * Time: 20:31
 * Version:1.0
 * License under MIT.
 */

namespace Lib\Model;

/**
 * Class TimeLine
 * @package Lib\Model
 * @desc 时间线模型，继承于MQList。在此模型中，主要执行将来要进行的任务，如定时器，延时器任务等。
 *       当有任务超时时，将优先处理已超时的任务。
 */
use DateTime;
class TimeLine extends MQList
{

    /**
     * TimeLine constructor.
     * @param array $list 初始化的队列数组，最迫切到最不迫切排好序。注意，因为要重新建立键，传入的数组将丢失键信息。
     */

    public function __construct($list=array())
    {   parent::__construct();
        if(count($list)>0){
            foreach($list as $k=>$v){
                $t=new DateTime();
                $this->pushin($t->getTimestamp(),$v);
            }
            $this->sortByKey();
        }

    }

    /**
     * @desc 放入对象元素,时间线模型中，时间点的timestamp作为键，需要进行的操作任务（动作、行为）对象为值
     * @param $timeKey
     * @param $el
     * @return bool,成功返回true，失败返回false
     */
    public  function pushIn($timeKey,$el){
        if(strpos(strval($timeKey),'.')<1){
            $timeKey=$timeKey.'.0000000';
        }
        for($i=1;$i<10000000;$i++){
            if(array_key_exists($timeKey,$this->MQList)) {
                $timeKey=bcadd(strval($timeKey),'0.0000001',7);
               continue;
            }
            break;
        }
        var_dump($timeKey."=>".$el);
            //$this->pushin($timeKey,$el);

        $this->MQList[strval($timeKey)]=$el;

        return $this->sortByKey();
    }

    /**
     * @desc 弹出并返回时间线上的指定$key的元素，主要用于定时器时使用。
     * @param $key
     * @return bool
     */
    public  function getOut($key){
      return $this->popBykey($key);
    }

    /**
     * @desc 弹出并返回一个时间线上时间最迫切的任务（时间越早的，越在前执行）
     */
    public  function popOut(){
        return $this->lpop();
    }

    /**
     * @return mixed
     */
    public  function maxKey(){
        return $this->keys()[$this->length()-1];
    }

    /**
     * @return mixed
     */
    public  function minKey(){
        return $this->keys()[0];
    }

    /**
     * @return array
     */
    public function getTimelineArr(){
        return $this->MQList;
    }


}