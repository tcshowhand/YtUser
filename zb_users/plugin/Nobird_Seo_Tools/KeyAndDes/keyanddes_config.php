<?php


function Nobird_Seo_Tools_KeyAndDes_Edit(){
		global $zbp,$article;
if($zbp->Config('Nobird_KeyAndDes')->UseDes){
?>
<style>
#keyword,#description{
    margin-top: 5px;
    padding: 3px;
    }
.editinputname > span{padding:4px;}    
#keyword > textarea,#description > textarea {height:25px;width:90%}   


.nbseotools table {
	width: 100%;
}

.nbseotools tr td {
	vertical-align: middle;
}
.nbseotools input{
  width:100%;
  box-sizing:border-box;
}

</style>


<?php
  echo '<!-- Nobird_Seo_Tools( -->';

	echo '<div><div class="nbseotools">
	<table class="nobmx">
	<tr>';
if($zbp->Config('Nobird_BeautyTitle')->Use_DIY_article){
echo '	<td class="td25"><label class="editinputname">文章页面自定义标题 %nbname%</label></td>
	<td><input type="text" name="meta_Nobird_Seo_Tools_DIY_article" id="meta_Nobird_Seo_Tools_DIY_article" value="'.$article->Metas->Nobird_Seo_Tools_DIY_article.'" /></td>
	</tr>';
}

echo '	<td><label class="editinputname">关键词</label></td>
	<td><input type="text" name="meta_Nobird_Seo_Tools_Keyword" id="meta_Nobird_Seo_Tools_Keyword" value="'.$article->Metas->Nobird_Seo_Tools_Keyword.'" /></td>
	</tr>
	<tr>
	<td><label class="editinputname">页面描述</label></td>
	<td><input type="text" name="meta_Nobird_Seo_Tools_Description" id="meta_Nobird_Seo_Tools_Description" value="'.$article->Metas->Nobird_Seo_Tools_Description.'" /></td>
	</tr>
	</table></div></div>';

//    echo '<div id="keyword" class="editmod2"><label for="edtKeyword" class="editinputname" >关<span></span>键<span></span>词</label>';
//    echo '<textarea id="edtDescription" name="Nobird_Seo_Tools_Keyword">'.$article->Metas->Nobird_Seo_Tools_Keyword.'</textarea></div>';
//    echo '<div id="description" class="editmod2"><label for="edtDescription" class="editinputname" >页面描述</label>';
//    echo '<textarea id="edtDescription" name="Nobird_Seo_Tools_Description">'.$article->Metas->Nobird_Seo_Tools_Description.'</textarea></div>';
    echo '<!-- )Nobird_Seo_Tools -->';
}
}

function Nobird_Seo_Tools_KeyAndDes_PostArticle_Core(&$article){
	$article->Metas->Nobird_Seo_Tools_Keyword = $_POST['Nobird_Seo_Tools_Keyword'];
	$article->Metas->Nobird_Seo_Tools_Description = $_POST['Nobird_Seo_Tools_Description'];
}



