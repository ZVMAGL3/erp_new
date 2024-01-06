<?php

    // 转移reg中的公司信息到hy
    $sql = "
        INSERT INTO msc_user_hy (user_id, zhiwei_id, sys_yfzuid, SYS_GongHao,state)
        SELECT A.id, A.SYS_QuanXian, A.sys_yfzuid, A.SYS_GongHao,1
        FROM msc_user_reg AS A
        LEFT JOIN msc_user_hy AS B ON A.id = B.user_id
        WHERE B.user_id IS NULL 
            AND A.sys_yfzuid IS NOT NULL 
            AND A.sys_yfzuid <> 0 
            AND A.sys_web_shenpi = 1;
    ";

?>