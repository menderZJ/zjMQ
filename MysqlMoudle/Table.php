<?php
/**
 * Created by ZJ.Mender.yang
 * User: ZJ
 * Date: 2019-07-18
 * Time: 20:58
 */

namespace MysqlMoudle;


class Table
{
    /**
     * @var array 全部字段
     */
    private $columns=array();

    /**
     * @var string 表名称
     */
    private $tableName='';

    /**
     * @var string 主键名称
     */
    private $PK='';
    /**
     * @var array 外键名称和链接到的表和字段,外键字段名称作为键，对应的值为链接到的表名称为键，链接字段为值的数组
     * 形式： array(
     *              'class_id'=>array('class'=>'id')
     *            )
     */
    private $ForeinKeys=array();

    /**
     * @var array 索引数组
     * 形式： array(
     *              'index1'=>array('type'=>'id')
     *            )
     */
    private $indexs=array();


    /**
     * @desc 获取全局唯一ID，18位
     */
    public function getNextId(){
        return (new \DateTime())->getTimestamp().rand(10000000,99999999);
    }



}