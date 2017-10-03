<?php
/**
 * Yuser类
 *
 * @package Z-BlogPHP
 * @subpackage ClassLib/Ytuser 类库
 */
class YtConsume extends Base {

    public function __construct() {
        global $zbp;
        parent::__construct($GLOBALS['YtConsume_Table'],$GLOBALS['YtConsume_DataInfo'], __CLASS__);
    }
    
    public function __get($name) {
        global $zbp;
        switch ($name) {
        case 'Author':
            return $zbp->GetMemberByID($this->Uid);
            break;
        case 'Post':
            return $zbp->GetPostByID($this->Pid);
            break;
        case 'Category':
            return $zbp->GetCategoryByID($this->Post->CateID);
            break;
        case 'Tags':
            return $zbp->LoadTagsByIDString($this->Post->Tag);
            break;
        default:
            return parent::__get($name);
            break;
        }
    }

    public function Time($s = 'Y-m-d H:i:s') {
        return date($s, (int) $this->Time);
    }
    
    public function GetConsumeList($l,$op) {
        global $zbp;
        $field_table = $GLOBALS['YtConsume_Table'];
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', 'cs_uid', $zbp->user->ID)), null, $l, $op);
        $array = null;
        $list = array();
        $array = $this->db->Query($sql);
        if (!isset($array)) {return array();}
        foreach ($array as $a) {
            $l = new YtConsume();
            $l->LoadInfoByAssoc($a);
            $list[] = $l;
        }
        return $list;
    }
}
