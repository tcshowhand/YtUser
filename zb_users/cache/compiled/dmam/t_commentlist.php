<?php  /* Template Name:我的评论 */  ?>

<?php  include $this->GetTemplate('header');  ?>
<?php  include $this->GetTemplate('b_nav_top');  ?>
<aside id="pageside" class="dm-sider am-u-lg-2"> 
<?php if ($zbp->CheckPlugin('YtUser')) { ?><?php  include $this->GetTemplate('t_user_side');  ?><?php } ?>
	<?php if ($zbp->Config('dmam')->page_navi) { ?>
		<dl>
		<dd>
		<ul class="am-nav">
		<?php  echo $zbp->Config('dmam')->page_navi;  ?>
		</ul>
		</dd>
		</dl>
	<?php } ?>
</aside>
	<div class="dm-container am-u-lg-10">
 <div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">我的评论</strong> / <small>Comments</small></div>
      </div>

      <hr>
      <div class="am-g am-padding am-padding-top-0">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
				<th width="5%">序号</th>
				<th width="45%">评论内容</th>
				<th width="30%">评论文章</th>
				<th width="20%" class="table-date am-hide-sm-only">评论日期</th>
              </tr>
              </thead>
              <tbody>
             <?php  foreach ( $articles as $key=>$article) { ?>
				 <?php  $i = $key+1;  ?>
			 <tr>
                <td><?php  echo $i;  ?></td>
				<td><?php  echo $article->Intro;  ?></td>
                <td><a href="<?php  echo $article->Url;  ?>"><?php  echo $article->Title;  ?></a></td>
                <td class="am-hide-sm-only"><?php  echo $article->Time('Y年m月d日 h:i:s');  ?></td>
              </tr>
			  <?php }   ?>
              </tbody>
            </table>
            <div class="am-cf">
              <!-- 共 15 条记录 -->
              <div class="am-fr">
                <ul class="am-pagination">
                  <?php  include $this->GetTemplate('pagebar');  ?>
                </ul>
              </div>
            </div>
<!--             <hr>
            <p>注：.....</p> -->
          </form>
        </div>

      </div>
    </div>
  </div>
	</div>
<?php  include $this->GetTemplate('footer');  ?>