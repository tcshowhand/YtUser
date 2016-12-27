<?php

RegisterPlugin("database","ActivePlugin_database");

function ActivePlugin_database() {
    Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu', 'database_AddMenu');
}

function database_AddMenu(&$m) {
	global $zbp;
	$m[] = MakeTopMenu("root", '数据库管理', $zbp->host . "zb_users/plugin/database/main.php?act=base", "", "topmenu_database");
}

function database_SubMenu($id){
    $arySubMenu = array(
        0 => array('数据备份', 'base', 'left', false),
        1 => array('数据还原', 'restore', 'left', false),
    );
    foreach($arySubMenu as $k => $v){
        echo '<a href="?act='.$v[1].'"><span class="m-'.$v[2].' '.($id==$v[1]?'m-now':'').'">'.$v[0].'</span></a>';
    }
}

$database_Table='%pre%yt_database';
$database_DataInfo=array(
	'ID'=>array('yt_ID','integer','',0),
	'Name'=>array('yt_InviteCode','string',50,''),
	'Level'=>array('yt_Level','integer','',5),
	'AuthorID'=>array('yt_AuthorID','integer','',0),
);

function yt_format_bytes($size, $delimiter = '') {
	$units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
	for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
	return round($size, 2) . $delimiter . $units[$i];
}

function database_backup($tables){
    global $zbp,$outstr,$time;
        function_exists('set_time_limit') && set_time_limit(0);
        $time = time();//开始时间
        $path = "sqldata/yt_".GetGuid()."_";
        $pre = "# -----------------------------------------------------------\n";
        foreach ($tables as $table) {
            $outstr.="# 表的结构 {$table} \n";
            $outstr .= "DROP TABLE IF EXISTS `{$table}`;\n";
            $s = "SHOW CREATE TABLE {$table}";
            $tmp = $zbp->db->Query($s);
            $outstr .= $tmp[0]['Create Table'] . " ;\n\n";
        }
        $sqlTable = $outstr;
        $outstr = "";
        $file_n = 1;
        $backedTable = array();
        //表中的数据
        foreach ($tables as $table) {
            $backedTable[] = $table;
            $outstr.="\n\n# 转存表中的数据：{$table} \n";
            $tableInfo = $zbp->db->Query("SHOW TABLE STATUS LIKE '{$table}'");
            $page = ceil($tableInfo[0]['Rows'] / 10000) - 1;
            for ($i = 0; $i <= $page; $i++) {
                $query = $zbp->db->Query("SELECT * FROM {$table} LIMIT " . ($i * 10000) . ", 10000");
                foreach ($query as $val) {
                    $temSql = "";
                    $tn = 0;
                    $temSql = '';
                    foreach ($val as $v) {
                        $temSql.=$tn == 0 ? "" : ",";
                        $temSql.=$v == '' ? "''" : "'{$v}'";
                        $tn++;
                    }
                    $temSql = "INSERT INTO `{$table}` VALUES ({$temSql});\n";

                    $sqlNo = "\n# Time: " . date("Y-m-d H:i:s") . "\n" .
                            "# -----------------------------------------------------------\n" .
                            "# SQLFile Label：#{$file_n}\n# -----------------------------------------------------------\n\n\n";
                       if ($file_n == 1) {
                        $sqlNo = "# Description:备份的数据表[结构]：" . implode(",", $tables) . "\n".
                                 "# Description:备份的数据表[数据]：" . implode(",", $backedTable) . $sqlNo;
                    } else {
                        $sqlNo = "# Description:备份的数据表[数据]：" . implode(",", $backedTable) . $sqlNo;
                    }

                    if (strlen($pre) + strlen($sqlNo) + strlen($sqlTable) + strlen($outstr) + strlen($temSql) > 5242880) {
                        $file = $path . $file_n . ".sql";
                        $outstr = $file_n == 1 ? $pre . $sqlNo . $sqlTable . $outstr : $pre . $sqlNo . $outstr;
                       
                        if (!file_put_contents($file, $outstr, FILE_APPEND)) {
                            print_r("备份失败");
                        }
                        $sqlTable = $outstr = "";
                        $backedTable = array();
                        $backedTable[] = $table;
                        $file_n++;
                        dump($file_n);
                        exit;
                    }
                    $outstr.=$temSql;
                }
            }
        }
        if (strlen($sqlTable . $outstr) > 0) {
            $sqlNo = "\n# Time: " . date("Y-m-d H:i:s") . "\n" .
                    "# -----------------------------------------------------------\n" .
                    "# SQLFile Label：#{$file_n}\n# -----------------------------------------------------------\n\n\n";
            if ($file_n == 1) {
                $sqlNo = "# Description:备份的数据表[结构] " . implode(",", $tables) . "\n".
                         "# Description:备份的数据表[数据] " . implode(",", $backedTable) . $sqlNo;
            } else {
                $sqlNo = "# Description:备份的数据表[数据] " . implode(",", $backedTable) . $sqlNo;
            }
            $file = $path . $file_n . ".sql";
            $outstr = $file_n == 1 ? $pre . $sqlNo . $sqlTable . $outstr : $pre . $sqlNo . $outstr;
            if (!file_put_contents($file, $outstr, FILE_APPEND)) {
                print_r("备份失败");
            }
            $file_n++;
        }
        $time = time() - $time;
        $zbp->SetHint('good',"成功备份数据表，本次备份共生成了" . ($file_n-1) . "个SQL文件。耗时：{$time} 秒");
}


function database_seo($tables) {
    global $zbp;
        foreach ($tables as $table) {
            $s = "OPTIMIZE TABLE {$table}";
            $tmp = $zbp->db->Query($s);
        }
    $zbp->SetHint('good',"优化表成功");
    }

function database_repair($tables) {
    global $zbp;
        foreach ($tables as $table) {
            $s = "REPAIR TABLE {$table}";
            $tmp = $zbp->db->Query($s);
        }
    $zbp->SetHint('good',"修复表成功");
    }
?>