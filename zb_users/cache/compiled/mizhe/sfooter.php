<div class="footer">
			<div class="foot footblack">
				<div class="footnav">
					<ul>
						<?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?>
					</ul>
				</div>
				<p><?php  echo $copyright;  ?></p>
				<div class="copyright" id="footer">Powered By <?php  echo $zblogphpabbrhtml;  ?>. Theme by <a href="http://www.toyean.com/" title="拓源网-专业的zblog主题模板原创网站！" target="_blank">拓源网</a></div>
			</div>
		</div>
	</div>
	<?php  echo $footer;  ?>
</body>
</html>