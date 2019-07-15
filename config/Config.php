<?php
/**
 * Created by ZJ.Mender.yang
 * User: ZJ
 * Date: 2019-07-08
 * Time: 20:40
 * Version:1.0
 * License under MIT.
 */

namespace Config;


class  Config
{
    /**
     * @var string  基于何种存储结构进行调用，
     *      取值为：IniFile，JsonFile，Mysql，Redis，Xml 中一种
     */
    public  static  $base_on='IniFile';

    /**
     * @var array $iniFile 文件路径，$base_on为inifile时必需设置,可为网络路径
     */
    public static $iniFile=array(
        'input'=>'data.ini',
        'outputDone'=>'outputDone.ini'
        );

    /**
     * @var array jsonFile文件路径，$base_on为jsonfile时必需设置,可为网络路径
     */
    public static $jsonFile=array(
        'input'=>'',
        'outputDone'=>''
    );
    /**
     * @var array mysql数据库信息，$base_on为mysql时必需设置
     */
    public static $mysql=array(
        //mysql服务器地址
        'host'=>'127.0.0.1',
        //端口
        'port'=>'3306',
        //用户名
        'user'=>'root',
        //密码
        'pass'=>'123456789',
        //数据库名称
        'schema'=>'zjMQ',
        //表前缀
        'prefix'=>'zjmq_',
        //待处理数据表
        'table'=>'MQtable',
        //已处理数据表
        'outputTable'=>'outputTable'
    );
    /**
     * @var array $redis 服务器信息，$base_on为redis时必需设置
     */
    public static $redis=array(
        'host'=>'127.0.0.1',
        'port'=>'6379',
        'pass'=>'123456789'
    );

    /**
     * @var string $xml文件信息，$base_on为xml时必需设置，可为网络路径
     */
    public static $xml='';

}