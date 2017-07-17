<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='MemberMng';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('YtUser')) {$zbp->ShowError(48);die();}

$blogtitle='用户管理';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<script type="text/javascript" src="../../../zb_system/script/jquery.tagto.js"></script>
<script type="text/javascript" src="../../../zb_system/script/jquery-ui-timepicker-addon.js"></script>
<div id="divMain">
<?php 
    global $zbp;
    echo '<div class="divHeader">' . $zbp->lang['msg']['member_manage'] . '</div>';
    echo '<div class="SubMenu">';
    echo '<div class="SubMenu" style="display: block;"><a href="'.$zbp->host.'zb_system/cmd.php?act=MemberNew"><span class="m-left">新建用户</span></a><a href="'.$zbp->host.'zb_system/cmd.php?act=misc&amp;type=vrs"><span class="m-left">查看权限</span></a></div>';
    echo '</div>';
    echo '<div id="divMain2">';
    echo '<form class="search" id="search" method="post" action="#">';
    echo '<p>' . $zbp->lang['msg']['search'] . ':&nbsp;&nbsp;' . $zbp->lang['msg']['member_level'] . ' <select class="edit" size="1" name="level" style="width:90px;" ><option value="">' . $zbp->lang['msg']['any'] . '</option>';
    foreach ($zbp->lang['user_level_name'] as $id => $name) {
        echo '<option value="' . $id . '">' . $name . '</option>';
    }
    echo '</select>&nbsp;&nbsp;&nbsp;&nbsp;<input name="search" style="width:150px;" type="text" value="" /> &nbsp;&nbsp;&nbsp;&nbsp;注册时间<input type="text" name="staDateTime" id="staDateTime"  value="" style="width:140px;"/>到<input type="text" name="endDateTime" id="endDateTime"  value="" style="width:140px;"/><input type="submit" class="button" value="' . $zbp->lang['msg']['submit'] . '"/></p>';
    echo '</form>';
    $p = new Pagebar('{%host%}zb_users/plugin/YtUser/membermng.php{?page=%page%}', false);
    $p->PageCount = $zbp->managecount;
    $p->PageNow = (int) GetVars('page', 'GET') == 0 ? 1 : (int) GetVars('page', 'GET');
    $p->PageBarCount = $zbp->pagebarcount;
    $w = array();
    if (!$zbp->CheckRights('MemberAll')) {
        $w[] = array('=', 'mem_ID', $zbp->user->ID);
    }
    if (GetVars('level')) {
        $w[] = array('=', 'mem_Level', GetVars('level'));
    }
    if (GetVars('search')) {
        $w[] = array('search', 'mem_Name', 'mem_Alias', 'mem_Email', GetVars('search'));
    }

    if (GetVars('staDateTime')) {
        $w[] = array('>=', 'mem_PostTime', strtotime(GetVars('staDateTime')));
    }

    if (GetVars('endDateTime')) {
        $w[] = array('<=', 'mem_PostTime', strtotime(GetVars('endDateTime')));
    }
    $array = $zbp->GetMemberList(
        '',
        $w,
        array('mem_ID' => 'ASC'),
        array(($p->PageNow - 1) * $p->PageCount, $p->PageCount),
        array('pagebar' => $p)
    );

    echo '<table border="1" class="tableFull tableBorder tableBorder-thcenter table_hover table_striped">';
    $tables = '';
    $tableths = array();
    $tableths[] = '<tr>';
    $tableths[] = '<th>' . $zbp->lang['msg']['id'] . '</th>';
    $tableths[] = '<th>' . $zbp->lang['msg']['member_level'] . '</th>';
    $tableths[] = '<th>头像</th>';
    $tableths[] = '<th>' . $zbp->lang['msg']['name'] . '</th>';
    $tableths[] = '<th>' . $zbp->lang['msg']['alias'] . '</th>';
    $tableths[] = '<th>' . $zbp->lang['msg']['all_artiles'] . '</th>';
    $tableths[] = '<th>' . $zbp->lang['msg']['all_comments'] . '</th>';
	$tableths[] = '<th>积分</th>';
	$tableths[] = '<th>VIP</th>';
    $tableths[] = '<th>注册时间</th>';
    $tableths[] = '<th>注册ip</th>';
    $tableths[] = '<th></th>';
    $tableths[] = '</tr>';

    foreach ($array as $member) {
		$YTtable = YtUser_ReplacePre($tysuer_Table);
		$YTsql = $zbp->db->sql->Select($YTtable,'*',array(array('=','tc_uid',$member->ID)),null,null,null);
		$ytmember = $zbp->GetListCustom($YTtable,$tysuer_DataInfo,$YTsql);
		if (!isset($ytmember[0])){
			$DataArr = array(
				'tc_uid'    => $member->ID,
				'tc_oid'    => 0,
			);
			$YTsql= $zbp->db->sql->Insert($YTtable,$DataArr);
			$zbp->db->Insert($YTsql);
			$ytmember = $zbp->GetListCustom($YTtable,$tysuer_DataInfo,$YTsql);
		}
        $tabletds = array();//table string
        $tabletds[] = '<tr>';
        $tabletds[] = '<td class="td5">' . $member->ID . '</td>';
        $tabletds[] = '<td class="td8">' . $member->LevelName . ($member->Status > 0 ? '(' . $zbp->lang['user_status_name'][$member->Status] . ')' : '') . '</td>';
        $tabletds[] = '<td class="td5"><img src="'.$member->Avatar.'" width="40" /></td>';
        $tabletds[] = '<td class="td15"><a href="' . $member->Url . '" target="_blank"><img src="'.$zbp->host.'zb_system/image/admin/link.png" alt="" title="" width="16" /></a> ' . $member->Name . '</td>';
        $tabletds[] = '<td class="td15">' . $member->Alias . '</td>';
        $tabletds[] = '<td class="td8">' . $member->Articles . '</td>';
        $tabletds[] = '<td class="td8">' . $member->Comments . '</td>';
		$tabletds[] = '<td class="td8">' . $ytmember[0]->Price . '</td>';
		$tabletds[] = '<td class="td8">' . $ytmember[0]->Vipendtime . '</td>';
        $tabletds[] = '<td>' . date("Y-m-d H:i:s",$member->PostTime) . '</td>';
        $tabletds[] = '<td class="td10">' . $member->IP . '</td>';
        $tabletds[] = '<td class="td10 tdCenter">' . 
            '<a href="'.$zbp->host.'zb_system/cmd.php?act=MemberEdt&amp;id=' . $member->ID . '"><img src="'.$zbp->host.'zb_system/image/admin/user_edit.png" alt="' . $zbp->lang['msg']['edit'] . '" title="' . $zbp->lang['msg']['edit'] . '" width="16" /></a>' . 
        ( ($zbp->CheckRights('MemberDel') && ($member->IsGod !== true) )?
            '&nbsp;&nbsp;&nbsp;&nbsp;' . 
            '<a onclick="return window.confirm(\'' . $zbp->lang['msg']['confirm_operating'] . '\');" href="'.$zbp->host.'zb_system/cmd.php?act=MemberDel&amp;id=' . $member->ID . '&amp;token=' . $zbp->GetToken() . '"><img src="'.$zbp->host.'zb_system/image/admin/delete.png" alt="' . $zbp->lang['msg']['del'] . '" title="' . $zbp->lang['msg']['del'] . '" width="16" /></a>'
        :'') . 
            '</td>';

        $tabletds[] = '</tr>';
        $tables .= implode($tabletds);
    }

    echo implode($tableths) . $tables;

    echo '</table>';
    echo '<hr/><p class="pagebar">';
    foreach ($p->Buttons as $key => $value) {
        if($p->PageNow == $key)
            echo '<span class="now-page">' . $key . '</span>&nbsp;&nbsp;';
        else
            echo '<a href="' . $value . '">' . $key . '</a>&nbsp;&nbsp;';
    }
    echo '</p></div>';
    echo '<script type="text/javascript">ActiveLeftMenu("aMemberMng");</script>';
    echo '<script type="text/javascript">AddHeaderIcon("' . $zbp->host . 'zb_system/image/common/user_32.png' . '");</script>';
