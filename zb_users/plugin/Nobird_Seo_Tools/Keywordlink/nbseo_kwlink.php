<?php

/**
 *      keyword replace class
 *      Speak Chinese pls~
 */

class nbseo_kwlink {

	public static function get_keyword_link($extent) {
		global $_G;
		loadcache('relatedlink');
		$allextent = array('article' => 0, 'forum' => 1, 'group' => 2, 'blog' => 3);
		$links = array();
		if($_G['cache']['relatedlink'] && isset($allextent[$extent])) {
			foreach($_G['cache']['relatedlink'] as $link) {
				$link['extent'] = sprintf('%04b', $link['extent']);
				if($link['extent'][$allextent[$extent]] && $link['name'] && $link['url']) {
					$links[] = daddslashes($link);
				}
			}
		}
		rsort($links);
		return $links;
	}

	public static function parse_keyword_link($content, $extent) {
		global $_G;
		loadcache('relatedlink');
		$allextent = array('article' => 0, 'forum' => 1, 'group' => 2, 'blog' => 3);
		if($_G['cache']['relatedlink'] && isset($allextent[$extent])) {
			$searcharray = $replacearray = array();
			foreach($_G['cache']['relatedlink'] as $link) {
				$link['extent'] = sprintf('%04b', $link['extent']);
				if($link['extent'][$allextent[$extent]] && $link['name'] && $link['url']) {
					$searcharray[$link[name]] = '/('.preg_quote($link['name']).')/i';
					$replacearray[$link[name]] = "<a href=\"$link[url]\" target=\"_blank\" class=\"relatedlink\">$link[name]</a>";
				}
			}
			if($searcharray && $replacearray) {
				$_G['trunsform_tmp'] = array();
				$content = preg_replace("/(<script\s+.*?>.*?<\/script>)|(<a\s+.*?>.*?<\/a>)|(<img\s+.*?[\/]?>)|(\[attach\](\d+)\[\/attach\])/ies", "nbseo_kwlink::base64_transform('encode', '<keyword_link>', '\\1\\2\\3\\4', '</keyword_link>')", $content);
				$content = preg_replace($searcharray, $replacearray, $content, 1);
				$content = preg_replace("/<keyword_link>(.*?)<\/keyword_link>/ies", "nbseo_kwlink::base64_transform('decode', '', '\\1', '')", $content);
			}
		}
		return $content;
	}


	public static function base64_transform($type, $prefix, $string, $suffix) {
		global $_G;
		if($type == 'encode') {
			$_G['trunsform_tmp'][] = base64_encode(str_replace("\\\"", "\"", $string));
			return $prefix.(count($_G['trunsform_tmp']) - 1).$suffix;
		} elseif($type == 'decode') {
			return $prefix.base64_decode($_G['trunsform_tmp'][$string]).$suffix;
		}
	}
}

?>