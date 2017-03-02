<?php
//各种页面
function dmam_pages($hello){
	global $zbp;
	$s = '';
	if ($hello == 'archive'){
		if (file_exists($zbp->usersdir . 'cache/dmam_archive.txt')){
		$s=file_get_contents($zbp->usersdir . 'cache/dmam_archive.txt');
		}else{
			$s='<script type="text/javascript"> alert("博主忘了缓存文章归档了！");</script>';
		}
	}elseif ($hello == 'readers'){
		if (file_exists($zbp->usersdir . 'cache/dmam_readers.txt')){
		$s=file_get_contents($zbp->usersdir . 'cache/dmam_readers.txt');
		}else{
			$s='<script type="text/javascript"> alert("博主忘了缓存读者墙了！");</script>';
		}
	}elseif ($hello == 'tags'){
		$i = 100;
		$array = $zbp->GetTagList('','',array('tag_Count'=>'DESC'),array($i),'');
		foreach ($array as $tag) {
			$s .= '<li><a class="tagname" href="'.$tag->Url.'">'.$tag->Name.'</a><strong>×'.$tag->Count.'</strong></li>';
		}
	}else{
		$s .= '参数错误';
	}
	return $s;
}

//读者墙页面
function dmam_page_readers_cache($name){
	global $zbp;
	$num = 21;$date = 90;
	if ($name == 'page'){
		$num = $zbp->Config('dmam')->page_readers_num;
		$date = $zbp->Config('dmam')->page_readers_day;
	}elseif ($name == 'side'){
		$num = $zbp->Config('dmam')->side_readers_num;
		$date = $zbp->Config('dmam')->side_readers_day;
	}else{}
	$b =strtotime("-".$date."day");
	$e = mktime(0,0,0,date('m'),date('d')+1,date('Y'));
	$notin_mail = '';
	$notin_mail = explode('|',$zbp->Config('dmam')->notinemail);
	$notin_name = array();
	$notin_name = array('访客','admin','administrator','管理员');
	$array = $zbp->db->sql->Select(
		$zbp->table['Comment'],
		array('COUNT(comm_ID) AS cnt','comm_Name', 'comm_HomePage','comm_Email'),
		array(
			array('not in','comm_Email',$notin_mail),
			array('not in','comm_Name',$notin_name),
			array('BETWEEN', 'comm_PostTime', $b, $e),
			array('CUSTOM','1=1 GROUP BY comm_HomePage')
		),		
		array('cnt' => 'DESC'),$num,null);
	$array = $zbp->db->Query($array);
	$s = '';
	$ss = '';

	foreach ($array as $key=>$comment) {
		$i=$key+1;

		$email = $comment['comm_Email'];
		$avatarload = '<img '.dmam_islasy("avatar",ggravatar_get($email = $email, $s = null, $d = null, $r = null, $img = null, $atts = array())).' class="avatar"/>';

		$avatarurl = 'href="'.$comment['comm_HomePage'] . '" rel="external nofollow" '.dmam_isblank(true).' title="' . $comment['comm_Name'] . '(近期点评' . $comment['cnt'] . '次)"';
		
		$ss .= '<li> <a '.$avatarurl.'>'.$avatarload.'</a></li>';
		
		if($i == 1){
			$s .= '<a class="item-top item-'.$i.'" '.$avatarurl.'><h4>【金牌读者】<small>评论：' . $comment['cnt'] . '</small></h4>'.$avatarload.'<strong>' . $comment['comm_Name'] . '</strong>'.$comment['comm_HomePage'] . '</a>';
	   }
	 	elseif($i == 2){
			$s .= '<a class="item-top item-'.$i.'" '.$avatarurl.'><h4>【银牌读者】<small>评论：' . $comment['cnt'] . '</small></h4>'.$avatarload.'<strong>' . $comment['comm_Name'] . '</strong>'.$comment['comm_HomePage'] . '</a>';
	   }  
	 	elseif($i == 3){
			$s .= '<a class="item-top item-'.$i.'" '.$avatarurl.'><h4>【铜牌读者】<small>评论：' . $comment['cnt'] . '</small></h4>'.$avatarload.'<strong>' . $comment['comm_Name'] . '</strong>'.$comment['comm_HomePage'] . '</a>';
	   }     
	   else{
			$s .= '<a '.$avatarurl.'>'.$avatarload.'' . $comment['comm_Name'] . '</a>';
		}
	}
	
	if ($name == 'page'){
		$s .= '<!--您所查看的是文章归档缓存，缓存时间'.date('Y-m-d h:i:sa',time()).'-->';

		file_put_contents($zbp->usersdir . 'cache/dmam_readers.txt', $s);
		return $s;
	}
	elseif ($name == 'side'){
		return $ss;
	}
	else{
		echo '大哥，有没有搞错！';
	}
}

