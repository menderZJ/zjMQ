<?php
/**
 * Created by ZJ.Mender.yang
 * User: ZJ
 * Date: 2019-07-02
 * Time: 20:25
 * Version:1.0
 * License Under MIT.
 */

namespace Lib\Model;


/**
 * Class MQList
 * @package Model
 */
class MQListElement
{
    /**
     * @var listid
     */
     protected $MQListId;
    /**
     * @var 队列元素类型
     */
    protected $ElementType;
    /**
     * @var 来源
     */
    protected $from;
    /**
     * @var string 提交方式
     */
    protected $method='POST';
    /**
     * @var 目标
     */
    protected $target;
    /**
     * @var 需提交的数据
     */
    protected $data;
    /**
     * @var bool 是否需要返回对方服务器返回的数据
     */
    protected $needCallback=false;
    /**
     * @var 返回地址
     */
    protected $callbackTarget;
    /**
     * @var 提交返回的方式
     */
    protected $callbackMethod='POST';

    /**
     * MQList constructor.     *
     */
    public function __construct()
    {
        $this->MQListId = MD5(microtime());
    }


    /**
     * @return 队列元素类型
     */
    public function getElementType()
    {
        return $this->ElementType;
    }

    /**
     * @param 队列元素类型 $ElementType
     * @return MQList
     */
    public function setElementType($ElementType)
    {
        $this->ElementType = $ElementType;
        return $this;
    }

    /**
     * @return 来源
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param 来源 $from
     * @return MQList
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return MQList
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return 目标
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param 目标 $target
     * @return MQList
     */
    public function setTarget($target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @return 需提交的数据
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param 需提交的数据 $data
     * @return MQList
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNeedCallback()
    {
        return $this->needCallback;
    }

    /**
     * @param bool $needCallback
     * @return MQList
     */
    public function setNeedCallback($needCallback)
    {
        $this->needCallback = $needCallback;
        return $this;
    }

    /**
     * @return 返回地址
     */
    public function getCallbackTarget()
    {
        return $this->callBackTarget;
    }

    /**
     * @param 返回地址 $callBackTarget
     * @return MQList
     */
    public function setCallbackTarget($callBackTarget)
    {
        $this->callBackTarget = $callBackTarget;
        return $this;
    }

    /**
     * @return 提交返回的方式
     */
    public function getCallbackMethod()
    {
        return $this->callbackMethod;
    }

    /**
     * @param 提交返回的方式 $callbackMethod
     * @return MQList
     */
    public function setCallbackMethod($callbackMethod)
    {
        $this->callbackMethod = $callbackMethod;
        return $this;
    }

}