<html>
<head>
<meta charset="UTF-8">
<title>CODE DEMO</title>
<style type="text/css"> 
<!-- 
fieldset{padding:0 15px 10px 15px;border-radius: 4px;border:solid 1px #888;width:95%;} 
.summary-container fieldset{padding-bottom:5px;margin-top:4px;} 
legend.no-expand-all{padding:2px 15px 4px 10px;margin:0 0 0 -12px;} 
legend{border-radius: 2px;color:#333333;padding:4px 15px 4px 10px;margin:4px 0 8px -12px;_margin-top:0px; 
 border-top:1px solid #EDEDED;border-left:1px solid #EDEDED;border-right:1px solid #969696; 
 border-bottom:1px solid #969696;background:#E7ECF0;font-weight:bold;font-size:1em;} 
--> 
</style> 
</head>
<body>
<h1>YT.CMS 2.0 演示文档</h1>
<h3>演示效果中的字段可以在YT.CMS后台面板中生成</h3>
<fieldset>  
<legend><h1>单体循环</h1></legend>  
<em>说明:当没有定义别名时,默认为Article</em>
<h2>效果</h2>
<?php  foreach ( YT_Article::GetArticleRandomSortRand(1) as $Article) { ?> 
文章标题：<?php  echo $Article->Title;  ?>
<?php  }   ?>
<h2>代码</h2>
</fieldset>  
<fieldset>  
<legend><h1>使用别名</h1></legend>  
<em>说明:别名命名一般为字母</em>
<h2>效果</h2>
<?php  foreach ( YT_Article::GetArticleRandomSortRand(1) as $b) { ?> 
文章标题：<?php  echo $b->Title;  ?>
<?php  }   ?>
<h2>代码</h2>
</fieldset>  
<fieldset>  
<legend><h1>嵌套循环</h1></legend>  
<em>说明:使用嵌套循环的时候别名是必须的,且不要重复,嵌套层数不限</em>
<h2>效果</h2>
<?php  foreach ( YT_Comment::GetCommentComments(5) as $com) { ?> 
    评论内容：<?php  echo $com->Content;  ?>
        <?php  foreach ( YT_Article::GetArticleModel($com->LogID) as $art) { ?> 
        <?php if (is_array($art)) { ?>
        文章标题：<?php  echo $art->Title;  ?>
        <?php }else{  ?>
        该文章已经被删除！
        <?php } ?>
        <?php  }   ?>
    评论时间：<?php  echo $com->Time('Y年m月d日');  ?>
<?php  }   ?>
<h2>代码</h2>
</fieldset>

<script language="javascript" type="text/javascript">
var _code = [];
	_code.push('%7BYT%3AArticle%20DataSource%3D%22GetArticleRandomSortRand%281%29%22%7D%0A%u6587%u7AE0%u6807%u9898%uFF1A%7B%24Article.Title%7D%0A%7B/YT%3AArticle%7D');
	_code.push('%7BYT%3AArticle%20DataSource%3D%22GetArticleRandomSortRand%281%29%22%20Name%3D%22b%22%7D%0A%u6587%u7AE0%u6807%u9898%uFF1A%7B%24b.Title%7D%0A%7B/YT%3AArticle%7D');
	_code.push('%7BYT%3AComment%20DataSource%3D%22GetCommentComments%285%29%22%20Name%3D%22com%22%7D%0A%20%20%20%20%u8BC4%u8BBA%u5185%u5BB9%uFF1A%7B%24com.Content%7D%0A%20%20%20%20%20%20%20%20%7BYT%3AArticle%20DataSource%3D%22GetArticleModel%28%24com.LogID%29%22%20Name%3D%22art%22%7D%0A%20%20%20%20%20%20%20%20%7Bif%20is_array%28%24art%29%7D%0A%20%20%20%20%20%20%20%20%u6587%u7AE0%u6807%u9898%uFF1A%7B%24art.Title%7D%0A%20%20%20%20%20%20%20%20%7Belse%7D%0A%20%20%20%20%20%20%20%20%u8BE5%u6587%u7AE0%u5DF2%u7ECF%u88AB%u5220%u9664%uFF01%0A%20%20%20%20%20%20%20%20%7B/if%7D%0A%20%20%20%20%20%20%20%20%7B/YT%3AArticle%7D%0A%20%20%20%20%u8BC4%u8BBA%u65F6%u95F4%uFF1A%7B%24com.Time%28%27Y%u5E74m%u6708d%u65E5%27%29%7D%0A%7B/YT%3AComment%7D');
$(document).ready(function(){
	$('fieldset').each(function(i){
		this.innerHTML += '<pre>'+unescape(_code[i])+'</pre>';
	});	   
});
</script>
</body>
</html>