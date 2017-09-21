<?php
#注册插件
RegisterPlugin("Rookie","ActivePlugin_Rookie");

function ActivePlugin_Rookie() {
    Add_Filter_Plugin('Filter_Plugin_ViewList_Template','Rookie_set');
}


function Rookie_set(&$template){
    $articles=$template->GetTags('articles')?$template->GetTags('articles'):$template->GetTags('article');
    if(!$articles) return;
    if(is_array($articles)&&count($articles)>0){
        foreach($articles as $article){
            Rookie_Tags($article,$template);
        }
    }else{
        Rookie_Tags($articles,$template);
    }
}

function Rookie_Tags(&$article,&$template){
    global $zbp;    
    ZBlogException::ClearErrorHook();
    $intro = preg_replace("/\[BuyView\](.*?)\[\/BuyView\]/sm",'',$article->Intro);
    $article->Intro=11;
}

function InstallPlugin_Rookie() {

}

function UninstallPlugin_Rookie() {

}