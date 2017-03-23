<?php
require '../../../../zb_system/function/c_system_base.php';
$zbp->Load();

if (!$zbp->CheckRights('ArticlePst')) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin($dm_tools['name'])) {$zbp->ShowError(48);die();}

/**
 * DZ在线中文分词
 * @param $title string 进行分词的标题
 * @param $content string 进行分词的内容
 * @param $encode string API返回的数据编码
 * @return  array 得到的关键词数组
 */
$title = rawurlencode(strip_tags(GetVars('title', 'POST')));
$content = rawurlencode(strip_tags(GetVars('content', 'POST')));
$encode = 'utf-8';
$url = "http://keyword.discuz.com/related_kw.html?title=$title&content=$content&ics=utf-8&ocs=$encode";

$ajax = Network::Create();
$ajax->open('GET', $url);
$ajax->setRequestHeader('User-Agent', 'Baiduspider+(+http://www.baidu.com/search/spider.htm)');
$ajax->send();

$data = $ajax->responseText;
if(count($data) > 0) {
	$parser = xml_parser_create();
	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
	xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
	xml_parse_into_struct($parser, $data, $values, $index);
	xml_parser_free($parser);

	$kws = array();
	foreach($values as $valuearray) {
		if($valuearray['tag'] == 'kw' || $valuearray['tag'] == 'ekw') {
				$kws[] = trim($valuearray['value']);
		}
	}

	$return = '';
	if($kws) {
		foreach($kws as $kw) {
			$kw = dm_tools_autotags_chars($kw);
			$return .= $kw.',';
		}
		$return = trim($return,',');
	}
	$array=array();
	$array['result']=$return;
	echo json_encode($array);
}

function dm_tools_autotags_chars($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
		$string[$key] = dm_tools_autotags_chars($val);
		}
	} else {
		$string = str_replace(array('&', '"', '<', '>'),
		array('&amp;', '&quot;', '&lt;', '&gt;'), $string);
		if(strpos($string, '&#') !== false) {
			$string = preg_replace('/&((#(\d{3,5}|x[a-fA-F0-9]{4}));)/','&\\1', $string);
		}
	}
	return $string;
}
 