<?php
/**
 * Created by ZJ.Mender.yang
 * User: ZJ
 * Date: 2019-07-07
 * Time: 22:46
 */
date_default_timezone_set("Asia/Shanghai");
$fs = fopen('start_time.txt', 'w+');
if ($fs) {
    fputs($fs, (new DateTime())->format('Y-m-d H:i:s.u') . "\r\n");
    fclose($fs);
}

    while(1) {
        $fs = fopen('end_time.txt', 'w+');
        if ($fs) {
            fputs($fs,  (new DateTime())->format('Y-m-d H:i:s.u')."\r\n");
            fclose($fs);
            sleep(1);

         }
        else {
            break;
        }


}