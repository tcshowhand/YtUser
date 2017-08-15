<?php

/**
 * 获取已上传的文件列表
 * User: Jinqn
 * Date: 14-04-09
 * Time: 上午10:17
 */
include "Uploader.class.php";

/* 判断类型 */
switch ($_GET['action']) {
    /* 列出文件 */
    case 'listfile':
        $allowFiles = $CONFIG['fileManagerAllowFiles'];
        $listSize = $CONFIG['fileManagerListSize'];
        $path = $CONFIG['fileManagerListPath'];
        $patha = $CONFIG['fileManagerListPatha'];
        $pathb = $CONFIG['fileManagerListPathb'];
        break;
    /* 列出图片 */
    case 'listimage':
    default:
        $allowFiles = $CONFIG['imageManagerAllowFiles'];
        $listSize = $CONFIG['imageManagerListSize'];
        $path = $CONFIG['imageManagerListPath'];
        $patha = $CONFIG['imageManagerListPatha'];
        $pathb = $CONFIG['imageManagerListPathb'];
}
$allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);

/* 获取参数 */
$size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
$start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
$end = $start + $size;

/* 获取文件列表 */

$files = getfiles($path, $allowFiles);
$filesa = getfiles($patha, $allowFiles);
$filesb = getfiles($pathb, $allowFiles);
$files=array_merge_recursive($files,$filesa,$filesb);

$filesm = getfiles($path, $allowFiles);
$filesma = getfiles($patha, $allowFiles);
$filesmb = getfiles($pathb, $allowFiles);
$filesm=array_merge_recursive($filesm,$filesma,$filesmb);
if (!count($files)) {
    return json_encode(array(
        "state" => "no match file",
        "list" => array(),
        "start" => $start,
        "total" => count($files)
    ));
}

$files = arr_sort($files, 'mtime', SORT_DESC);

/* 获取指定范围的列表 */
$len = count($files);
for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
    $list[] = $files[$i];
}

$list = arr_sort($list, 'mtime', SORT_DESC);

/* 返回数据 */
$result = json_encode(array(
    "state" => "SUCCESS",
    "list" => $list,
    "start" => $start,
    "total" => count($files)
));

return $result;


/**
 * 遍历获取目录下的指定类型的文件
 * @param $path
 * @param array $files
 * @return array
 */
function getfiles($path, $allowFiles, &$files = array())
{
    if (!is_dir($path)) return null;
    if(substr($path, strlen($path) - 1) != '/') $path .= '/';
    $handle = opendir($path);
    while (false !== ($file = readdir($handle))) {
        if ($file != '.' && $file != '..') {
            $path2 = $path . $file;
            if (is_dir($path2)) {
                getfiles($path2, $allowFiles, $files);
            } else {
                if (preg_match("/\.(".$allowFiles.")$/i", $file)) {
                    $files[] = array(
                        'url'=> substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
                        'mtime'=> filemtime($path2)
                    );
                }
            }
        }
    }
    return $files;
}
/**
 * 判断数组的维数
 * @param  array    $arr    要判断的数组
 * @param  array    $arr1   层数数组
 * @param  array    $level  当前层数
 * @return int              返回数组的维数
 */
function array_level($arr, &$arr1 = array(), $level = 0){
	if(is_array($arr)){
		$level++;
		$arr1[] = $level;
		foreach($arr as $val){
			array_level($val, $arr1, $level);
		}
	}else{
		$arr1[] = 0;
	}
	return max($arr1);
}
/**
 * 一维数组/二维数组排序 
 * @param  array		$arr		要排序的数组
 * @param  string(int)	$sort_key	如果数组是二维数组则代表要排序的键，如果为一维数组 0代表按值排序 1代表按键排序
 * @param  string		$sort		SORT_ASC - 按照上升顺序排序    SORT_DESC - 按照下降顺序排序（默认升序）
 * @return array		$arr		返回排序后的数组，输入的数组不正确时返回false
 */
function arr_sort($arr, $sort_key = 0, $sort = SORT_ASC){
	if(array_level($arr) == 2){
		foreach ($arr as $key=>$val){
			if(is_array($val)){ 
				$key_arr[] = $val[$sort_key];
			}else{
				return false;
			}
		}
		array_multisort($key_arr, $sort, $arr);
		return $arr; 
	}else if(array_level($arr) == 1){
		if($sort_key == 0){
			if($sort == SORT_ASC){
				asort($arr);
			}else{
				arsort($arr);
			}
		}else if($sort_key==1){
			if($sort == SORT_ASC){
				ksort($arr);
			}else{
				krsort($arr);
			}
		}
		return $arr;
	}else{
		return false;
	}
}