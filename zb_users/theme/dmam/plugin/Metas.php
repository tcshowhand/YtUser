<?php

function dmam_Edit_3(){
	global $zbp,$article;
	if ($_GET['act'] == 'PageEdt') {
		$array = array('post_nosidebar'=>'无侧栏','post_loginview'=>'登录可见');
	} else {
		$array = array('post_copy'=>'版权开关','post_nosidebar'=>'无右侧栏','post_loginview'=>'登录可见','post_style'=>'文章列表','post_ispro_ids'=>'专题内容');
	}
	echo '<div id="dmam_Edit_3"><p class="dmam_Edit_3_title">+----+-----主题自定义参数-----+----+</p><ul>';
	foreach ($array as $key => $value) {
		if(!$value) $value = 'Metas.' . $key;
		if ($key == 'post_copy'||$key == 'post_loginview'||$key == 'post_nosidebar'){
			echo '<li><label for="'. $key .'" >' . $value . '</label><input name="meta_' . $key . '" type="text" value="'.htmlspecialchars($article->Metas->$key).'" class="checkbox"></li>';
		}elseif($key == 'post_style') {
			if ($article->Metas->$key == 'pics'){
				$selected = '<option selected="selected" value="'.$article->Metas->$key.'"> 多 图 </option>';
			}elseif ($article->Metas->$key == 'pic'){
				$selected = '<option selected="selected" value="'.$article->Metas->$key.'"> 单 图 </option>';
			}elseif ($article->Metas->$key == 'txt'){
				$selected = '<option selected="selected" value="'.$article->Metas->$key.'"> 无 图 </option>';
			}elseif ($article->Metas->$key == 'video'){
				$selected = '<option selected="selected" value="'.$article->Metas->$key.'"> 视 频 </option>';
			}elseif ($article->Metas->$key == 'pro'){
				$selected = '<option selected="selected" value="'.$article->Metas->$key.'"> 专 题 </option>';
			}else{
				$selected = '<option selected="selected"> 未设定 </option>';
			}
			echo '<li><label for="'. $key .'" >'. $value .'</label><select style="width:180px;" class="edit" size="1" name="meta_' . $key . '">'.$selected.'<option>+--------------+--------------+</option><option value="pics"> 多 图 </option><option value="pic"> 单 图 </option><option value="txt"> 无 图 </option><option value="video"> 视 频 </option><option value="pro"> 专 题 </option></select></li>';
		}else{
			echo '<li><label for="'. $key .'" >' . $value . '</label><input type="text" name="meta_' . $key . '" value="'.htmlspecialchars($article->Metas->$key).'"/></li>';
		}
	}
	echo '</ul></div>';
}