function Nobird_Seo_Tools_KeyAndDes_viewpost(&$template){
	global $zbp;
	$str='';
	$article = $template->GetTags('article');

if($zbp->Config('Nobird_KeyAndDes')->UseDes){	
      if($article->Metas->Nobird_Seo_Tools_Keyword){
			$keywords=$article->Metas->Nobird_Seo_Tools_Keyword;
        }else{	
          $aryTags = array();
          //if(!$article->Tags){echo '111';die();}
          if($article->Tags){
          foreach($article->Tags as $key){$aryTags[] = $key->Name;}
          }else{
          $aryTags[] = $article->Category->Name;
          }
        if(count($aryTags)>0) $keywords = implode(',',$aryTags);
	}

      if($article->Metas->Nobird_Seo_Tools_Description){
			$description=$article->Metas->Nobird_Seo_Tools_Description;
        }else{
	$description = preg_replace('/[\r\n\s]+/', ' ', trim(SubStrUTF8(TransferHTML($article->Content,'[nohtml]'),$zbp->Config('Nobird_KeyAndDes')->description_num)).'...');
  $description=str_replace("&nbsp;","",$description);
  $description=str_replace(" ","",$description);
  }
	$str .= '<meta name="author" content="'.$article->Author->StaticName.'">' . "\r\n";
  if(isset($keywords)&&strlen($keywords)>0){
	$str .=  '<meta name="keywords" content="'.htmlspecialchars($keywords).'" />' . "\r\n";
}
if(isset($description)&&strlen($description)>0){
	$str .= '<meta name="description" content="'.htmlspecialchars($description).'" />' . "\r\n";
}

}


if($zbp->Config('Nobird_KeyAndDes')->usemsapplication){
  $str.='<meta name="msapplication-TileImage" content="msapplication-144.png" />'. "\r\n";
  $str.='<meta name="msapplication-TileColor" content="'.$zbp->Config('Nobird_Keywordlink')->msapplication_titlecolor.'" />'. "\r\n";
}

if($zbp->Config('Nobird_KeyAndDes')->useappletouchicon){
  $str.='<meta name="apple-mobile-web-app-title" content="'.$zbp->Config('Nobird_KeyAndDes')->apple_mobile_web_app_title.'" />'. "\r\n";
  $str.='<link rel="apple-touch-icon" href="'.$zbp->host.'touch-icon-iphone.png" />'. "\r\n";
  $str.='<link rel="apple-touch-icon" sizes="76x76" href="'.$zbp->host.'touch-icon-ipad.png" />'. "\r\n";
  $str.='<link rel="apple-touch-icon" sizes="120x120" href="'.$zbp->host.'touch-icon-iphone-retina.png" />'. "\r\n";
  $str.='<link rel="apple-touch-icon" sizes="152x152" href="'.$zbp->host.'touch-icon-ipad-retina.png" />'. "\r\n";
}

if ($zbp->Config('Nobird_KeyAndDes')->isusepostcanonical && $article->ID){
	$str .= '<link rel="canonical" href="'.$article->Url.'"/>' . "\r\n";
}


	$result='<!-- Nobird_Seo_Tools Start -->' . "\r\n";
	$result .=$str. "\r\n";
	$result .='<!-- Nobird_Seo_Tools End -->' . "\r\n";

	$template->SetTags('Nobird_Seo_KeyAndDes',$result); //替换标签  直插最前

}



function Nobird_Seo_Tools_KeyAndDes_viewlist(&$type,&$page,&$category,&$author,&$datetime,&$tag){
	global $zbp;
	$str='';
if($zbp->Config('Nobird_KeyAndDes')->UseDes){
	if($type=='index'&&$page=='1'){
	$keywords = $zbp->Config('Nobird_KeyAndDes')->title_keywords;
	$description = $zbp->Config('Nobird_KeyAndDes')->title_description;
	$str .=  '<meta name="keywords" content="'.htmlspecialchars($keywords).'" />' . "\r\n";
	$str .= '<meta name="description" content="'.htmlspecialchars($description).'" />' . "\r\n";
	$str .= '<link rel="canonical" href="'.$zbp->host.'"/>' . "\r\n";

}elseif($type=='category'){
		//var_dump($category);

		if($category->Metas->NBKeyword){
	$keywords = $category->Metas->NBKeyword;
	}
	else{	
	$keywords = $category->Name.','.$zbp->name;
	}
	
	
	if ($category->Intro){
	$description = $category->Intro;
	}else{
	$description = $zbp->name.','.$zbp->title;
	}
	$str .=  '<meta name="keywords" content="'.htmlspecialchars($keywords).'" />' . "\r\n";
	$str .= '<meta name="description" content="'.htmlspecialchars($description).'" />' . "\r\n";
	
}elseif($type=='author'&&$zbp->Config('Nobird_KeyAndDes')->isusecanonical){
	$domain=$_SERVER['HTTP_HOST'];
	$url=$_SERVER['REQUEST_URI'];
$tempurl=str_replace("author-1","page",$url);
$tempurl='http://'.$domain.$tempurl;
if ($page==1){$tempurl=$zbp->host;}
  $str .= '<link rel="canonical" href="'.$tempurl.'"/>' . "\r\n";
}elseif($type=='tag'){
	//var_dump($tag->Name);
	if($tag->Metas->NBKeyword){
	$keywords = $tag->Metas->NBKeyword;
	}
	else{	
	$keywords = $zbp->title.','.$zbp->name;
	}
	$tagtemp=$zbp->GetTagByAliasOrName($zbp->title);
	if ($tagtemp->Intro){
	$description = $tagtemp->Intro;
	}else{
	$description = $zbp->title.','.$zbp->name;
	}
	$str .=  '<meta name="keywords" content="'.htmlspecialchars($keywords).'" />' . "\r\n";
	$str .= '<meta name="description" content="'.htmlspecialchars($description).'" />' . "\r\n";

}
}


if($zbp->Config('Nobird_KeyAndDes')->usemsapplication){
  $str.='<meta name="msapplication-TileImage" content="img/msapplication-144.png" />'. "\r\n";
  $str.='<meta name="msapplication-TileColor" content="'.$zbp->Config('Nobird_Keywordlink')->msapplication_titlecolor.'" />'. "\r\n";
}

if($zbp->Config('Nobird_KeyAndDes')->useappletouchicon){
  $str.='<meta name="apple-mobile-web-app-title" content="'.$zbp->Config('Nobird_KeyAndDes')->apple_mobile_web_app_title.'" />'. "\r\n";
  $str.='<link rel="apple-touch-icon" href="'.$zbp->host.'touch-icon-iphone.png" />'. "\r\n";
  $str.='<link rel="apple-touch-icon" sizes="76x76" href="'.$zbp->host.'touch-icon-ipad.png" />'. "\r\n";
  $str.='<link rel="apple-touch-icon" sizes="120x120" href="'.$zbp->host.'touch-icon-iphone-retina.png" />'. "\r\n";
  $str.='<link rel="apple-touch-icon" sizes="152x152" href="'.$zbp->host.'touch-icon-ipad-retina.png" />'. "\r\n";
}

	$result='<!-- Nobird_Seo_Tools Start -->' . "\r\n";
	$result .=$str. "\r\n";
	$result .='<!-- Nobird_Seo_Tools End -->' . "\r\n";

	$zbp->template->SetTags('Nobird_Seo_KeyAndDes',$result); //替换标签  直插最前

	
	#$zbp->header .= '	<link rel="canonical" href="'.$article->Url.'"/>' . "\r\n";


}