?>
</div>
<script type="text/javascript">
//日期时间控件
$.datepicker.regional['<?php echo $lang['lang'] ?>'] = {
  closeText: '<?php echo $lang['msg']['close'] ?>',
  prevText: '<?php echo $lang['msg']['prev_month'] ?>',
  nextText: '<?php echo $lang['msg']['next_month'] ?>',
  currentText: '<?php echo $lang['msg']['current'] ?>',
  monthNames: ['<?php echo $lang['month']['1'] ?>','<?php echo $lang['month']['2'] ?>','<?php echo $lang['month']['3'] ?>','<?php echo $lang['month']['4'] ?>','<?php echo $lang['month']['5'] ?>','<?php echo $lang['month']['6'] ?>','<?php echo $lang['month']['7'] ?>','<?php echo $lang['month']['8'] ?>','<?php echo $lang['month']['9'] ?>','<?php echo $lang['month']['10'] ?>','<?php echo $lang['month']['11'] ?>','<?php echo $lang['month']['12'] ?>'],
  monthNamesShort: ['<?php echo $lang['month_abbr']['1'] ?>','<?php echo $lang['month_abbr']['2'] ?>','<?php echo $lang['month_abbr']['3'] ?>','<?php echo $lang['month_abbr']['4'] ?>','<?php echo $lang['month_abbr']['5'] ?>','<?php echo $lang['month_abbr']['6'] ?>','<?php echo $lang['month_abbr']['7'] ?>','<?php echo $lang['month_abbr']['8'] ?>','<?php echo $lang['month_abbr']['9'] ?>','<?php echo $lang['month_abbr']['10'] ?>','<?php echo $lang['month_abbr']['11'] ?>','<?php echo $lang['month_abbr']['12'] ?>'],
  dayNames: ['<?php echo $lang['week']['7'] ?>','<?php echo $lang['week']['1'] ?>','<?php echo $lang['week']['2'] ?>','<?php echo $lang['week']['3'] ?>','<?php echo $lang['week']['4'] ?>','<?php echo $lang['week']['5'] ?>','<?php echo $lang['week']['6'] ?>'],
  dayNamesShort: ['<?php echo $lang['week_short']['7'] ?>','<?php echo $lang['week_short']['1'] ?>','<?php echo $lang['week_short']['2'] ?>','<?php echo $lang['week_short']['3'] ?>','<?php echo $lang['week_short']['4'] ?>','<?php echo $lang['week_short']['5'] ?>','<?php echo $lang['week_short']['6'] ?>'],
  dayNamesMin: ['<?php echo $lang['week_abbr']['7'] ?>','<?php echo $lang['week_abbr']['1'] ?>','<?php echo $lang['week_abbr']['2'] ?>','<?php echo $lang['week_abbr']['3'] ?>','<?php echo $lang['week_abbr']['4'] ?>','<?php echo $lang['week_abbr']['5'] ?>','<?php echo $lang['week_abbr']['6'] ?>'],
  weekHeader: '<?php echo $lang['msg']['week_suffix'] ?>',
  dateFormat: 'yy-mm-dd',
  firstDay: 1,
  isRTL: false,
  showMonthAfterYear: true,
  yearSuffix: ' <?php echo $lang['msg']['year_suffix'] ?>  '
};
$.datepicker.setDefaults($.datepicker.regional['<?php echo $lang['lang'] ?>']);
$.timepicker.regional['<?php echo $lang['lang'] ?>'] = {
  timeOnlyTitle: '<?php echo $lang['msg']['time'] ?>',
  timeText: '<?php echo $lang['msg']['time'] ?>',
  hourText: '<?php echo $lang['msg']['hour'] ?>',
  minuteText: '<?php echo $lang['msg']['minute'] ?>',
  secondText: '<?php echo $lang['msg']['second'] ?>',
  millisecText: '<?php echo $lang['msg']['millisec'] ?>',
  currentText: '<?php echo $lang['msg']['current'] ?>',
  closeText: '<?php echo $lang['msg']['close'] ?>',
  timeFormat: 'HH:mm:ss',
  ampm: false
};
$.timepicker.setDefaults($.timepicker.regional['<?php echo $lang['lang'] ?>']);
$('#staDateTime').datetimepicker({
  showSecond: true
});
$('#endDateTime').datetimepicker({
  showSecond: true
});

</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>