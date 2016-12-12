<html>
<head>
<meta content=IE=edge http-equiv=X-UA-Compatible>
<meta name=renderer content=webkit>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<title>批量申请秒审核任务 - {Site('name')}做任务赚佣金</title>
<meta name="keywords" content="试客,免费试用,试客网,免费试用网,试用网站,试客联盟,{Site('name')}"/>
<meta name="description" content="{Site('name')}佣金任务专区，试客领任务做任务赚佣金，天天佣金赚不停，佣金高、通过率高、提现快，靠谱的网上兼职赚钱网站！"/>
<!--  第三方跟踪统计代码  -->
{Site('headmeta')}
<!--  引入样式  -->
<link href="{R_URL}css/user_comm.css" media="all" rel="stylesheet" type="text/css" />
<link href="{R_URL}css/user_commodity.css" media="all" rel="stylesheet" type="text/css" />
<link href="{R_URL}css/hz_page.css" media="all" rel="stylesheet" type="text/css" />
<link href="{R_URL}css/xinstyle.css" media="all" rel="stylesheet" type="text/css" />
<link href="/favicon.ico" type="image/x-icon" rel="shortcut icon">
<!--[if lt IE 9]>
    <script type="text/javascript" src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script type="text/javascript" src="{R_URL}js/response.js"></script>
<![endif]-->

<script type="text/javascript">
        var BASE_URL = '{SITE_URL}';
		var SITE_URL = '{SITE_URL}';
		var R_URL = '{R_URL}';
    </script>
<script type="text/javascript" src="{R_URL}js/jquery.js"></script>
<script type="text/javascript" src="{R_URL}js/sea.js"></script>
<script type="text/javascript" src="{R_URL}js/sea-config.js"></script>
</head>
<body>
<!--头部--> 
{template 'common','header'} 
<!--/头部--> 
<link href="{R_URL}css/tryout.css" rel="stylesheet" />
<link type="text/css" rel="stylesheet" href="{R_URL}css/recommend.css" />
<link href="{R_URL}css/trylist.css" media="all" rel="stylesheet" type="text/css" />
<script src="{R_URL}js/recommend.js"></script> 

<script>
  <?php if($uid>0){$wwrow=SDB::get_one('wangwang',array('userid'=>$uid)); }?>  
    _taobao = '{$wwrow['nick']}';
</script>


    <div class="container clearfix" style="margin-top:4px;">
      <div class="prd_cz">
        <div class="zq_sxu">
          <div class="clearfix">
            <div style="float: left">
              <div class="zq_sxt float-left"> <a href="{create_Url('shike/')}" class="sxu_current"> 正在进行中 </a> <a href="{create_Url('shike/wangqi')}"> 往期回顾 </a> </div>
              <em class="timel">每天<span> 9:00-19:00 </span>持续上新！</em> </div>
            <div class="ptd_szw" style="float: right;">当前位置：<a href="{SITE_URL}">首页</a> > 免费试用</div>
            <!--ptd_szw-->
            <div class="clear-both"> </div>
          </div>
          
           <!--zq_sxt-->
          <div class="goods-selector">
            <div class="all-goods-kinds" >
              <ul>
<li style="width:90px;"> <a href="{create_Url('shike/')}"><span>全部宝贝</span></a> </li>
<?php  $topcatelists=SDB::select('shike_category',"`isshow`=1",'*',50,'sort asc');?>
{loop $topcatelists $vo}
   <li style="width:10%;" class="typeImg"> <a href="{create_Url('shike/lists',array('catid'=>$vo['id']))}" class="good{$vo['id']} "><i></i>{$vo['name']}</a> </li>
{/loop}

              </ul>
            </div>
            <div class="all-goods-select">
              <ul>
                <li> <a href="{create_Url('shike/lists',array('order'=>'create_time'))}" order="1" class="jiazhi"><span id="seleted_10">最新</span><img class="sortImg" src="{R_URL}images/sort-icon-rev.png" alt="按最新排序" /></a> </li>
                <li> <a href="{create_Url('shike/lists',array('order'=>'pay_price'))}" order="2"  class="jiazhi"><span id="seleted_11">价格</span><img class="sortImg" src="{R_URL}images/sort-icon-rev.png" alt="按价格排序" /></a> </li>
                <li> <a href="{create_Url('shike/lists',array('order'=>'try_nums'))}" order="3"  class="jiazhi"><span id="seleted_12">份数</span><img class="sortImg" src="{R_URL}images/sort-icon-rev.png" alt="按剩余份数排序"/></a> </li>
                <li style="border: none; width: 950px;">
                  <form action="{create_Url('shike/lists')}" method="get" id="searchKey">
                    <input type="text" name="q" id="ck" placeholder="宝贝关键词" value="" />
                    <div class="confirm" id="selectSumbit">确定</div>
                  </form>
                  
                  <!--小分页-->
                  <div class="simple-change-page"> <img src="{R_URL}images/left_icon_no.png" alt="上一页"/> <span> &nbsp; <span>{$page}</span>/<span>{$lastpg}</span> </span> <a href="{create_Url('shike/lists',array('page'=>$page+1))}"> <img src="{R_URL}images/right_icon_yes.png" class="pagechange_on" alt="下一页"/></a> </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!--zq_sxu--> 
      </div>
    </div>

  <div class="recommend_try">
    <ul class="main clearfix">

