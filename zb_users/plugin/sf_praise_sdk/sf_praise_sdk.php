<?php

class SF_praise_sdk{

	static $tablename='%pre%sf_praise_sdk_count';
	static $tablename2='%pre%sf_praise_sdk_basecount';
	static $datainfo=array(
		'ID'=> array('praise_id','integer','',0),
		'postid'=>array('praise_post_id','integer','',0),
		'value'=>array('praise_value','integer','',0),
		'ip'=>array('praise_ip','string',255,''));

	static $datainfo2=array(
		'ID'=> array('praise_id','integer','',0),
		'postid'=>array('praise_post_id','integer','',0),
		'value1'=>array('praise_base_value1','integer','',0),
		'value2'=>array('praise_base_value2','integer','',0),
		'value3'=>array('praise_base_value3','integer','',0),
		'value4'=>array('praise_base_value4','integer','',0),
		'value5'=>array('praise_base_value5','integer','',0));
	
	public $postid;
	public $value1;
	public $value2;
	public $value3;
	public $value4;
	public $value5;
	public $check=0;

	public function checkCount($postid,$ip){
		global $zbp;
		$select=array(array('COUNT','*','cc'));
		$where=array(array("=","praise_post_id",$postid),array("=","praise_ip",$ip));
		$sql=$zbp->db->sql->Count(self::$tablename,$select,$where);
		$array=$zbp->db->Query($sql);

		if(count($array)>0){
			foreach($array as $u){
				$cc=GetValueInArray($u,'cc');
				if($cc>0){
					return true;
				}
			}
		}
		return false;
	}

	public function deleteBase($id){
		global $zbp;
		if(!isset($id)){
			return;
		}
		if(!is_numeric($id)){
			$id=(int)$id;
		}
		if($id<=0){
			return;
		}
		$sql=$zbp->db->sql->Delete(self::$tablename2,array(array('=','praise_post_id',$id)));
		$zbp->db->Delete($sql);
		$sql=$zbp->db->sql->Delete(self::$tablename,array(array('=','praise_post_id',$id)));
		$zbp->db->Delete($sql);
	}
	
