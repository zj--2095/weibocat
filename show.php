<?php

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript">
function setsubmit()
{
if(mylink.value == 0)
window.top.document.location='http://127.0.0.1:8081/weibocat/function1.php';
if(mylink.value == 1)
window.location='http://127.0.0.1:8081/weibocat/function3.php';
if(mylink.value == 2)
window.location='http://127.0.0.1:8081/weibocat/function2.php';
}
</script> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��Ѷ����ʵ��������</title>
</head>

<body>
<center>
ѡ�������
<br>
<br>
<select name="mylink" id="mylink">
<OPTION value="0">΢�������б�</OPTION>
<OPTION value="1">��ѯ����</OPTION>
<OPTION value="2">�������ݿ�</OPTION>
</select>
<br>
<br>
<input type="button" id="btn" value="�ύ" onclick="setsubmit(this)" /> 
</center>
</body>
</html>