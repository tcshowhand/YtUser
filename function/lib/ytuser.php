<?php
/**
 * Yuser类
 *
 * @package Z-BlogPHP
 * @subpackage ClassLib/Ytuser 类库
 */
class Ytuser extends Base {

    public function __construct() {
        global $zbp;
        parent::__construct($GLOBALS['tysuer_Table'],$GLOBALS['tysuer_DataInfo'], __CLASS__);
    }

    public function __get($name) {
        global $zbp;
        switch ($name) {
        case 'User':
            return $zbp->GetMemberByID($this->Uid);
            break;
        default:
            return parent::__get($name);
            break;
        }
    }

    public function YtInfoByField($field, $field_value) {
        $field_table = $GLOBALS['tysuer_Table'];
        $field_name = $GLOBALS['tysuer_DataInfo'][$field][0];
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('=', $field_name, $field_value)), null, null, null);
        $array = $this->db->Query($sql);
        if (count($array) > 0) {
            $this->LoadInfoByAssoc($array[0]);
            return true;
        } else {
            return false;
        }
    }

    public function GetYtuserList($l,$op) {
        global $zbp;
        $field_table = $GLOBALS['tysuer_Table'];
        $sql = $this->db->sql->Select($field_table, array('*'), array(array('>', 'tc_isidcard', 0)), array('tc_isidcard' => 'ASC'), $l, $op);
        $array = null;
        $list = array();
        $array = $this->db->Query($sql);
        if (!isset($array)) {return array();}
        foreach ($array as $a) {
            $l = new Ytuser();
            $l->LoadInfoByAssoc($a);
            $list[] = $l;
        }
        return $list;
    }

}