	public static function findrealIp(){
		$ip=GetGuestIP();
		if (isset($_SERVER['HTTP_X_REAL_FORWARDED_FOR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$_SERVER['HTTP_X_REAL_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_REAL_FORWARDED_FOR'];
		} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		return $ip;
	}

	public function saveBase($id){
		global $zbp;
		if(!isset($id)){
			return;
		}
		if(!is_numeric($id)){
			$id=(int)$id;
		}
		if($id<=0){
			return;
		}
		$select=array(array('COUNT','*','cc'));
		$where=array(array('=', 'praise_post_id', $id));
		$sql=$zbp->db->sql->Count(self::$tablename2,$select,$where);
		$array=$zbp->db->Query($sql);
		$array=current($array);
		$cc=GetValueInArray($array,'cc');
		if($cc==0){
			$temp=$zbp->Config('sf_praise_sdk')->basevalue;
			$basearray=array();
			if(empty($temp)==false){
				$basearray=explode(",",$temp);	
			}
			$temp=$zbp->Config('sf_praise_sdk')->addvalue;
			$addarray=array();
			if(empty($temp)==false){
				$addarray=explode(",",$temp);	
			}
			$value1=$this->getValue($basearray,$addarray,0,1);
			$value2=$this->getValue($basearray,$addarray,0,2);
			$value3=$this->getValue($basearray,$addarray,0,3);
			$value4=$this->getValue($basearray,$addarray,0,4);
			$value5=$this->getValue($basearray,$addarray,0,5);
			$insert=array("praise_post_id"=>$id,"praise_base_value1"=>$value1,"praise_base_value2"=>$value2,"praise_base_value3"=>$value3,"praise_base_value4"=>$value4,"praise_base_value5"=>$value5);
			$sql=$zbp->db->sql->Insert(self::$tablename2,$insert);
			$zbp->db->Insert($sql);
		}
	}

	public function savePostCount($postid,$sf_praise_value){
		global $zbp;
		$ip=SF_praise_sdk::findrealIp();
		if(empty($ip)){
			return false;
		}
		
		$flag=$this->checkCount((int)$postid,$ip);
		if($flag==true){
			return false;
		}
		$insert=array("praise_post_id"=>(int)$postid,"praise_value"=>(int)$sf_praise_value,"praise_ip"=>$ip);
		$sql=$zbp->db->sql->Insert(self::$tablename,$insert);
		$index=$zbp->db->Insert($sql);
		if($index>0){
			return true;
		}else{
			return false;
		}
	}

	public function showInfo($array,$index=1){
		if(!isset($array)){
			return '';
		}else if(count($array)>=$index){
			if($index<1){
				return '';
			}
			return $array[$index-1];
		}else{
			return '';
		}
	}

	public function getValue($basearray,$addarray,$value,$index=1){
		if(isset($basearray) && count($basearray)>=$index  && $index>=1 ){
			if(is_numeric($basearray[$index-1])){
				$temp=(int)$basearray[$index-1];
				if($temp>=0){
					$value=$value+$temp;
				}
			}
		}
		if(isset($addarray) && count($addarray)>=$index  && $index>=1 ){
			if(is_numeric($addarray[$index-1])){
				$temp=(int)$addarray[$index-1];
				if($temp>0){
					$value=$value+rand(0,$temp);
				}
			}
		}
		return $value;
	}

	public static function findPostCount($postid){
		global $zbp;

		$sf_praise_sdk=new SF_praise_sdk();

		$sf_praise_sdk->value1=0;
		$sf_praise_sdk->value2=0;
		$sf_praise_sdk->value3=0;
		$sf_praise_sdk->value4=0;
		$sf_praise_sdk->value5=0;
		$sf_praise_sdk->postid=(int)$postid;
		$select=' count(*) as cc ,praise_value ';
		$where=array(array('=', 'praise_post_id', $sf_praise_sdk->postid), array('CUSTOM', '  1=1 GROUP BY praise_value '));
		$sql=$zbp->db->sql->Select(self::$tablename,$select,$where,'','');
		$array=$zbp->db->Query($sql);
		if(count($array)>0){
			foreach($array as $u){
				$praise_value=GetValueInArray($u,'praise_value');
				switch($praise_value){
					case 1:
						$sf_praise_sdk->value1=GetValueInArray($u,'cc');
						break;
					case 2:
						$sf_praise_sdk->value2=GetValueInArray($u,'cc');
						break;
					case 3:
						$sf_praise_sdk->value3=GetValueInArray($u,'cc');
						break;
					case 4:
						$sf_praise_sdk->value4=GetValueInArray($u,'cc');
						break;
					case 5:
						$sf_praise_sdk->value5=GetValueInArray($u,'cc');
						break;
				}
			}
		}
		
		$select='';
		$where=array(array('=', 'praise_post_id', $sf_praise_sdk->postid));
		$sql=$zbp->db->sql->Select(self::$tablename2,$select,$where,'','');
		$array=$zbp->db->Query($sql);
		if(count($array)>0){
			foreach($array as $u){
				$sf_praise_sdk->value1=$sf_praise_sdk->value1+GetValueInArray($u,'praise_base_value1');
				$sf_praise_sdk->value2=$sf_praise_sdk->value2+GetValueInArray($u,'praise_base_value2');
				$sf_praise_sdk->value3=$sf_praise_sdk->value3+GetValueInArray($u,'praise_base_value3');
				$sf_praise_sdk->value4=$sf_praise_sdk->value4+GetValueInArray($u,'praise_base_value4');
				$sf_praise_sdk->value5=$sf_praise_sdk->value5+GetValueInArray($u,'praise_base_value5');
			}
		}

		$ip=SF_praise_sdk::findrealIp();
		if(empty($ip)){
			return;
		}

		$flag=$sf_praise_sdk->checkCount($sf_praise_sdk->postid,$ip);
		if($flag==true){
			$sf_praise_sdk->check=1;
		}
		return $sf_praise_sdk;
	}
	
	public static function createDb(){
		global $zbp;
		#判断是否已创建，否则新建数据表
		if(!$zbp->db->ExistTable(self::$tablename)){
			$s = $zbp->db->sql->CreateTable(self::$tablename,self::$datainfo);
			$zbp->db->QueryMulit($s);
		}
		if(!$zbp->db->ExistTable(self::$tablename2)){
			$s = $zbp->db->sql->CreateTable(self::$tablename2,self::$datainfo2);
			$zbp->db->QueryMulit($s);
		}
	}

	public static function dropDb(){
		global $zbp;
		if($zbp->db->ExistTable(self::$tablename)){
			$s = $zbp->db->sql->DelTable(self::$tablename);
			$zbp->db->QueryMulit($s);
		}
		if($zbp->db->ExistTable(self::$tablename2)){
			$s = $zbp->db->sql->DelTable(self::$tablename2);
			$zbp->db->QueryMulit($s);
		}
	}
}


?>