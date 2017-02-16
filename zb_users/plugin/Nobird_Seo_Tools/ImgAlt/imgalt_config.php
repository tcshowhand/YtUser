<?php

function Nobird_Seo_Tools_ImgAlt_viewpost(&$template){
	global $zbp;
	
	if ($zbp->Config('Nobird_ImgAlt')->IsUseTitle){
	$article = $template->GetTags('article');
		// Arguments
		//	$this->get_properties();			
			$num = preg_match_all( '/<img.*?>/i', $article->Content, $matches );
			
			// One image
			if( 1 == $num ) {
				
				// Get original title and alt
				preg_match( '/<img.*?title=[\"\'](.*?)[\"\'].*?>/', $article->Content, $match_title );
				$title = isset( $match_title[1] ) ? $match_title[1] : '';				
				
				// Clear title and alt
				$article->Content = preg_replace( '/(<img.*?) title=["\'].*?["\']/i', '${1}', $article->Content );
				
				// Replace
			//	$article->Content = preg_replace( '/<img/i', '<img' . ' title="' .$title.' '.$article->Title .' '.$article->Category->Name .  '" alt="' . $alt.' ' .  $article->Title.' ' .$article->Category->Name .'"', $article->Content, 1 );
			if(!$zbp->Config('Nobird_ImgAlt')->Titleappend){
						if($article->Type==0){
            $article->Content = preg_replace( '/<img/i', '<img' . ' title="'.$article->Title .' '.$article->Category->Name .  '"', $article->Content, 1 );
            }else{
            $article->Content = preg_replace( '/<img/i', '<img' . ' title="'.$article->Title .'"', $article->Content, 1 );
            }
			
			
			}else{
			
						if($article->Type==0){
            $article->Content = preg_replace( '/<img/i', '<img' . ' title="'.$title.' '.$article->Title .' '.$article->Category->Name .  '"', $article->Content, 1 );
            }else{
            $article->Content = preg_replace( '/<img/i', '<img' . ' title="'.$title.' '.$article->Title .'"', $article->Content, 1 );
            }
       }
			}
			
			// multi images add suffix
			if( 1 < $num ) {
				$temp = '*@@##@@*';
				for( $i = 1; $i <= $num; $i++ ) {
					
					// Get original title and alt
					preg_match( '/<img.*?>/', $article->Content, $match_img );
					$img = isset( $match_img[0] ) ? $match_img[0] : '';
					preg_match( '/<img.*?title=[\"\'](.*?)[\"\'].*?>/', $img, $match_title );
					$title = isset( $match_title[1] ) ? $match_title[1] : '';				
					
					// Set suffix
					$title_suffix =  title_suffix( $i ) ;
					
					// Clear title and alt
					if( $title )
						$article->Content = preg_replace( '/(<img.*?) title=["\'].*?["\']/i', '${1}', $article->Content, 1 );
					
					// Replace to temp
			//		$replace = '<' . $temp . ' title="' . $title.' ' . $article->Title .' '.$article->Category->Name  . $title_suffix . '" alt="' .  $alt.' '. $article->Title .' '.$article->Category->Name   . $alt_suffix . '"';
			
			if(!$zbp->Config('Nobird_ImgAlt')->Titleappend){
			if($article->Type==0){
					$replace = '<' . $temp . ' title="' . $article->Title .' '.$article->Category->Name  . $title_suffix . '"';					
				}else{
					$replace = '<' . $temp . ' title="' . $article->Title .' '. $title_suffix . '"';					
				}
				}else{
			if($article->Type==0){
					$replace = '<' . $temp . ' title="'.$title.' ' . $article->Title .' '.$article->Category->Name  . $title_suffix . '"';					
				}else{
					$replace = '<' . $temp . ' title="'.$title.' ' . $article->Title .' '. $title_suffix . '"';					
				}
				}
				
				
					$article->Content = preg_replace( '/<img/i', $replace, $article->Content, 1 );
				}
				
				$article->Content = str_replace( $temp, 'img', $article->Content );	
			}

}


	if ($zbp->Config('Nobird_ImgAlt')->IsUseAlt){
	$article = $template->GetTags('article');
		// Arguments
		//	$this->get_properties();			
			$num = preg_match_all( '/<img.*?>/i', $article->Content, $matches );
			
			// One image
			if( 1 == $num ) {
				
				// Get original title and alt
				preg_match( '/<img.*?alt=[\"\'](.*?)[\"\'].*?>/', $article->Content, $match_alt );
				$alt = isset( $match_alt[1] ) ? $match_alt[1] : '';
				
				// Clear title and alt
				$article->Content = preg_replace( '/(<img.*?) alt=["\'].*?["\']/i','${1}', $article->Content );				
				
				// Replace
			//	$article->Content = preg_replace( '/<img/i', '<img' . ' title="' .$title.' '.$article->Title .' '.$article->Category->Name .  '" alt="' . $alt.' ' .  $article->Title.' ' .$article->Category->Name .'"', $article->Content, 1 );
			if(!$zbp->Config('Nobird_ImgAlt')->Altappend){
						if($article->Type==0){
            $article->Content = preg_replace( '/<img/i', '<img' . ' alt="' .  $article->Title.' ' .$article->Category->Name .'"', $article->Content, 1 );
            }else{
            $article->Content = preg_replace( '/<img/i', '<img' . ' alt="' .  $article->Title.'"', $article->Content, 1 );
            }
			
			
			}else{
			
						if($article->Type==0){
            $article->Content = preg_replace( '/<img/i', '<img' . ' alt="' . $alt.' ' .  $article->Title.' ' .$article->Category->Name .'"', $article->Content, 1 );
            }else{
            $article->Content = preg_replace( '/<img/i', '<img' . ' alt="' . $alt.' ' .  $article->Title.'"', $article->Content, 1 );
            }
       }
			}
			
			// multi images add suffix
			if( 1 < $num ) {
				$temp = '*@@##@@*';
				for( $i = 1; $i <= $num; $i++ ) {
					
					// Get original title and alt
					preg_match( '/<img.*?>/', $article->Content, $match_img );
					$img = isset( $match_img[0] ) ? $match_img[0] : '';
					preg_match( '/<img.*?alt=[\"\'](.*?)[\"\'].*?>/', $img, $match_alt );
					$alt = isset( $match_alt[1] ) ? $match_alt[1] : '';			
					
					// Set suffix
					$alt_suffix =  title_suffix( $i ) ;
					
					// Clear title and alt
					if( $alt )
						$article->Content = preg_replace( '/(<img.*?) alt=["\'].*?["\']/i','${1}', $article->Content, 1 );				
					
					// Replace to temp
			//		$replace = '<' . $temp . ' title="' . $title.' ' . $article->Title .' '.$article->Category->Name  . $title_suffix . '" alt="' .  $alt.' '. $article->Title .' '.$article->Category->Name   . $alt_suffix . '"';
			
			if(!$zbp->Config('Nobird_ImgAlt')->Altappend){
			if($article->Type==0){
					$replace = '<' . $temp . ' alt="'. $article->Title .' '.$article->Category->Name   . $alt_suffix . '"';					
				}else{
					$replace = '<' . $temp . ' alt="'. $article->Title .' '.$article->Category->Name   . $alt_suffix . '"';					
				}
				}else{
			if($article->Type==0){
					$replace = '<' . $temp . ' alt="' .  $alt.' '. $article->Title .' '.$article->Category->Name   . $alt_suffix . '"';					
				}else{
					$replace = '<' . $temp . ' alt="' .  $alt.' '. $article->Title .' '.$article->Category->Name   . $alt_suffix . '"';					
				}
				}
				
				
					$article->Content = preg_replace( '/<img/i', $replace, $article->Content, 1 );
				}
				
				$article->Content = str_replace( $temp, 'img', $article->Content );	
			}

}
}



