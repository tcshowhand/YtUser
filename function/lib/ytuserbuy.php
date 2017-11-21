<?php
/**
 * Yuser类
 *
 * @package Z-BlogPHP
 * @subpackage ClassLib/Ytuser 类库
 */
class YtuserBuy extends Base {

    public function __construct() {
        global $zbp;
        parent::__construct($GLOBALS['YtUser_buy_Table'],$GLOBALS['YtUser_buy_DataInfo'], __CLASS__);
    }

    public function Time($s = 'Y-m-d H:i:s') {
        return date($s, (int) $this->PostTime);
    }

    public function __get($name) {
        global $zbp;
        switch ($name) {
        case 'Author':
            return $zbp->GetMemberByID($this->Post->AuthorID);
            break;
        case 'Post':
            return $zbp->GetPostByID($this->LogID);
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

    public function YtArticleByField($field, $field_value) {
        global $zbp;
        $field_table = $GLOBALS['YtUser_buy_Table'];
        $field_name = $GLOBALS['YtUser_buy_DataInfo'][$field][0];
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', $field_name, $field_value),array('=', 'buy_State', 1)), null, null, null);
        $array = null;
        $list = array();
        $array = $this->db->Query($sql);
        if (!isset($array)) {return array();}
        foreach ($array as $a) {
            $l = new YtuserBuy();
            $l->LoadInfoByAssoc($a);
            $list[] = $l;
        }
        return $list;
    }

    public function YtInfoByField($field, $field_value) {
        global $zbp;
        $field_table = $GLOBALS['YtUser_buy_Table'];
        $field_name = $GLOBALS['YtUser_buy_DataInfo'][$field][0];
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', $field_name, $field_value),array('=', 'buy_AuthorID', $zbp->user->ID)), null, null, null);
        $array = $this->db->Query($sql);
        if (count($array) > 0) {
            $this->LoadInfoByAssoc($array[0]);
            return true;
        } else {
            return false;
        }
    }

    public function YtBuyByField($field, $field_value) {
        global $zbp;
        $field_table = $GLOBALS['YtUser_buy_Table'];
        $field_name = $GLOBALS['YtUser_buy_DataInfo'][$field][0];
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', $field_name, $field_value),array('=', 'buy_AuthorID', $zbp->user->ID),array('=', 'buy_State', 1)), null, null, null);
        $array = $this->db->Query($sql);
        if (count($array) > 0) {
            $this->LoadInfoByAssoc($array[0]);
            return 1;
        } else {
            return 0;
        }
    }


    public function YtSumByField($field, $field_value) {
        global $zbp;
        $field_table = $GLOBALS['YtUser_buy_Table'];
        $field_name = $GLOBALS['YtUser_buy_DataInfo'][$field][0];
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', $field_name, $field_value),array('=', 'buy_State', 1)), null, null, null);
        $array = $this->db->Query($sql);
        if (count($array) > 0) {
            return count($array);
        } else {
            return false;
        }
    }
    
    public function GetYtuserBuyList($l,$op) {
        global $zbp;
        $field_table = $GLOBALS['YtUser_buy_Table'];
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', 'buy_AuthorID', $zbp->user->ID)), null, $l, $op);
        $array = null;
        $list = array();
        $array = $this->db->Query($sql);
        if (!isset($array)) {return array();}
        foreach ($array as $a) {
            $l = new YtuserBuy();
            $l->LoadInfoByAssoc($a);
            $list[] = $l;
        }
        return $list;
    }

}
