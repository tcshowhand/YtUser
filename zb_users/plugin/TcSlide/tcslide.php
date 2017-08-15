<?php
$TcSlide_Table='%pre%tcslide';
$TcSlide_DataInfo=array(
    'ID'=>array('sean_ID','integer','',0),
    'Type'=>array('sean_Type','integer','',0),
    'Title'=>array('sean_Title','string',255,''),
    'Url'=>array('sean_Url','string',255,''),
    'Img'=>array('sean_Img','string',255,''),
    'Order'=>array('sean_Order','integer','',99),
    'Code'=>array('sean_Code','string',255,''),
    'IsUsed'=>array('sean_IsUsed','boolean','',true),
    'Intro'=>array('sean_Intro','string',255,''),
    'Addtime'=>array('sean_Addtime','integer','',0),
    'Endtime'=>array('sean_Endtime','integer','',0),
);

function TcSlide_Get_Flash($TcSlide_Table,$TcSlide_DataInfo){
    global $zbp;
    $where = array(array('=','sean_Type','0'),array('=','sean_IsUsed','1'));
    $order = array('sean_IsUsed'=>'DESC','sean_Order'=>'ASC');
    $sql= $zbp->db->sql->Select($TcSlide_Table,'*',$where,$order,null,null);
    $array=$zbp->GetListCustom($TcSlide_Table,$TcSlide_DataInfo,$sql);
    $i =1;
    $str = '
<style>
           *{ margin:0;padding:0;}
           #zd{width: 980px;height: 300px;overflow: hidden;position: relative;margin:0 auto;}
           #zd ul{position: absolute;left:0;top:0;}
           #zd ul li{width: 980px;height: 300px;float: left; }
</style>
        <div id="zd">
            <ul>
    ';
    foreach ($array as $key => $reg) {
        $str .= "<li style='background:".$reg->Code."' ><a href='".$reg->Url."' title='".$reg->Title."' target='_blank'><img alt='".$reg->Title."' src='".$reg->Img."' /></a></li>\n";
        $i++;
    }
    $str .='
            </ul>
        </div>

        <script>
        var oul=$("zd").getElementsByTagName("ul")[0],
            oli=oul.getElementsByTagName("li"),
            timers=null,
            timer=null,
            i=0,
            oliW=oli[0].offsetWidth;
            oul.style.width=oli.length*oliW+"px";
            function $(id){
                 return document.getElementById(id);
            }
            function getClass(obj,name){
                if(obj.currentStyle){
                    return obj.currentStyle[name]
                }else{
                     return getComputedStyle(obj,false)[name]
                }
            }
            function Stratmove(obj,json,funEnd,callback){
               clearInterval(obj.timer);
               obj.timer=setInterval(function(){
                   for(var attr in json){
                       var bStop=true,
                           cuur=parseFloat(getClass(obj,attr)),
                           speed=0;
                       if(attr=="opacity"){
                          cuur=Math.round(parseFloat(getClass(obj,attr))*100);
                       }else{
                          cuur=parseFloat(getClass(obj,attr));
                       }
                       speed=(json[attr]-cuur)/8;
                       speed=speed>0?Math.ceil(speed):Math.floor(speed);
                       if(cuur!=json[attr]){
                            bStop=false;
                       }
                       if(attr=="opacity"){
                            obj.style["opacity"]=(cuur+speed)/100;
                                   obj.style["filter"]="alpha(opacity="+cuur+speed+")";

                       }else{
                            obj.style[attr]=Math.round(cuur+speed)+"px";
                       }
                       if(bStop){
                          clearInterval(obj.timer);
                                                  callback();
                       }
                       if(funEnd)funEnd();
                   }
               },30)
            }
            var arr=[];
                        timers=setInterval(function(){
                                Stratmove(oul,{"left":-oliW},null,calls); 
                                               
               },3000);     
                    function calls(){
                                arr.push(oli[0]);
                                oul.removeChild(oli[0]);
                                oul.appendChild(arr[0]);
                                arr.splice(0,arr.length);
                                oul.style.left=0;
                      }
        </script>
    ';


    @file_put_contents($zbp->usersdir . 'theme/'.$zbp->theme.'/include/tc_slide.php', $str);
}

?>