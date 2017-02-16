<?php
/**
 * Z-BlogPHP static
 * @package article
 * @subpackage article.php
 */
class static_article extends nbseo_batch {

	public function get_queue() {
		global $zbp;
		$posts = $zbp->GetPostList(null, array(array('=', 'log_Status', 0)));
		foreach ($posts as $key => $value) {
			$this->set_queue('static_post_build', serialize(array($value->ID, count($posts), end($posts)->ID)));
		}
	}

	public function static_post_build($param){
		global $zbp;
		$param = unserialize($param);
		$postid = $param[0];
		$post = $zbp->GetPostByID($postid);
		$post_url = $post->Url;
		$post_url = urldecode($post_url);
		$url = str_replace($zbp->host, '', $post_url);
		$save_dir = $zbp->path . $url;
		$url = explode('/', $url);
		if(count($url) > 1){
			$exists_url = $zbp->path;
			for ($i=0; $i < (count($url)-1); $i++) {
				$exists_url .= ($url[$i].'/');
				if (!file_exists($exists_url)) {
					@mkdir($exists_url);
				}
			}
		}

		$zbp->user->ID = 0;

		ob_start();
		foreach ($GLOBALS['Filter_Plugin_Index_Begin'] as $fpname => &$fpsignal) {$fpname();}
		ViewPost($post->ID, null, false);
		foreach ($GLOBALS['Filter_Plugin_Index_End'] as $fpname => &$fpsignal) {$fpname();}
		$article_Content = ob_get_contents();
		ob_end_clean();
		if (strtoupper(substr(PHP_OS, 0,3)) === 'WIN') {
			$save_url = iconv("utf-8", "gbk",$save_dir);
		}else{
			$save_url = $save_dir;
		}
		file_put_contents($save_url, $article_Content);

		$this->output('success', '文章ID【'.$post->ID.'】重建成功！');

		if ($post->ID == $param[2]) {
			$this->static_post_build_complete($param[1]);
		}

	}

	public function static_post_build_complete($posts){
		$this->output('success', '所有文章静态页重建完成，共生成'.$posts.'篇文章！');
	}



}



/*		for($i = 0; $i <= 10000; $i += 5)
$this->set_queue('build_article', serialize(array($i, $i + 4)));
public function build_article($param) {
$config = unserialize($param);
for($i = $config[0]; $i <= $config[1]; $i++ ) {
$this->output('success', $i . '生成成功');
}
}

*/