function dmam_Edit_5(){
	global $zbp,$article;
	if ($_GET['act'] == 'PageEdt') return;	
echo '<table class="dm-edit5">';
echo '    <tbody>';
echo '        <tr id="metas_thumbnail">';
echo '		<script type="text/javascript" src="'.$zbp->host.'zb_users/theme/dmam/source/ue_up.js"></script>';
echo '            <td valign="middle" align="right">';
echo '<input type="button" class="upload_button" value="添加缩略图">';
echo '            </td>';
echo '            <td valign="middle" rowspan="1" colspan="4" align="left">';
echo '<input name="meta_thumbnail" type="text" class="input_text" value="'.$article->Metas->thumbnail.'">';
echo '			</td>';
echo '            <td valign="middle" rowspan="1" align="left">';
echo '<img class="show_img" style="width:90px;height:60px;" src="'.$article->Metas->thumbnail.'">';
echo '            </td>';
echo '        </tr>';
echo '        <tr>';
echo '            <td valign="middle" align="right">';
echo '                指定缩略图';
echo '            </td>';
echo '            <td valign="middle"><input type="text" name="meta_post_style_order" value="'.htmlspecialchars($article->Metas->post_style_order).'"/></td>';
echo '            <td valign="middle" align="right">';
echo '                副标题';
echo '            </td>';
echo '            <td valign="middle"><input type="text" name="meta_post_otitle" value="'.htmlspecialchars($article->Metas->post_otitle).'"/></td>';
echo '            <td valign="middle" align="right">';
echo '                点评';
echo '            </td>';
echo '            <td valign="middle" align="left"><input type="text" name="meta_post_com" value="'.htmlspecialchars($article->Metas->post_com).'"/></td>';
echo '        </tr>';
echo '        <tr>';
echo '            <td valign="middle" align="right">';
echo '                直达链接';
echo '            </td>';
echo '            <td valign="middle" rowspan="1" colspan="2" align="left"><input type="text" name="meta_post_golink" value="'.htmlspecialchars($article->Metas->post_golink).'"/></td>';
echo '            <td valign="middle" align="right">';
echo '                来源';
echo '            </td>';
echo '            <td valign="middle" rowspan="1" colspan="2" align="left"><input type="text" name="meta_post_author" value="'.htmlspecialchars($article->Metas->post_author).'"/></td>';
echo '        </tr>';
echo '        <tr>';
echo '            <td valign="middle" align="right">';
echo '                关键词';
echo '            </td>';
echo '            <td valign="middle" rowspan="1" colspan="2" align="left"><input type="text" name="meta_post_keywords" value="'.htmlspecialchars($article->Metas->post_keywords).'"/></td>';
echo '            <td valign="middle" align="right">';
echo '                描述';
echo '            </td>';
echo '            <td valign="middle" rowspan="1" colspan="2" align="left"><textarea style="height:35px;line-height:35px;width:100%;"  name="meta_post_description" type="text">'.htmlspecialchars($article->Metas->post_description).'</textarea></td>';
echo '        </tr>';
echo '        <tr>';
echo '            <td valign="middle" align="right">';
echo '                自定义CSS';
echo '            </td>';
echo '            <td valign="middle" rowspan="1" colspan="5" align="left"><textarea style="height:35px;line-height:35px;width:100%;"  name="meta_post_css" type="text">'.htmlspecialchars($article->Metas->post_css).'</textarea></td>';
echo '        </tr>';
echo '        <tr>';
echo '            <td valign="middle" align="right">';
echo '                自定义SCRIPT';
echo '            </td>';
echo '            <td valign="middle" rowspan="1" colspan="5" align="left"><textarea style="height:35px;line-height:35px;width:100%;"  name="meta_post_script" type="text">'.htmlspecialchars($article->Metas->post_script).'</textarea></td>';
echo '        </tr>';
echo '    </tbody>';
echo '</table>';
}

function dmam_Edit_cat(){
global $zbp,$cate;
echo '<p><span class="title">关键词：</span><br><input style="width:50%" placeholder="用英文逗号 &quot;,&quot;隔开 如:博客,模版,网站 " type="text" name="meta_keywords" value="'.htmlspecialchars($cate->Metas->keywords).'"></p>';
}

function dmam_Edit_user(){
    global $zbp,$member;
/* 	$array = array('user_txqq'=>'腾讯QQ','user_txwx'=>'腾讯微信','user_xlwb'=>'新浪微博','user_txwb'=>'腾讯微博','user_alww'=>'阿里旺旺','user_renren'=>'人人');
	echo '<div class="user_metas">';
		foreach ($array as $key => $value) {
		if(!$value) $value = 'Metas.' . $key;
		if ($key == 'user_txqq') {
		$user_edit_notice = "输入QQ号码即可";
		} elseif ($key == 'user_txwx') {
		$user_edit_notice = "输入微信号码即可";
		} elseif ($key == 'user_xlwb') {
		$user_edit_notice = "输入带http://的完整网址";
		} elseif ($key == 'user_txwb') {
		$user_edit_notice = "输入带http://的完整网址";
		} elseif ($key == 'user_alww') {
		$user_edit_notice = "输入旺旺ID即可";
		} elseif ($key == 'user_renren') {
		$user_edit_notice = "输入带http://的完整网址";
		} else {
		$user_edit_notice = " ";	
		}
		if ($user_edit_notice)$user_edit_notice = ' placeholder='.$user_edit_notice.' ';
		echo '<p><span class="title">' . $value . ':</span><input id="edt'. $key .'" class="edit" size="40" name="meta_'. $key .'" '.$user_edit_notice.' type="text" value="'.htmlspecialchars($member->Metas->$key).'"></p>';
	}
	echo '</div>'; */
}
?>