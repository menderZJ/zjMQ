<?php
/**
 * Created by ZJ.Mender.yang
 * User: ZJ
 * Date: 2019-07-03
 * Time: 20:19
 */



    function autoload($class)
    {

        if (is_readable(__DIR__ . '\\' . $class . '.php')) {
            include_once(__DIR__ . '\\' .$class . '.php');
            //print(__DIR__ .'\\'. $class . '.php<hr>');
        }
    }

    spl_autoload_register('autoload');


/*    $mq = new  Lib\Driver\Driver();

    foreach($mq->getList() as $k=>$v){

    }
$mq->pushIn('123654897654656',array('id'=>'A','body'=>'xx2'));
var_dump($mq->getList());
echo("<hr>");
var_dump($mq->popByKey('123654897654656.0000000'));
var_dump($mq->getList());*/

$mm=new MysqlMoudle\Table();
echo($mm->getNextId());
echo("<hr>");
echo(rand(10000000,9999999));





