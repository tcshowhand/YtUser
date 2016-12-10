		<div class="footer footerbg">
			<div class="foot">
				<div class="footlink"><span class="friend">友情链接：</span><ul><?php  if(isset($modules['link'])){echo $modules['link']->Content;}  ?></ul></div>
				<div class="footnav">
					<ul>
						<?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?>
					</ul>
				</div>
				<div class="footsign">
					<?php  echo $zbp->Config('mizhe')->PostFOOTSIGN;  ?>
				</div>
				<p><?php  echo $copyright;  ?></p>
				<div class="copyright" id="footer">Powered By <?php  echo $zblogphpabbrhtml;  ?>. Theme by <a href="http://www.toyean.com/" title="拓源网-专业的zblog主题模板原创网站！" target="_blank">拓源网</a></div>	
			</div>
		</div>
	</div>
	<?php  echo $footer;  ?>
</body>
</html>