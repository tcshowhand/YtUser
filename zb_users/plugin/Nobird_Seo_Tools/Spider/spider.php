<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='蜘蛛来访查询 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
if(count($_POST)>0){
	$zbp->Config('Nobird_Spider')->UseSpider = $_POST['UseSpider'];//插件是否启用

	$zbp->SaveConfig('Nobird_Spider');
	$zbp->SetHint('good','参数已保存，更新缓存后可以查看是否生效');
	Redirect('./spider.php');
}
?>

<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
<div class="SubMenu"><?php
echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Spider/spider_error.php"><span class="m-left m-now">蜘蛛抓取错误查看</span></a>';
echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Spider/output.php"><span class="m-left m-now">导出到CSV文件</span></a>';
echo '<a href="'.$bloghost.'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/Spider/clear.php"><span class="m-left m-now">清空数据</span></a>';
?></div>

<style type="text/css">
table {table-layout:fixed;}
td {white-space:nowrap;overflow:hidden;}
</style> 
  <div id="divMain2">
<form method="post">
	<table border="1" class="tableFull tableBorder">
<tr>
	<td class="td30"><p align='left'><b>是否启用蜘蛛记录功能？</b></p></td>
	<td><input type="text"  name="UseSpider" value="<?php echo $zbp->Config('Nobird_Spider')->UseSpider;?>" style="width:89%;" class="checkbox"/>对于使用静态化或者缓存插件的用户，本功能无效</td>


</td>
</tr>

</table>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	  </p>
	</form>
<?php
	$spider=GetVars('spider')?GetVars('spider'):"";
	echo '<form class="search" id="search" method="get" action="#">';
	echo '<p>' . $zbp->lang['msg']['search'] . ':&nbsp;&nbsp;蜘蛛类型 
	<select class="edit" size="1" name="spider" style="width:100px;" >
	<option value="0" '.($spider==""?"selected":"").'>全部</option>
	<option value="百度" '.($spider=="百度"?"selected":"").'>百度</option>
	<option value="谷歌" '.($spider=="谷歌"?"selected":"").'>谷歌</option>
	<option value="搜搜" '.($spider=="搜搜"?"selected":"").'>搜搜</option>
	<option value="有道" '.($spider=="有道"?"selected":"").'>有道</option>
	<option value="必应" '.($spider=="必应"?"selected":"").'>必应</option>
	<option value="搜狗" '.($spider=="搜狗"?"selected":"").'>搜狗</option>
	<option value="雅虎" '.($spider=="雅虎"?"selected":"").'>雅虎</option>
	<option value="Alexa" '.($spider=="Alexa"?"selected":"").'>Alexa</option>
	<option value="360" '.($spider=="360"?"selected":"").'>360</option>
	';

	$statusid=GetVars('status')?GetVars('status'):"";

	echo'</select>&nbsp;&nbsp;&nbsp;&nbsp;抓取结果 
	<select class="edit" size="1" name="status" style="width:160px;" >
	<option value="">全部</option> 
	<option value="200"  '.($statusid==200?"selected":"").'>200(正常)</option>
	<option value="404"  '.($statusid==404?"selected":"").'>404(页面找不到)</option>
	<option value="500"  '.($statusid==500?"selected":"").'>500(服务器内部错误)</option>
	</select>&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" class="button" value="' . $zbp->lang['msg']['submit'] . '"/> <b>插件提供的http状态仅供参考</b></p>';
	echo '</form>';


        $str = '<table width="100%" border="1" class="tableBorder" id="spider">
                <tr>
                    <th scope="col" width="5%" height="32" nowrap="nowrap">序号</th>
                    <th scope="col" width="5%">蜘蛛名称</th>
                    <th scope="col" width="10%">来路IP</th>
                    <th scope="col" width="45%">抓取链接</th>
                    <th scope="col" width="10%">抓取结果</th>
                    <th scope="col" width="15%">来访时间</th>
                </tr>';
$p=new Pagebar('{%host%}zb_users/plugin/Nobird_Seo_Tools/Spider/spider.php?{&page=%page%}{&spider=%spider%}{&status=%status%}',false);
$p->PageCount=60; #$zbp->managecount // system default str
$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
$p->PageBarCount=$zbp->pagebarcount;
$p->UrlRule->Rules['{%spider%}']=GetVars('spider');
$p->UrlRule->Rules['{%status%}']=GetVars('status');


    $where = array();

if(GetVars('spider')){
	$where[]=array('=','t_spidername',GetVars('spider'));
}       
if(GetVars('status')){
	$where[]=array('=','t_status',GetVars('status'));
}       

        $order = array('t_ID'=>'DESC');
        $sql= $zbp->db->sql->Select(
        $zbp->table['Nobird_Spider_Table'],
        '*',
        $where,
        $order,
	array(($p->PageNow-1) * $p->PageCount,$p->PageCount),
	array('pagebar'=>$p)
        );
        $array=$zbp->GetListType('nobird_seo_tools_spider',$sql);
        foreach ($array as $key => $spider) {
            $str .= '<tr>';
            $str .= '<td align="center">'.$spider->ID.'</td>';
            $str .= '<td>'.$spider->spidername.'</td>';
            $str .= '<td>'.$spider->spiderip.'</td>';
            $str .= '<td>'.$spider->url.'</td>';
            $str .= '<td>'.$spider->status.'</td>';
            $str .= '<td>'.date('Y-m-d H:i:s',$spider->dateline).'</td>';
            $str .= '</tr>';
        }
        $str .='</table>';



$str.=  '<p class="pagebar">';

foreach ($p->buttons as $key => $value) {
	$str.= '<a href="'. $value .'">' . $key . '</a>&nbsp;&nbsp;' ;
}

$str.=  '</p>';





        echo $str;
?>




	<script type="text/javascript">ActiveLeftMenu("aPluginMng");</script>
	<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/'.$GLOBALS['Nobird_Plugin_Name'].'/logo.png';?>");</script>	
  </div>
</div>


<?php
require $blogpath . 'zb_system/admin/admin_footer.php';

RunTime();
?>