<?php



$aaa=tianmao("http://dp.fnuo123.com/comm/getdetail.php?url=https://detail.tmall.com/item.htm?id=533177085373");

print_r($aaa);

function curl_get($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

function taobao($url) {
        $ff = curl_get($url);
        $ff = trim(mb_convert_encoding($ff, "UTF-8", "GBK"));
		$f0 = explode("class=\"attributes-list\">", $ff);
		$f0 = explode("</ul>", $f0[1]);
		$f0 = $f0[0];
		$arr[0] = "<ul class=\"attributes-list\">" . $f0 . "</ul>";
		$f1 = explode("location.protocol===", $ff);
		$f1 = explode(",", $f1[1]);
		$f1 = str_replace("'", "", $f1);
		$f1 = str_replace(":", "", $f1);
		$f1 = explode("//", $f1[0]);
		if (empty($f1[0]))
			return array();
		$f1 = "http://" . $f1[1];
        $data = substr(trim(file_get_contents($f1)), 10, -2);
		$data = mb_convert_encoding($data, "UTF-8", "GBK");
		$arr[1] = $data;
        return $arr;
}


function tianmao($url) {
        if (empty($url))
			return false;
		$url="http://dp.fnuo123.com/comm/getdetail.php?url=".urlencode($url);
        $ff = curl_get($url);

		$f0 = explode("id=\"J_AttrUL\">", $ff);
		$f0 = explode("</ul>", $f0[1]);
		$f0 = $f0[0];
		if (!empty($f0))
			$arr[0] = "<ul id=\"J_AttrUL\">" . $f0 . "</ul>";
		$f1 = explode("TShop.Setup(", $ff);
		$f1 = explode(");", $f1[1]);
		$f1 = json_decode($f1[0], true);
		if (!empty($f1['api']['descUrl'])) {
			$f1 = "http:" . $f1['api']['descUrl'];
            $data = substr(trim(file_get_contents($f1)), 10, -2);

		    $arr[1] = $data;
		}
		return $arr;
        }
?>