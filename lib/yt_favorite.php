<?php
/**
 * 文章收藏类
 *
 * @package Z-BlogPHP
 * @subpackage ClassLib/YtFavorite 类库
 */
class YtFavorite extends Base {

    public function __construct() {
        global $zbp;
        parent::__construct($GLOBALS['YtFavorite_Table'],$GLOBALS['YtFavorite_DataInfo'], __CLASS__);
        $this->Time = time();
    }

    public function Time($s = 'Y-m-d H:i:s') {
        return date($s, (int) $this->Time);
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


    public function YtInfoByField($field, $field_value) {
        global $zbp;
        $field_table = $GLOBALS['YtFavorite_Table'];
        $field_name = $GLOBALS['YtFavorite_DataInfo'][$field][0];
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', $field_name, $field_value),array('=', 'fa_uid', $zbp->user->ID)), null, null, null);
        $array = $this->db->Query($sql);
        if (count($array) > 0) {
            $this->LoadInfoByAssoc($array[0]);
            return true;
        } else {
            return false;
        }
    }

    public function GetFavoriteList($l,$op) {
        global $zbp;
        $field_table = $GLOBALS['YtFavorite_Table'];
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', 'fa_uid', $zbp->user->ID)), null, $l, $op);
        $array = null;
        $list = array();
        $array = $this->db->Query($sql);
        if (!isset($array)) {return array();}
        foreach ($array as $a) {
            $l = new YtFavorite();
            $l->LoadInfoByAssoc($a);
            $list[] = $l;
        }
        return $list;
    }

}
