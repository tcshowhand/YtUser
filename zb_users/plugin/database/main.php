<?php
require '../../../zb_system/function/c_system_base.php';

require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
global $total;
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('database')) {$zbp->ShowError(48);die();}
if (isset($_GET['act'])){
$act = $_GET['act'] == "" ? 'base' : $_GET['act'];
}else{
    if (isset($_GET['table'])){
        $act = "table";
        $table = $_GET['table'];
    }else{
        $act = "base";
    }
}
$blogtitle='数据库管理';
$s = "SHOW TABLE STATUS";
$dbtables = $zbp->db->Query($s);
$tablename=array();
$tableNum=count($dbtables);
foreach ($dbtables as $k => $v) {
    $dbtables[$k]['size'] = yt_format_bytes($v['Data_length'] + $v['Index_length']);
    $total += $v['Data_length'] + $v['Index_length'];
    $tables[]=$v['Name'];
}

if(count($_POST)>0){
	if(GetVars('reset','POST')=='base'){
		database_backup($tables);
	}
	if(GetVars('reset','POST')=='seo'){
		database_seo($tables);
	}
	if(GetVars('reset','POST')=='repair'){
		database_repair($tables);
	}
	Redirect('./main.php?act=base');
}
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>
<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
		<?php database_SubMenu($act);?>
		<a href="http://www.ytecn.com/" target="_blank"><span class="m-left" style="color:#F00">帮助</span></a>
    </div>
  <div id="divMain2">


  	<?php
    if ($act == 'table'){
            $s = "SHOW CREATE TABLE {$table}";
            $tmp = $zbp->db->Query($s);
            $a = $tmp[0]['Create Table'];
            $b= (strpos($a,"("));
            $c= (strpos($a,"PRIMARY"));
            $str=substr($a,$b+1,$c-$b-5); 
            $array=explode(",",$str);
            $name = explode('_',$table);
            echo $name[1].'_Table=%pre%'.$name[1].';<br>';
            echo $name[1].'_DataInfo=array(<br>';
foreach ($array as $k => $v) {
    $val = explode(' ',$v);
    $name=str_replace("`","'",$val[2]);
    $idname = explode('_',$name);
    if(strstr($val[3],'int')){
        $type='integer';
        $meta=0;
    }elseif(strstr($val[3],'string')){
        $type='string';
        $meta="''";
    }elseif(strstr($val[3],'varchar')){
        $type='varchar';
        $meta="''";
    }else{
        $type=$val[3];
        $meta="''";
    }
    if(preg_match('/\d+/',$val[3],$arr)){
        $int=$arr[0];
    }else{
        $int="''";
    }
    echo "'".$idname[1]."=>array(".$name.",'".$type."',".$int.",".$meta."),<br>";  
}
echo ");";
    ?>
    <?php
    }
	if ($act == 'base'){
	?>
<form enctype="multipart/form-data" method="post" action="main.php?act=base">
    <input id="reset" name="reset" type="hidden" value="" />
	  <p>
		<input type="submit" class="button" onclick="$('#reset').val('base');" value="批量备份" />
		<input type="submit" class="button" onclick="$('#reset').val('seo');" value="批量优化" />
		<input type="submit" class="button" onclick="$('#reset').val('repair');" value="批量修复" />
	  </p>
<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td10">数据库表</th>
	<th>记录条数</th>
	<th>占用空间</th>
	<th>编码</th>
    <th>创建时间</th>
    <th>说明</th>
    <th>操作</th>
</tr>
<?php
foreach ($dbtables as $k => $v) {
    echo '<tr>';
	echo '<td class="td15">'.$v['Name'].'</td>';
	echo '<td>'.$v['Rows'].'</td>';
	echo '<td>'.yt_format_bytes($v['Data_length']).'</td>';
	echo '<td>'.$v['Collation'].'</td>';
    echo '<td class="td20">'.$v['Create_time'].'</td>';
    echo '<td class="td10">'.$v['Comment'].'</td>';
    echo '<td class="td10"><a href="main.php?table='.$v['Name'].'" class="button">结构</a></td>';
	echo '</tr>';
}
?>
</table>
	</form>
	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/RegPage/logo.png';?>");</script>	
  </div>
  	<?php
	}
	if ($act == 'restore'){
    	$size = 0;
    	$pattern = "*.sql";
    	$filelist = glob("sqldata/".$pattern);
    	$fileArray = array();
    	foreach ($filelist  as $i => $file) {
    		//只读取文件
    		if (is_file($file)) {
    			$_size = filesize($file);
    			$size += $_size;
    			$name = basename($file);
    			$pre = substr($name, 0, strrpos($name, '_'));
    			$number = str_replace(array($pre. '_', '.sql'), array('', ''), $name);
    			$fileArray[] = array(
    				'name' => $name,
    				'pre' => $pre,
    				'time' => filemtime($file),
    				'size' => $_size,
    				'number' => $number,
    			);
    		}
    	}
    	
    	if(empty($fileArray)) $fileArray = array();
    	krsort($fileArray); //按备份时间倒序排列
    ?>
<table border="1" class="tableFull tableBorder">
<tr>
	<th class="td10">文件名称</th>
	<th>文件大小</th>
	<th>备份时间</th>
	<th>卷号</th>
    <th>操作</th>
</tr>
<?php
        foreach ($fileArray as $k => $v) {
        echo '<tr>';
	    echo '<td class="td15">'.$v['name'].'</td>';
        echo '<td>'.yt_format_bytes($v['size']).'</td>';
        echo '<td>'.date('Y-m-d H:i:s',$v['time']).'</td>';
        echo '<td>'.$v['number'].'</td>';
        echo '<td><a href="sqldata/'.$v['name'].'" class="button">下载</a></td>';
	    echo '</tr>';
        }
    ?>
</table>
    <?php
    }
	?>
</div>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>