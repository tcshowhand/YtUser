(function() {
"use strict";   
 
 tinymce.PluginManager.add('dmt',function(editor, url) {
  editor.addButton('dmt', {
    text: '小工具',
    icon: false,
    type: 'listbox',
    menu: [{text: '一些表格',menu: [{
        text: 'ZB应用',onclick: function() {
          editor.windowManager.open({
            title: 'Zblog 应用',body: [{
              type: 'textbox',
              name: 'appname',
              label: '名称',
              value: '秀主题ZBP版'
            },{
              type: 'textbox',
              name: 'appprice',
              label: '售价',
              value: '168'
            },{
              type: 'textbox',
              name: 'author',
              label: '作者',
              value: '大谋'
            },{
              type: 'textbox',
              name: 'urlpage',
              label: '发布连接',
              value: 'http://www.imlgm.com/'
            },{
              type: 'textbox',
              name: 'applogo',
              label: '图标',
              value: 'http://www.imlgm.com/zb_users/theme/xiu_x/screenshot.png'
            },{
              type: 'textbox',
              name: 'appintro',
              label: '简述',
              value: '博主很懒，没有写简述',
              multiline: true,
              minWidth: 300,
              minHeight: 100
            },{
              type: 'listbox',
              name: 'leibie',
              label: '类别',
              'values': [{
                text: 'Zblog php 主题',
                value: 'Zblog php 主题'
              },{
                text: 'Zblog php 插件',
                value: 'Zblog php 插件'
              },{
                text: 'Zblog php 扩展',
                value: 'Zblog php 扩展'
              },{
                text: 'Zblog asp 主题',
                value: 'Zblog asp 主题'
              },{
                text: 'Zblog asp 插件',
                value: 'Zblog asp 插件'
              },{
                text: 'Zblog asp 扩展',
                value: 'Zblog asp 扩展'
              }]
            }],onsubmit: function(e) {
				var appcontent = '<table class="table appinfo">\
								<caption>应用信息</caption>\
								<tbody>\
								<tr>\
								<td rowspan="5" align="center" valign="middle" class="appinfo_logo"><img src="' + e.data.applogo + '"></td>\
								<td class="appinfo_title">应用:</td>\
								<td><span>' + e.data.appname + '</span></td>\
								<td class="appinfo_title">售价:</td>\
								<td>' + e.data.appprice + '</td>\
								</tr>\
								<tr>\
								<td class="appinfo_title">作者:</td>\
								<td>' + e.data.author + '</td>\
								<td class="appinfo_title">类别:</td>\
								<td>' + e.data.leibie + '</td>\
								</tr>\
								<tr>\
								<td  class="appinfo_title">发布页</td>\
								<td colspan="3"><a href="' + e.data.urlpage + '" target="_blank">' + e.data.urlpage + '</a></td>\
								</tr>\
								<tr>\
								<td class="appinfo_title">应用简介</td>\
								<td colspan="3">' + e.data.appintro + '</td>\
								</tr>\
								</tbody></table>\
							';
              editor.insertContent(appcontent);
            }
          });
        }
						}]
    },{text: 'bootstrap',menu: [
		{text: '按钮',onclick: function() {
          editor.windowManager.open({
            title: '添加一个按钮',body: [{
              type: 'textbox',
              name: 'button_title',
              label: '标题',
              value: '这是一个按钮'
            },{
              type: 'textbox',
              name: 'button_id',
              label: '按钮ID',
              value: 'post_button_a',
            },{
              type: 'listbox',
              name: 'button_style',
              label: '风格',
              'values': [{
                text: '默认',
                value: 'default'
              },{
                text: '深蓝色',
                value: 'primary'
              },{
                text: '绿色',
                value: 'success'
              },{
                text: '浅蓝色',
                value: 'info'
              },{
                text: '土黄色',
                value: 'warning'
              },{
                text: '红色',
                value: 'danger'
              }]
            }],onsubmit: function(e) {
				var button_c = '<button class="btn ' + e.data.button_id + ' btn-' + e.data.button_style + '" type="button">' + e.data.button_title + '</button>';
              editor.insertContent(button_c);
            }
          });
        }},{text: '标签',onclick: function() {
          editor.windowManager.open({
            title: '标签',body: [{
              type: 'textbox',
              name: 'label_name',
              label: '标签名称',
              value: 'Default'
            },{
              type: 'listbox',
              name: 'label_style',
              label: '风格',
              'values': [{
                text: '灰色',
                value: 'default'
              },{
                text: '深蓝色',
                value: 'primary'
              },{
                text: '绿色',
                value: 'success'
              },{
                text: '浅蓝色',
                value: 'info'
              },{
                text: '土黄色',
                value: 'warning'
              },{
                text: '红色',
                value: 'danger'
              }]
            }],onsubmit: function(e) {
				var labelcontent = '<span class="label label-' + e.data.label_style + '">' + e.data.label_name + '</span>									';
              editor.insertContent(labelcontent);
            }
          });
        }},{text: '徽章',onclick: function() {
          editor.windowManager.open({
            title: '徽章',body: [{
              type: 'textbox',
              name: 'badge_name',
              label: '徽章名称',
              value: 'Default'
            }],onsubmit: function(e) {
				var badge_c = '<span class="badge">' + e.data.badge_name + '</span>';
              editor.insertContent(badge_c);
            }
          });
        }},{text: '带情景的面板',onclick: function() {
          editor.windowManager.open({
            title: '带情景的面板',body: [{
              type: 'textbox',
              name: 'panel_title',
              label: '标题',
              value: 'Zblog'
            },{
              type: 'textbox',
              name: 'panel_content',
              label: '内容',
              value: '博主很懒，没有写内容',
              multiline: true,
              minWidth: 300,
              minHeight: 100
            },{
              type: 'listbox',
              name: 'panel_style',
              label: '风格',
              'values': [{
                text: '灰色',
                value: 'default'
              },{
                text: '深蓝色',
                value: 'primary'
              },{
                text: '绿色',
                value: 'success'
              },{
                text: '浅蓝色',
                value: 'info'
              },{
                text: '土黄色',
                value: 'warning'
              },{
                text: '红色',
                value: 'danger'
              }]
            }],onsubmit: function(e) {
				var panel_c = '<div class="panel panel-' + e.data.panel_style + '">\
									<div class="panel-heading">\
									<div class="panel-title">' + e.data.panel_title + '</div>\
									</div>\
									<div class="panel-body">\
									' + e.data.panel_content + '\
									</div>\
									</div>';
              editor.insertContent(panel_c);
            }
          });
        }},{text: '折叠内容',onclick: function() {
          editor.windowManager.open({
            title: '折叠内容',body: [{
              type: 'textbox',
              name: 'collapse_title',
              label: '显示标题',
              value: '这里是显示的按钮'
            },{
              type: 'textbox',
              name: 'collapse_id',
              label: '折叠ID',
              value: 'collapse_id'
            },{
              type: 'listbox',
              name: 'collapse_title_style',
              label: '按钮风格',
              'values': [{
                text: '灰色',
                value: 'default'
              },{
                text: '深蓝色',
                value: 'primary'
              },{
                text: '绿色',
                value: 'success'
              },{
                text: '浅蓝色',
                value: 'info'
              },{
                text: '土黄色',
                value: 'warning'
              },{
                text: '红色',
                value: 'danger'
              }]
            },{
              type: 'textbox',
              name: 'collapse_content',
              label: '内容',
              value: '博主很懒，没有写内容',
              multiline: true,
              minWidth: 300,
              minHeight: 100
            }],onsubmit: function(e) {
				var collapse_c = '<a class="btn btn-' + e.data.collapse_title_style + '" role="button" data-toggle="collapse" href="#' + e.data.collapse_id + '" aria-expanded="false" aria-controls="' + e.data.collapse_id + '">\
							' + e.data.collapse_title + '\
							</a>\
							<div class="collapse" id="' + e.data.collapse_id + '">\
							<div class="well">\
							' + e.data.collapse_content + '\
							</div>\
							</div>';
              editor.insertContent(collapse_c);
            }
          });
        }}
		]
		}]
  });
});
 
})();