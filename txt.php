<?php
function TcQquptxt_Content(&$template){
        global $zbp;
        $article = $template->GetTags('article');
        $file = fopen($article->Metas->tcqq, "r");
        $content='';
        while(! feof($file)){$content .= fgets($file).'<br>';}
        fclose($file);
        $content = $content.$article->Content;
        $article->Content = $content;
        $template->SetTags('article', $article);
}
?>