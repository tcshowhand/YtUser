<?php
function YT_johndoe_SubMenu($id){
	$arySubMenu = array(
		0 => array('基本设置', 'config', 'left', false),
	);
	foreach($arySubMenu as $k => $v){
		echo '<a href="?act='.$v[1].'" '.($v[3]==true?'target="_blank"':'').'><span class="m-'.$v[2].' '.($id==$v[1]?'m-now':'').'">'.$v[0].'</span></a>';
	}
}

function YT_johndoe_pagealls($default){
global $zbp;
$articles=$zbp->GetPageList(array('*'),array(array('=','log_Type',1),array('=','log_Status',0)),10,null );
$s=null;
	foreach ($articles as $id => $article) {
	  $s.='<option ' . ($default==$article->ID?'selected="selected"':'') . ' value="'. $article->ID .'" name="gqz[]">' . $article->Title . '</option>';
	}
	return $s;
}

?>