function Nobird_Seo_Tools_Category_Edit_Response() {
	global $zbp,$cate;
	echo '
	  <p>
		<span class="title">分类页面关键词:</span><br />
		<textarea name="meta_NBKeyword" type="text" id="edtIntro" style="width:98%;">' . $cate->Metas->NBKeyword . '</textarea>
	  </p>
	  <p>
		<span class="title">分类页面标题附加内容:</span><br />
		<textarea name="meta_NBTitle" type="text" id="edtIntro" style="width:98%;">' . $cate->Metas->NBTitle . '</textarea>
	  </p>
	';
}

function Nobird_Seo_Tools_Tag_Edit_Response() {
	global $zbp,$tag;
	echo '
	  <p>
		<span class="title">标签页面关键词:</span><br />
		<textarea name="meta_NBKeyword" type="text" id="edtIntro" style="width:98%;">' . $tag->Metas->NBKeyword . '</textarea>
	  </p>
	  <p>
		<span class="title">标签页面标题附加内容:</span><br />
		<textarea name="meta_NBTitle" type="text" id="edtIntro" style="width:98%;">' . $tag->Metas->NBTitle . '</textarea>
	  </p>
	';
}

function Nobird_KeyAndDes_Install(){
	global $zbp;
	if(!$zbp->Config('Nobird_KeyAndDes')->HasKey('Version')) {
	$zbp->Config('Nobird_KeyAndDes')->Version = '1.2';
	$zbp->Config('Nobird_KeyAndDes')->UseDes=1;
	$zbp->Config('Nobird_KeyAndDes')->title_keywords='ZBLOG,ZBLOGPHP,ZBLOG主题,ZBLOG模板,ZBLOG插件';
	$zbp->Config('Nobird_KeyAndDes')->title_description='承接ZBLOG模板定制、主题设计。用最好的ZBLOG模板、最好的ZBLOG插件提供最优质的ZBLOG建站服务。';
	$zbp->Config('Nobird_KeyAndDes')->description_num= '88';
	$zbp->Config('Nobird_KeyAndDes')->apple_mobile_web_app_title = '鸟儿博客';
	$zbp->Config('Nobird_KeyAndDes')->msapplication_titlecolor= '#3F7A37';
	$zbp->Config('Nobird_KeyAndDes')->isusecanonical=1;
	$zbp->Config('Nobird_KeyAndDes')->useappletouchicon=1;
	$zbp->Config('Nobird_KeyAndDes')->isusepostcanonical=1;
	
	$zbp->SaveConfig('Nobird_KeyAndDes');
	}
	
}



function Nobird_KeyAndDes_Uninstall(){
	global $zbp;
	$zbp->DelConfig('Nobird_KeyAndDes');
}


?>