{loop $shiyonglists $vo}
        <?php $vo['out_num']=SDB::count('shike_order',"`gid`=".$vo['id']." and  `state` IN (0,1,2,3,4,8)");?>
        <?php $si++; ?>
      <li {if $si%5=='0'}class="forth"{/if}> 
        
        <a href="{$vo['url']}" class="pic" target="_blank"> <img class="lazy" src="{R_URL}images/blank.gif" data-url="{$vo['img']}" alt="{$vo['title']}"/>             <i class="shenqin_is"></i> 
            <i class="shenqin_yes" id="{$vo['id']}"></i></a>
        <div class="title"> <a href="{$vo['url']}" target="_blank"> {$vo['title']}</a> </div>

            <div class="type">
              <label class="price">￥{$vo['price']}</label>
              <span class="leftnums">限量<b>{$vo['grant_num']}</b>份</span> </div>
          {if in_array($vo['id'],$myres)}
              <a class="btn" href="{$vo['url']}" target="_blank">您已申请</a>
          {else}
              {if  ($vo['try_et']-ZHIKE_TIME)<=0  || ($vo['grant_num']-$vo['out_num'])<1}
              <a class="btn" href="{$vo['url']}" target="_blank">还有机会</a>
             {else}
              <a class="btn" href="{$vo['url']}" target="_blank">免费试用</a>
            {/if}
          {/if}

             </li>
{/loop}
          </ul>
  </div>
</div>


        <div class="mod_pager" id="page_nav">
      <div class="pagination">
        <ul>
          <ul class="pagination pagination-sm">
            {pageftxin($number,$pagesize,$page,1,0,0,5,$pageurl)}
          </ul>
        </ul>
      </div>
    </div>




<div class="tryout_bottom"> <em onclick="location=location">换一批</em> <a class="begin_all" href="javascript:;">开始多选</a>
  <label>
    <input id="btn_all" type="checkbox">
    <i>全选</i></label>
  <span>您已选中 <strong style="display:inline-block; width:22px;">0</strong> 件试用品</span> <a class="all_mine" href="javascript:;" onclick="applyAll()">朕全要了</a> </div>
<script>
    $(function () {
        if (location.href.indexOf('detailInfo') >= 0 && location.href.indexOf('#detailInfo') < 0) {
            location.href = location.href + "#detailInfo";
        }
    });
    function closeSuccess() {
        if (ApplyType == 1) {
            location.href = '/' + _id + ".html?detailInfo";
        } else {
            $('#applySuccess').hide();
        }
    }
</script>
<div class="teach" id="applySuccess" style="display: none">
  <div class="min"> <a href="javascript:" class="cha" onclick="$('.teach').hide()">X</a>
    <div class="sheng_q"> <i></i>
      <h2>恭喜您申请成功，请耐心等待商家审核</h2>
      <a href="http://www.baiyoubao.com/topic/freetry" class="new" target="_blank">新手不会？点这里</a> </div>
    <div class="shangp"><i></i><span>您可能还喜欢以下商品，多申请活动可以获得神秘奖品哦！ </span><a href="{Url('recommend/')}" style="margin-left: 113px; color: #e34a42" target="_blank">更多推荐></a></div>
    <div class="phont">
      <ul>
 {loop $shikelists  $vo}
        <li> <a href="{$vo['url']}" target="_blank"> <img src="{$vo['img']}" />
          <p style="text-overflow: ellipsis; overflow: hidden; white-space:nowrap; width: 100px; height: 20px;margin: 0 auto">{$vo['title']}</p>
          <p><u>￥{$vo['price']}</u><span>限量<em style="color: #f25f55">{$vo['grant_num']}</em>份</span></p>
          </a> </li>
{/loop}
              </ul>
    </div>
  </div>