/* function dmam_page_archive_cache() {
	global $zbp;
	$articles = $zbp->GetArticleList(null,array(array('=', 'log_Status', 0)),array('log_PostTime' => 'DESC'),null,null,false);
	$year=0; 
	$mon=0; 
	$i=0; 
	$output = '';
	foreach ($articles as $key=>$article) {
		$si = $key+1;
		$year_tmp = (int)$article->Time('Y');
            $mon_tmp = (int)$article->Time('m');
            $y=$year; $m=$mon;
            if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></div></div></div>';
            if ($year != $year_tmp && $year > 0) $output .= '</div>';
            if ($year != $year_tmp) {
                $year = $year_tmp;
                $output .= '<h2 class="">'. $year . ' 年</h2><div class="am-panel-group" id="accordion">'; //输出年份
            }
            if ($mon != $mon_tmp) {
                $mon = $mon_tmp;
                $output .= '<div class="archives-item am-panel am-panel-default"><div class="am-panel-hd"><h2 class="am-panel-title" data-am-collapse="{parent: \'#accordion\', target: \'#do-not-say-'.$si.'\'}">' . $mon . '月</h2></div>
				<div id="do-not-say-'.$si.'" class="am-panel-collapse am-collapse '.($si==1?'am-in':'').'"><div class="am-panel-bd"><ul>'; 
            }
            $output .= '<li><time>'.$article->Time('d').'日</time><a href="'.$article->Url.'">'.$article->Title.'</a><span class="dm-muted">'.$article->CommNums.'评论</span></li>';
	}
	$output .= '</ul></div></div></div></div>';
	file_put_contents($zbp->usersdir . 'cache/dmam_archive.txt', $output);
} */


//中文月份
function dmam_GetChineseMonth($month){
$array = array('一','二','三','四','五','六','七','八','九','十','十一','十二');
return $array[$month-1];
}
//文章归档页面缓存
function dmam_page_archive_cache() {
	global $zbp;
        $sql = $zbp->db->sql->Select($zbp->table['Post'], array('log_PostTime'), null, array('log_PostTime' => 'DESC'), array(1), null);
        $array = $zbp->db->Query($sql);
        if (count($array) == 0) {return '';}
        $ldate = array(date('Y', $array[0]['log_PostTime']), date('m', $array[0]['log_PostTime']));

        $sql = $zbp->db->sql->Select($zbp->table['Post'], array('log_PostTime'), null, array('log_PostTime' => 'ASC'), array(1), null);
        $array = $zbp->db->Query($sql);
        if (count($array) == 0) {return '';}
        $fdate = array(date('Y', $array[0]['log_PostTime']), date('m', $array[0]['log_PostTime']));

        $arraydate = array();

        for ($i = $fdate[0]; $i < $ldate[0] + 1; $i++) {
            for ($j = 1; $j < 13; $j++) {
                $arraydate[] = strtotime($i . '-' . $j);
            }
        }

        foreach ($arraydate as $key => $value) {
            if ($value - strtotime($ldate[0] . '-' . $ldate[1]) > 0) {
                unset($arraydate[$key]);
            }

            if ($value - strtotime($fdate[0] . '-' . $fdate[1]) < 0) {
                unset($arraydate[$key]);
            }

        }

        $arraydate = array_reverse($arraydate);
	$s = '';
	$s .= '<div class="am-panel-group" id="accordion">';
	foreach ($arraydate as $key => $value) {
		$si = $key+1;
            $url = new UrlRule($zbp->option['ZC_DATE_REGEX']);
            $url->Rules['{%date%}'] = date('Y-n', $value);
            $url->Rules['{%year%}'] = date('Y', $value);
            $url->Rules['{%month%}'] = date('n', $value);
            $url->Rules['{%day%}'] = 1;

            $fdate = $value;
            $ldate = (strtotime(date('Y-m-t', $value)) + 60 * 60 * 24);
            $sql = $zbp->db->sql->Count($zbp->table['Post'], array(array('COUNT', '*', 'num')), array(array('=', 'log_Type', '0'), array('=', 'log_Status', '0'), array('BETWEEN', 'log_PostTime', $fdate, $ldate)));
            $n = GetValueInArrayByCurrent($zbp->db->Query($sql), 'num');
		if ($n > 0) {
		$s.='';
		$s.='<div class="archives-item am-panel am-panel-default"><div class="am-panel-hd"><h2 class="am-panel-title" data-am-collapse="{parent: \'#accordion\', target: \'#do-not-say-'.$si.'\'}">'.dmam_GetChineseMonth(date('n', $fdate)).'月 '.date('Y', $fdate).'年</h2></div>';
		$s.='<div id="do-not-say-'.$si.'" class="am-panel-collapse am-collapse '.($si==1?'am-in':'').'"><div class="am-panel-bd"><ul>';
		$order = 	array('log_PostTime'=>'DESC');
		$where = array(
          array('=','log_Status','0'),
          array('=','log_Type','0'),
          array('BETWEEN', 'log_PostTime', $fdate, $ldate)
          );
			$nbarraylist = $zbp->GetArticleList(array('*'),$where,$order,'',''); 
      foreach ($nbarraylist as $key=>$article){
      $s .= ' <li><time>'.$article->Time('d').'日</time><a href="'.$article->Url.'">'.$article->Title.'</a><span class="dm-muted">'.$article->CommNums.'评论</span></li>';
      }
		$s.='</ul></div></div></div>';
		}
	}
	$s .= '</div>';
	$s .= '<!--您所查看的是文章归档缓存，缓存时间'.date('Y-m-d h:i:sa',time()).'-->';

	file_put_contents($zbp->usersdir . 'cache/dmam_archive.txt', $s);
}
?>