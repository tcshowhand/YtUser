<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
<script type="text/javascript" src="../../UEditor/dialogs/internal.js"></script>
<style>
body{padding:20px}
.c-table{font-weight: 900;float:left;width:100%;}
.c-table tr{margin:0 0 10px 0;padding:0;width:100%;float:left;line-height:35px;}
.c-table td{margin: 0;padding: 0;float:left;}
.c-title {width:15%;text-align:right;}
.c-input {width:35%;}
.c-inputt {width:85%;}
.c-input input{width:90%;height:28px}
.c-input select{width:90%;height:35px}
.c-inputt textarea{width:95%;height:50px;}
</style>
</head>
<body>
    <table class="c-table">
        <tr valign="middle">
            <td class="c-title">资源名称：</td>
            <td class="c-input" valign="middle"><input id="i-name" type="text"/></td>
            <td class="c-title">文件类型：</td>
            <td class="c-input"><input id="i-type" type="text"/></td>
        </tr>
        <tr>
            <td class="c-title">文件大小：</td>
            <td class="c-input" valign="middle"><input id="i-size" type="text"/></td>
            <td class="c-title">资源类型：</td>
            <td class="c-input"><select size="1" id="i-linktype">
<option selected="selected" value="">未选中</option>
<option value="xunlei">迅雷直链</option>
<option value="xuanfeng">QQ旋风</option>
<option value="local">本地下载</option>
<option value="netdisk">网盘链接</option>
<option value="magnet">磁力链接</option>
<option value="webpage">外部网页</option>
<option value="other">其他</option>
</select></td>
        </tr>
        <tr>
            <td class="c-title">下载链接：</td>
            <td class="c-input"><input id="i-url" type="text"/></td>
            <td class="c-title">链接说明：</td>
            <td class="c-input"><input id="i-rulnote" type="text"/></td>
        </tr>
        <tr>
            <td class="c-title">资源说明：</td>
            <td class="c-inputt" colspan="3"><textarea id="i-note" type="text"></textarea></td>
        </tr>

    </table>


<script>
    dialog.onok = function (){
        editor.execCommand('inserthtml', '');
    };
</script>

</body>
</html>