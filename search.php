
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript">
</script> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LAB-SPIDER</title>
</head>

<body>
<?php
$keyword=$_GET['keyword'];
mysql_connect('localhost','root','');
mysql_select_db('weibocat');//Êý¾Ý¿âÑ¡Ôñ
mysql_query("SET NAMES 'UTF8'");
mysql_query("SET CHARACTER SET UTF8");
mysql_query("SET CHARACTER_SET_RESULTS=UTF8'");
$sql="SELECT * FROM message WHERE msg LIKE '%".$keyword."%'";
$query = mysql_query($sql);
$count=0;
while($row=mysql_fetch_array($query))
{
	$count=$count+1;
	echo $count."."."Message:".$row[0]."<br>";
	echo "    "."Url:".$row[1]."<br>";
	
}
?>
</form>

</body>
</html>