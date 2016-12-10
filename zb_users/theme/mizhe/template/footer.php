		<div class="footer footerbg">
			<div class="foot">
				<div class="footlink"><span class="friend">友情链接：</span><ul>{module:link}</ul></div>
				<div class="footnav">
					<ul>
						{module:navbar}
					</ul>
				</div>
				<div class="footsign">
					{$zbp->Config('mizhe')->PostFOOTSIGN}
				</div>
				<p>{$copyright}</p>
				<div class="copyright" id="footer">Powered By {$zblogphpabbrhtml}. Theme by <a href="http://www.toyean.com/" title="拓源网-专业的zblog主题模板原创网站！" target="_blank">拓源网</a></div>	
			</div>
		</div>
	</div>
	{$footer}
</body>
</html>