function Nobird_Seo_Tools_ImgAlt_viewpost2(&$template){
	global $zbp;
	
	if ($zbp->Config('Nobird_ImgAlt')->IsUse==1){
	$article = $template->GetTags('article');
		// Arguments
		//	$this->get_properties();			
			$num = preg_match_all( '/<img.*?>/i', $article->Content, $matches );
			
			// One image
			if( 1 == $num ) {
				
				// Get original title and alt
				preg_match( '/<img.*?title=[\"\'](.*?)[\"\'].*?>/', $article->Content, $match_title );
				$title = isset( $match_title[1] ) ? $match_title[1] : '';				
				preg_match( '/<img.*?alt=[\"\'](.*?)[\"\'].*?>/', $article->Content, $match_alt );
				$alt = isset( $match_alt[1] ) ? $match_alt[1] : '';
				
				// Clear title and alt
				$article->Content = preg_replace( '/(<img.*?) title=["\'].*?["\']/i', '${1}', $article->Content );
				$article->Content = preg_replace( '/(<img.*?) alt=["\'].*?["\']/i','${1}', $article->Content );				
				
				// Replace
			//	$article->Content = preg_replace( '/<img/i', '<img' . ' title="' .$title.' '.$article->Title .' '.$article->Category->Name .  '" alt="' . $alt.' ' .  $article->Title.' ' .$article->Category->Name .'"', $article->Content, 1 );
			if(!$zbp->Config('Nobird_ImgAlt')->append){
						if($article->Type==0){
            $article->Content = preg_replace( '/<img/i', '<img' . ' title="'.$article->Title .' '.$article->Category->Name .  '" alt="' .  $article->Title.' ' .$article->Category->Name .'"', $article->Content, 1 );
            }else{
            $article->Content = preg_replace( '/<img/i', '<img' . ' title="'.$article->Title .'" alt="' .  $article->Title.'"', $article->Content, 1 );
            }
			
			
			}else{
			
						if($article->Type==0){
            $article->Content = preg_replace( '/<img/i', '<img' . ' title="'.$title.' '.$article->Title .' '.$article->Category->Name .  '" alt="' . $alt.' ' .  $article->Title.' ' .$article->Category->Name .'"', $article->Content, 1 );
            }else{
            $article->Content = preg_replace( '/<img/i', '<img' . ' title="'.$title.' '.$article->Title .'" alt="' . $alt.' ' .  $article->Title.'"', $article->Content, 1 );
            }
       }
			}
			
			// multi images add suffix
			if( 1 < $num ) {
				$temp = '*@@##@@*';
				for( $i = 1; $i <= $num; $i++ ) {
					
					// Get original title and alt
					preg_match( '/<img.*?>/', $article->Content, $match_img );
					$img = isset( $match_img[0] ) ? $match_img[0] : '';
					preg_match( '/<img.*?title=[\"\'](.*?)[\"\'].*?>/', $img, $match_title );
					$title = isset( $match_title[1] ) ? $match_title[1] : '';				
					preg_match( '/<img.*?alt=[\"\'](.*?)[\"\'].*?>/', $img, $match_alt );
					$alt = isset( $match_alt[1] ) ? $match_alt[1] : '';			
					
					// Set suffix
					$title_suffix =  title_suffix( $i ) ;
					$alt_suffix =  title_suffix( $i ) ;
					
					// Clear title and alt
					if( $title )
						$article->Content = preg_replace( '/(<img.*?) title=["\'].*?["\']/i', '${1}', $article->Content, 1 );
					if( $alt )
						$article->Content = preg_replace( '/(<img.*?) alt=["\'].*?["\']/i','${1}', $article->Content, 1 );				
					
					// Replace to temp
			//		$replace = '<' . $temp . ' title="' . $title.' ' . $article->Title .' '.$article->Category->Name  . $title_suffix . '" alt="' .  $alt.' '. $article->Title .' '.$article->Category->Name   . $alt_suffix . '"';
			
			if(!$zbp->Config('Nobird_ImgAlt')->append){
			if($article->Type==0){
					$replace = '<' . $temp . ' title="' . $article->Title .' '.$article->Category->Name  . $title_suffix . '" alt="'. $article->Title .' '.$article->Category->Name   . $alt_suffix . '"';					
				}else{
					$replace = '<' . $temp . ' title="' . $article->Title .' '. $title_suffix . '" alt="'. $article->Title .' '.$article->Category->Name   . $alt_suffix . '"';					
				}
				}else{
			if($article->Type==0){
					$replace = '<' . $temp . ' title="'.$title.' ' . $article->Title .' '.$article->Category->Name  . $title_suffix . '" alt="' .  $alt.' '. $article->Title .' '.$article->Category->Name   . $alt_suffix . '"';					
				}else{
					$replace = '<' . $temp . ' title="'.$title.' ' . $article->Title .' '. $title_suffix . '" alt="' .  $alt.' '. $article->Title .' '.$article->Category->Name   . $alt_suffix . '"';					
				}
				}
				
				
					$article->Content = preg_replace( '/<img/i', $replace, $article->Content, 1 );
				}
				
				$article->Content = str_replace( $temp, 'img', $article->Content );	
			}

}

}
	
	/**
	 * Title suffix
	 */
	function title_suffix( $i ) {
		global $zbp;

		if( $zbp->Config('Nobird_ImgAlt')->suffix ) {
			$suffix = str_replace( '%d', $i, $zbp->Config('Nobird_ImgAlt')->suffix );
			return ' ' . trim( $suffix );
		}
		return '';
	}

	

function Nobird_ImgAlt_Install(){
	global $zbp;
	if(!$zbp->Config('Nobird_ImgAlt')->HasKey('Version')) {
	$zbp->Config('Nobird_ImgAlt')->Version = '1.0';
	$zbp->Config('Nobird_ImgAlt')->IsUseTitle = 1;
	$zbp->Config('Nobird_ImgAlt')->IsUseAlt = 1;
	$zbp->Config('Nobird_ImgAlt')->suffix = '第%d张';
	$zbp->SaveConfig('Nobird_ImgAlt');
	}
	
}



function Nobird_ImgAlt_Uninstall(){
	global $zbp;
	$zbp->DelConfig('Nobird_ImgAlt');
}


?>