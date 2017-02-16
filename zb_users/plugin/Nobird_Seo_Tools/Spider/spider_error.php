<?php
require '../../../../zb_system/function/c_system_base.php';

require '../../../../zb_system/function/c_system_admin.php';

$zbp->Load();

$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}

if (!$zbp->CheckPlugin('Nobird_Seo_Tools')) {$zbp->ShowError(48);die();}

$blogtitle='蜘蛛来访查询 - 错误信息 - '.$Nobird_Plugin_Name.$Nobird_Plugin_Title;

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>

<div id="divMain">

  <div class="divHeader"><?php echo $blogtitle;?></div>
<div class="SubMenu"><?php Nobird_Seo_Tools_SubMenu();?></div>
  <div id="divMain2">
<?php
        $str = '<table width="100%" border="1" class="tableBorder" id="spider">
                <tr>
                    <th scope="col" width="5%" height="32" nowrap="nowrap">序号</th>
                    <th scope="col" width="5%">蜘蛛名称</th>
                    <th scope="col" width="5%">来路IP</th>
                    <th scope="col" width="50%">抓取链接</th>
                    <th scope="col" width="10%">抓取结果</th>
                    <th scope="col" width="15%">来访时间</th>
                </tr>';
$p=new Pagebar('{%host%}zb_users/plugin/Nobird_Seo_Tools/Spider/spider_error.php?{page=%page%}',false);
$p->PageCount=60; #$zbp->managecount // system default str
$p->PageNow=(int)GetVars('page','GET')==0?1:(int)GetVars('page','GET');
$p->PageBarCount=$zbp->pagebarcount;

        $where = 't_status<>200';
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