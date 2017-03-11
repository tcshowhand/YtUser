<?php
require dirname(__FILE__) . DIRECTORY_SEPARATOR . '/source/celan.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR . '/source/confing.php';
require dirname(__FILE__) . DIRECTORY_SEPARATOR . '/source/huandeng.php';
//注册插件
RegisterPlugin("mochu","ActivePlugin_mochu");
///挂钩
function ActivePlugin_mochu() {
global $zbp;
	Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu','mochu_addleft');
	Add_Filter_Plugin('Filter_Plugin_Index_Begin','mochu_celanneirong');	
	if( $zbp->Config('mochu')->postshop=="1" ){
	Add_Filter_Plugin('Filter_Plugin_Edit_Response2','mochu_shop');
	}
	Add_Filter_Plugin('Filter_Plugin_Edit_Response5','mochu_shtu');	
	Add_Filter_Plugin('Filter_Plugin_ViewList_Template','mochu_Template');
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','mochu_Template');
	Add_Filter_Plugin('Filter_Plugin_Zbp_BuildModule','mochu_Readers');
	Add_Filter_Plugin('Filter_Plugin_Zbp_BuildModule','mochu_CacheArchive');
	Add_Filter_Plugin('Filter_Plugin_Cmd_Begin','mochu_denglufalse');
	
	}
//拦截跳转
function mochu_denglufalse(){
global $zbp;
$action = GetVars('act','GET');
if ($action=='verify'){
            if(VerifyLogin()){
                if ($zbp->user->ID>0 && GetVars('redirect','COOKIE')) {
                    Redirect(GetVars('redirect','COOKIE'));
                }
                Redirect($zbp->host);
            }else{
                Redirect($zbp->host);
            }
        }
}	
//插入数据并执行函数
function InstallPlugin_mochu(){
	global $zbp;
	mochu_shuju();
	mochu_celan();
	Mochu_CMS_CreateTable();
    mochu_dir();
	mochu_Readers();
	mochu_CacheArchive();
	
	}
	
//图片暂时存放地，以后修改
function mochu_dir(){
global $zbp;
$file_path = $zbp->usersdir.'cache/mochuimg';
if(!file_exists($file_path)){
 mkdir($file_path,0777,true);
 $zbp->SetHint('good','文件创建成功');
}
	}	
//切换主题时，删除数据	
function UninstallPlugin_mochu(){
	global $zbp;
	//删除主题配置and模块数据
	$sql1 = $zbp->db->sql->Delete($zbp->table['Module'],array(array('=','mod_Source','hotcelan')));
    $sql2 = $zbp->db->sql->Delete($zbp->table['Module'],array(array('=','mod_Source','comcelan')));
	$sql3 = $zbp->db->sql->Delete($zbp->table['Module'],array(array('=','mod_Source','newcelan')));
    $sql4 = $zbp->db->sql->Delete($zbp->table['Module'],array(array('=','mod_Source','randcelan')));
	$sql5 = $zbp->db->sql->Delete($zbp->table['Module'],array(array('=','mod_Source','tabcelan')));	
	$sql6 = $zbp->db->sql->Delete($zbp->table['Module'],array(array('=','mod_Source','newke')));
	$sql7 = $zbp->db->sql->Delete($zbp->table['Module'],array(array('=','mod_Source','newcon')));
	$sql8 = $zbp->db->sql->Delete($zbp->table['Module'],array(array('=','mod_Source','htagcelan')));
	$sql9 = $zbp->db->sql->Delete($zbp->table['Module'],array(array('=','mod_Source','rtagcelan')));			
	if($zbp->Config('mochu')->peizhishuju){
	$zbp->DelConfig('mochu');
	$zbp->db->Delete($sql1);
	$zbp->db->Delete($sql2);
	$zbp->db->Delete($sql3);
	$zbp->db->Delete($sql4);
	$zbp->db->Delete($sql5);
	$zbp->db->Delete($sql6);
	$zbp->db->Delete($sql7);
	$zbp->db->Delete($sql8);
	$zbp->db->Delete($sql9);			  
	  }
	//幻灯片数据  
	if($zbp->Config('mochu')->onoffdeng)
	{$s=$zbp->db->sql->DelTable($GLOBALS['Mochu_CMS_Table']);
	$zbp->db->Delete($s);}   
	}
?>