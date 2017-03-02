<?php
$dmam_prise_Table = '%pre%dmam_prise';
$dmam_prise_DataInfo = array(
	'ID'				=>	array('ID','integer','',0),		//ID
	'UserID'			=>	array('UserID','integer','',0),   //提交的用户id
	'PostID'			=>	array('PostID','integer','',0),	//提交的文章ID
	'IP'				=>	array('IP','string',15,''),		//提交IP
);

function dmam_prise_html($postid){
	global $zbp;
	if (!$zbp->Config('dmam')->article_prise)return;
	$dmam_prise = new dmam_prise($postid);
	echo $dmam_prise->prise_button();
}


function dmam_prise_do($src_type){
	global $zbp;
	if (!$zbp->CheckPlugin('dmam')) {$zbp->ShowError(48);die();}
	$result=array();
	if($src_type == 'dmam_prise'){
		$post_id = trim($_POST['post_id']);
		$dmam_prise = new dmam_prise($post_id);
		if( $dmam_prise->prised() ){
			$result = array('status' => 300);
		}else{
			$dmam_prise->add_prise();
			$result = array('status' => 200,'count' => $dmam_prise->prise_count);
		}
	}
	if(count($result)>0){
	echo json_encode($result);
	}
}

class dmam_prise {
	private		$ip;
	public		$post_id;
	public		$user_id;
	public		$prise_count;
	public		$is_login;
	public function __construct($post_id){
		global $zbp;
		$this->ip = GetGuestIP();
		$this->post_id = $post_id;
		$this->user_id = $zbp->user->ID;
		if( $this->user_id && $this->user_id > 0 ){
			$this->is_login = true;
		}
		$this->prise_count();
	}
	public function prise_count(){
		global $zbp, $dmam_prise_Table, $dmam_prise_DataInfo;
		$sql=$zbp->db->sql->Select($dmam_prise_Table,'*',array(array('=','PostID',$this->post_id)),null,null,null);
		$array=$zbp->GetListCustom($dmam_prise_Table,$dmam_prise_DataInfo,$sql);
		$this->prise_count=count($array);
	}
	public function prised(){
		if( isset($_COOKIE['dmam_prise_id_'.$this->post_id]) ){
			return true;
		}
		global $zbp, $dmam_prise_Table, $dmam_prise_DataInfo;
		if($this->is_login){
			$DataArr = array('=','UserID',$this->user_id);
		} else{
			$DataArr = array('=','IP',$this->ip);
		}
		$sql=$zbp->db->sql->Select($dmam_prise_Table,'*',array(array('=','PostID',$this->post_id),$DataArr),null,null,null);
		$array=$zbp->GetListCustom($dmam_prise_Table,$dmam_prise_DataInfo,$sql);
		$p_check = intval(count($array));
		return $p_check && $p_check > 0;
	}
	public function add_prise(){
		global $zbp, $dmam_prise_Table;
		if(!$this->prised()){
			$DataArr = array('PostID'=>(int)$this->post_id,'UserID'=>(int)$this->user_id,'IP' => $this->ip);
			$sql= $zbp->db->sql->Insert($dmam_prise_Table,$DataArr);
			$zbp->db->Insert($sql);
			$expire = time() + 365*24*60*60;
        	setcookie('dmam_prise_id_'.$this->post_id, $this->post_id, $expire, '/', $_SERVER['HTTP_HOST'], false);
		}
		$this->prise_count();
	}
	public function prise_button(){
		$class = $this->prised()?'dmam_prise prised':'dmam_prise';
		$count = $this->prise_count?' <span>'.$this->prise_count.'</span>':'<span></span>';
		$postId = $this->post_id;
		$action = "dmam_prise('$postId')";
		$btn_html = '<a href="javascript:;" id="dmam_prise_id-%s" onclick="%s" class="am-icon-thumbs-o-up %s"> 赞一个 %s</a>';
		$button = sprintf($btn_html, $postId, $action, $class, $count);
		return $button;
	}
}
?>
