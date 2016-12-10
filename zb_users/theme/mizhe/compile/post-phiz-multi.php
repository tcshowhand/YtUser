<?php 
class Model {
	private $Data = array();
	function __construct($Data){
        $this->Data = $Data;
	}
	public function __set($name, $value){
		$this->Data[$name] = $value;
	}

	public function __get($name){
		return array_key_exists($name,$this->Data)?$this->Data[$name]:null;
	}
}
$zbp->SetHint("bad",base64_decode("5oKo6L+Y5rKh5pyJ6LSt5LmwWVRDTVPmj5Lku7Ys5LiA5qyh6LSt5Lmw57uI6Lqr5L2/55SoLOaEn+iwouaCqOeahOaUr+aMgS4="));
?>