</div>
<script>
    function checktaobao() {
        var taobao = $('#taobao').val();
        if (taobao == "") {
            alert("请选择淘宝账号");
        } else {
            $('#chooseTaobao').hide();
            taobaosuccess(taobao, $('#leave').val());
        }
    }
</script>
<div class="tchs" id="chooseTaobao" style="display:none">
  <div class="wan">
    <div class="kuang"> 填写申请信息 </div>
    <div class="tu"> <a style="cursor: pointer" onclick="$('#chooseTaobao').hide()"> <img src="https://www.shiyong.com/img/xx_03.jpg" /> </a> </div>
    <div class="kuang_j">
      <div class="siz"> 选择本次下单的淘宝账号：</div>
      <div class="sz">
 <?php if($uid>0) {$wwlist=SDB::select('wangwang',array('userid'=>$uid));} ?> 
        <select id="taobao" name="scl" class="kuan">
          {loop $wwlist $vo}
          <option value="{$vo['id']}">{$vo['nick']}</option>
{/loop}
        </select>
        <a href="{Url('member/wangwang')}" target="_blank">去绑定</a> </div>
      <div class="zi"><span>*</span>(必须使用选择的淘宝账号下单,否则将不予返款同时冻结账户)</div>
      <div id="leaveArea" class="tao">
        <p>对商家说点什么（可以有效提升通过率哦）:</p>
        <textarea class="tao_z" id="leave" placeholder="如：在线等，通过后立即下单 等" rows="6" cols="42"></textarea>
      </div>
      <a href="javascript:" onclick="checktaobao()" class="quer">确定</a> </div>
  </div>
</div>
<script >
    function TaobaoSubmit() {
        var TBao = $("#TB").val().trim();
        if (TBao != "") {
            $.post('/CommonBase/ModifyTaobaoSubmit', { taobao: $("#TB").val().trim() }, function(data) {
                if (data.Result == true) {
                    $('#bindtaobao').hide();
                    taobaosuccess(TBao,"");
                } else {
                    alert(data.Message);
                    $('#errorMsg').text(data.Message);
                    $('#errorMsg').css("color", "#e63c31");
                }
            });
        } else {
            alert("淘宝号不能为空！");
        }
        
       
     }
     function next() {
         $('#bindtaobao').hide();
         taobaosuccess("","");
     }
 </script>
<div class="tchs" id="bindtaobao" style="display:none">
  <div class="lila_index" style="top: 200px">
    <div class="ling"> <img src="{R_URL}images/lila.jpg" /> <a style="cursor: pointer" onclick="$('#bindtaobao').hide()"> <img src="https://www.shiyong.com/img/xx.jpg" /> </a> </div>
    <div class="ling_mian">
      <div  id="errorMsg"> </div>
      <a class="qdingann qdingann_a"  href="{Url('member/wangwang',array('stateid'=>3))}" target="_blank">绑定账户" </a>
    </div>
  </div>
</div>
<link href="{R_URL}css/loading.css" rel="stylesheet" />
<div class="tchs" id="loading" style="display: none">
  <div class="loadingContent">
    <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
    <em>申请中，请稍后...</em><br>
    <em id="loadingText"></em> </div>
</div>
<!--页面底部--> 
{template 'common','footer'} 
<!--/页面底部-->
<div class="qqgroup qqgrouptotop">
    <div style="margin-top: -4px; text-align: center;">
        <div style="margin-top: 10px; text-align: center;">


           <img id="ll_group" border="0" src="https://www.shiyong.com/img/batch.png" alt="批量申请" title="批量申请">
        </div>
    </div>
</div>

<style type="text/css">
    .hnn a {
        margin-right: 0;
    }

    .qqgroup {
        position: absolute;
        left: 50%;
        margin-left: -751px;
    }

    .qqgrouptotop {
        position: fixed;
        top: 200px;
        left: 50%;
    }

    .sj-bg {
        margin-top: 20px;
        height: 90px;
    }

    .autoPlay img {
        width: 100%;
        height: 90px;
    }

    .firstline img {
        float: left;
        margin-top: 6px;
    }
</style>
</body>
</html>
