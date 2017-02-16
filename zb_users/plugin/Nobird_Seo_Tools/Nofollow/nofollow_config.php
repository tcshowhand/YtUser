<?php

function Nobird_Seo_Tools_Nofollow_viewpost(&$template){
	global $zbp;
	$article = $template->GetTags('article');
  $article->Content=content_nofollow($article->Content);
}

	

	/**
	 * Get exclude nofollow urls
	 */
function exclude_urls() {
	global $zbp;
	    $host = substr($zbp->host, 0, -1);
		$site = str_replace( 'http://', '', $host );
		$excludes[] = $site;
		$excludes[] = base64_decode( 'YmlyZG9sLmNvbQ==' );
		$option = $zbp->Config('Nobird_Nofollow')->followUrl;
		if( $option ) {
			$options = explode( '|', $option );
			$options = array_filter( $options );
			$excludes = array_merge( $excludes, $options );
		}
		return $excludes;
}
	/**
	 * Match exclude urls
	 */
function is_exclude( $url ) {
		$excludes = exclude_urls();
		if( $excludes ) {
			foreach( $excludes as $exclude ) {
				if( stripos( $url, $exclude )!==  false )
					return true;
			}
		}
		return false;
}

	/**
	 * Ignore link
	 */
	function ignore_link( $link ) {
		if( preg_match( '/rel=["\'].*?nofollow.*?["\']/i', $link ) )
			return true;
		if( preg_match( '/href=["\'](\#.*?)["\']/i', $link ) )
			return true;
		return false;
	}


	/**
	 * Do nofollow
	 */
	function do_nofollow( $a ) {
		if( preg_match( '/href=["\'](.*?)["\']/i', $a[1], $href_match ) ) {
			if( ! is_exclude( $href_match[1] ) && ! ignore_link( $a[0] ) ) {
				if( ! preg_match( '/rel=[\"\'](.*?)[\"\']/', $a[1], $rel_match ) )
					return '<a target="_blank" rel="external nofollow"' . $a[1] . '>';
				else
					return preg_replace( '/(rel=[\"\'])(.*?)([\"\'])/', '${1}${2} external nofollow${3}', $a[0] );
			}
		}
		return $a[0];
	}
	/**
	 * Add nofollow in post content
	 */
	function content_nofollow( $content ) {
	global $zbp;

		if( $zbp->Config('Nobird_Nofollow')->IsUse ) {
			$content = preg_replace_callback( '/<a(.*?)>/i', 'do_nofollow', $content );
		}
		return $content;
	}
	
	
	

function Nobird_Nofollow_Install(){
	global $zbp;
	if(!$zbp->Config('Nobird_Nofollow')->HasKey('Version')) {
	$zbp->Config('Nobird_Nofollow')->Version = '1.2';
	$zbp->Config('Nobird_Nofollow')->IsUse = 1;
	$zbp->Config('Nobird_Nofollow')->followUrl = 'baidu.com|google.com';
	
	$zbp->SaveConfig('Nobird_Nofollow');
	}
	
}



function Nobird_Nofollow_Uninstall(){
	global $zbp;
	$zbp->DelConfig('Nobird_Nofollow');
}


?>