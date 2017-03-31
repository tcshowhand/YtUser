<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action = 'root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
$objectid=trim($_POST['objectid']);
$type='post';
$object= new Post;
    global $zbp;
    $array = $zbp->Config('CustomMeta')->$type;
    if(is_array($array) == false)return null;
    if(count($array) == 0)return null;
    echo '<div id="editCustomMeta" ><div class="title">自定义作用域</div>';
    foreach ($array as $key => $value) {
        $name_meta_intro = $type . '_' . $value . '_intro';
        $name_meta_type = $type . '_' . $value . '_type';
        $name_meta_option = $type . '_' . $value . '_option';
        $name_meta_cate = $type . '_' . $value . '_cate';

        $single_meta_intro = $zbp->Config('CustomMeta')->$name_meta_intro;
        $single_meta_type = $zbp->Config('CustomMeta')->$name_meta_type;
        $single_meta_option = $zbp->Config('CustomMeta')->$name_meta_option;
        $single_meta_cate = $zbp->Config('CustomMeta')->$name_meta_cate;

        if(!$single_meta_intro)$single_meta_intro = 'Metas.' . $value;

        if(!$single_meta_type)$single_meta_type = 'text';
        if(!$single_meta_cate)$single_meta_cate = 1;
        if($single_meta_cate==$objectid){
        echo '<div class="form-group"><label  class="title" for="meta_' . $value . '">'. $single_meta_intro .'</label>';
        switch ($single_meta_type){
            case 'textarea':
                echo '<textarea id="meta_' . $value . '" name="meta_' . $value . '" >'.htmlspecialchars($object->Metas->$value).'</textarea>';
                break;
            case 'radio':
                $ar = explode('|', $single_meta_option);
                foreach ($ar as $r) {
                    echo '<label><input name="meta_' . $value . '" value="'.htmlspecialchars($r).'" type="radio" '.($object->Metas->$value == $r ? ' checked="checked"' : '').'/>'.$r.'</label> ';
                }
                echo '<label onclick="$(&quot;:radio[name=\'meta_' . $value . '\']&quot;).prop(&quot;checked&quot;, false);$(&quot;:text[name=\'meta_' . $value . '\']&quot;).prop(&quot;disabled&quot;, false);"><input type="text" name="meta_' . $value . '" value="" disabled="disabled" style="display:none;"/>【全不选】<label>';
                //echo '</p>';	
                break;
            case 'checkbox':
                $ar = explode('|', $single_meta_option);
                if(!is_array($object->Metas->$value))$object->Metas->$value = array();
                foreach ($ar as $r) {
                    echo '<label><input name="meta_' . $value . '[]" value="'.htmlspecialchars($r).'" type="checkbox" '.(in_array($r, $object->Metas->$value) ? ' checked="checked"' : '').'/>'.$r.'</label>';
                }
                echo '<label onclick="$(&quot;:checkbox[name=\'meta_' . $value . '[]\']&quot;).removeProp(&quot;checked&quot;);$(&quot;:text[name=\'meta_' . $value . '\']&quot;).prop(&quot;disabled&quot;, false);"><input type="text" name="meta_' . $value . '" value="" disabled="disabled" style="display:none;"/>【全不选】<label>';
                //echo '</p>';	
                break;
            case 'bool':
                echo '<input class="checkbox" type="text" name="meta_' . $value . '" value="'.htmlspecialchars($object->Metas->$value).'" />';
                break;
            default :
                echo '<input type="text" id="meta_' . $value . '" name="meta_' . $value . '" value="'.htmlspecialchars($object->Metas->$value).'" />';
                break;
        }
        echo '</div>';
        }
    }
    echo '</div>';
?>