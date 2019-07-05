<?php
/**
 * Created by ZJ.Mender.yang
 * User: ZJ
 * Date: 2019-07-03
 * Time: 20:19
 */



    function autoload($class)
    {
        print(__DIR__ . '/' . $class . '.php');
        if (is_readable(__DIR__ . '/' . $class . '.php')) {
            include_once(__DIR__ . '/' . $class . '.php');
        }
    }
spl_autoload_register('autoload');


    $tl = new Lib\Model\TimeLine();
    for($i=1;$i<=10;$i++) {
//        $el = new Lib\Model\MQListElement();
//        $el->setFrom('MYSelf'.$i)
//            ->setData('d'.$i)
//            ->setTarget('YOU!'.$i);
//        $el='A'.$i;

//        $list->rpush($el);
        $t=new DateTime();
       // print($i."#");
        $tl->pushin($t->getTimestamp(),$i);
    }

$tl->pushin((new DateTime("2019-07-03 15:56:32"))->getTimestamp(),11);
$tl->pushin((new DateTime("2019-07-05 00:00:01"))->getTimestamp(),12);
    var_dump($tl);
    print("<hr>");
    var_dump($tl->popout());
    var_dump($tl);




