<?php
require_once('global.php');
$ytUrl=$_SERVER['HTTP_REFERER'];
$code = $_GET['code']; 
$dsurl=$zbp->Config('YtUser')->dsurl;
$http = Network::Create();
if(!$http) throw new Exception('主机没有开启访问外部网络功能，无法开启实时推送！请联系主机服务商 或检查服务器配置！！');
$http->open('POST',"http://api.duoshuo.com/oauth2/access_token");
$http->send('code='.$code.'&client_id='.$dsurl);
$user = json_decode($http->responseText,true);
$userinfo = Network::Create();
$userinfo->open('GET',"http://api.duoshuo.com/users/profile.json?user_id=".$user['user_id']);
$userinfo->send();
$userinfo = json_decode($userinfo->responseText,true);
//打印获得的数据
if($user['user_id']>0){
            $YtdsSlide_Table='%pre%ytuser';
            $YtdsSlide_DataInfo=array(
                'id'=>array('tc_id','integer','',0),
                'uid'=>array('tc_uid','integer','',0),
                'oid'=>array('tc_oid','string',255,''),
            );
            $where = array(array('=','tc_oid',$user['user_id']));
            $sql = $zbp->db->sql->Select($YtdsSlide_Table,'*',$where,null,null,null);
            $array = $zbp->GetListCustom($YtdsSlide_Table,$YtdsSlide_DataInfo,$sql);
            if (count($array)>0) {
                $zbpuid = '';
                foreach ($array as $key => $reg) {
                    $zbpuid .= $reg->uid;
                }
                $m=$zbp->members[$zbpuid];
                if ($m->Status == ZC_MEMBER_STATUS_AUDITING) {
                $zbp->ShowError(79, __FILE__, __LINE__);
                die();
                }
                if ($m->Status == ZC_MEMBER_STATUS_LOCKED) {
                $zbp->ShowError(80, __FILE__, __LINE__);
                die();
                }
                $un=$m->Name;
                if($blogversion>131221){
                    $ps=md5($m->Password . $zbp->guid);
                }else{
                    $ps=md5($m->Password . $zbp->path);
                }
                $addinfo=array();
				$addinfo['dishtml5']=(int)GetVars('dishtml5', 'POST');
				$addinfo['chkadmin']=(int)$zbp->CheckRights('admin');
				$addinfo['chkarticle']=(int)$zbp->CheckRights('ArticleEdt');
				$addinfo['levelname']=$m->LevelName;
				$addinfo['userid']=$m->ID;
				$addinfo['useralias']=$m->StaticName;
                setcookie("username", $un,0,$zbp->cookiespath);
                setcookie("password", $ps,0,$zbp->cookiespath);
                setcookie("addinfo" . str_replace('/','',$zbp->cookiespath), json_encode($addinfo), 0, $zbp->cookiespath);
    			Redirect($ytUrl);
                die();
                }else{
            $guid=GetGuid();
            $member=new Member;
            $member->Guid=$guid;
            $member->Name="yt_".$guid;
            $member->Alias=$userinfo['response']['name'];
            $member->Password="0e681aa506fc191c5f2fa9be6abddd01";
            $member->HomePage=$userinfo['response']['url'];
            $member->Level=5;
            $member->PostTime=time();
            $member->IP=GetGuestIP();
            $member->Metas->Img="";
            $member->Save();
            $get=$member->ID;
            $get=(int)$get;
            $YtdsSlide_Table='%pre%ytuser';
            $DataArr = array(
                'tc_uid'            => $member->ID,
                'tc_oid'            => $user['user_id'],
            );
        	$sql= $zbp->db->sql->Insert($YtdsSlide_Table,$DataArr);
        	$zbp->db->Insert($sql);
                $un=$member->Name;
                if($blogversion>131221){
                    $ps=md5($member->Password . $zbp->guid);
                }else{
                    $ps=md5($member->Password . $zbp->path);
                }
                $addinfo=array();
                $addinfo['dishtml5']=(int)GetVars('dishtml5', 'POST');
                $addinfo['chkadmin']=(int)$zbp->CheckRights('admin');
                $addinfo['chkarticle']=(int)$zbp->CheckRights('ArticleEdt');
                $addinfo['levelname']=$member->LevelName;
                $addinfo['userid']=$member->ID;
                $addinfo['useralias']=$member->StaticName;
                setcookie("username", $un,0,$zbp->cookiespath);
                setcookie("password", $ps,0,$zbp->cookiespath);
                setcookie("addinfo" . str_replace('/','',$zbp->cookiespath), json_encode($addinfo), 0, $zbp->cookiespath);
                Redirect($ytUrl);
            die();
        }
}else{
    print_R($user);
    Redirect($zbp->host);
}
?>