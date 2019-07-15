<?php
/**
 * Created by ZJ.Mender.yang
 * User: ZJ
 * Date: 2019-07-02
 * Time: 20:59
 * Version:1.0
 * License under MIT.
 */

namespace Lib\Model;

//use Lib\Model\MQListElement;

/**
 * Class MQList
 * @package Lib\Model
 */
class MQList
{
    /**
     * @var array MQ队列
     */
    protected $MQList=[];



    /**
     * MQList constructor.
     */
    public function __construct()
    {

    }

    /**
     * @desc 左压入
     * @param  $el
     */
    public function lpush($el){
       return array_unshift($this->MQList,$el);
    }

    /**
     * @desc 左弹出
     */
    public function lpop(){
        //shit只弹出值，不包含键，这里要做处理
        $rt=array(array_keys($this->MQList)[0]=>array_shift($this->MQList));
        ;
        return $rt;
    }

    /**
     * @desc 右压入
     * @param  $el
     */
    public function rpush($el){
        return array_push($this->MQList,$el);
    }

    /**
     * @desc 右弹出
     */
    public function rpop(){
        //pop不返回键，只返回值，这里要做处理
        $rt=array(array_keys($this->MQList)[$this->length()-1]=>array_pop($this->MQList));

        return $rt;

    }


    /**
     * @desc根据索引获取元素,正值从左取，负值从右取
     * @param $index
     * @return mixed|null
     */
    public function getElByIndex($index){
        $keys=array_keys($this->MQList);
        if($index>=$this->length()){
            return null;
        }
        if($index<=-$this->length()){
            return null;
        }
        if($index<0){

            return array($keys[$this->length()+$index]=>$this->MQList[$keys[$this->length()+$index]]);
        }

        return array($keys[$index]=>$this->MQList[$keys[$index]]);
    }

    /**
     * @desc 获取左起第 $index 个元素
     * @param $index
     * @return mixed|null
     */
    public function getLElByIndex($index){
        if($index<0){return null;}
        return $this->getElByIndex($index-1);
    }

    /**
     * @desc 获取右起第$index个元素
     * @param $index
     * @return mixed|null
     */
    public function getRElByIndex($index){
        if($index<0){return null;}
        return $this->getElByIndex(-$index);
    }



    /**
     * @desc 获取左起第一个元素
     * @return mixed
     */
    public function getLEl(){
        return array(array_keys($this->MQList)[0],$this->MQList[0]);
    }

    /**
     * @desc 获取右起第一个元素
     * @return mixed
     */
    public function getREl(){
        return array(array_keys($this->MQList)[$this->length()-1]=>$this->MQList[$this->length()-1]);
    }

    /**
     * @desc 返回并弹出左起$index个元素,注意
     * @param $index
     */
    public function popLEl($index){
        $keys=array_keys($this->MQList);
        switch ($index){
            case $index>$this->length():
                return null;
            case $index<0:
                return null;
            case $index==0:
                return null;
            case $index==1:
                return $this->lpop();
            case $index>1:
                $el=array($keys[$index-1]=>$this->MQList[$index-1]);
                $this->MQList=array_merge(array_slice($this->MQList,0,$index-1),array_slice($this->MQList,$index));
               return $el;
            default:
                return null;
        }

    }

    /**
     * @desc 返回并弹出右起第$index个元素,
     * @param $index
     */
    public function popREl($index){
        switch($index){
            case $index>$this->length():
                return null;
            case $index<0:
                return null;
            case $index==0:
                return null;
            case $index==1:
                return $this->rpop();
            case $index>1:
                $el=array(array_keys($this->MQList)[$this->length()-$index]=>$this->MQList[$this->length()-$index]);
                $this->MQList=array_merge(array_slice($this->MQList,0,$this->length()-$index),array_slice($this->MQList,$this->length()-$index+1));
                return $el;
        }
    }


    /**
     * @desc 获取队列长度
     * @return int
     */
    public function length(){
        return count($this->MQList);
    }

    /**
     * @desc 左起开始遍历
     * @param $fun callback Function,闭包函数或函数名称，循环到每个元素时执行的函数,
     * 有两个参数为当前遍历到的队列元素的键和值
     */
    public function loopL($fun){
        for($i=0;$i<$this->length();$i++){
            $fun(array_keys($this->MQList)[$i],$this->MQList[$i]);
        }
    }

    /**
     * @desc 右起开始遍历
     * @param $fun callback Function,闭包函数或函数名称，循环到每个元素时执行的函数，
     * 有两个参数为当前遍历到的队列元素的键和值
     */
    public function loopR($fun){
        for($i=$this->length()-1;$i>=0;$i--){
            $fun(array_keys($this->MQList)[$i],$this->MQList[$i]);
        }
    }

    /**
     * @desc 按照key重新从小到大进行排序
     * @return bool
     */
    public function sortByKey(){
        return ksort($this->MQList);
    }

    /**
     * @desc 返回弹出指定key的元素,没有键值为$key的元素时，返回null。
     * @return bool
     */
   public function popBykey($key){
       if(!array_key_exists($key,$this->MQList)){
           return null;
       }
       $tmpEl=array($key=>$this->MQList[$key]);
       $newArr=array_filter(
           $this->MQList,
           function($k) use ($key) {
               if($k<>$key) return true;
               return false;
           },
           ARRAY_FILTER_USE_KEY
       );
       $this->MQList=$newArr;
       return $tmpEl;

    }

    /**
     * 获取当前队列的键的数组
     * @return array
     */
    protected function keys(){
        return array_keys($this->MQList);

    }

}