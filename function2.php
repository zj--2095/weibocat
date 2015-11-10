<?php
session_start();
include_once( 'simple_html_dom.php' );
include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
$rule  = "#(http://t.cn/).+?\w+#";
$content='#(\<p style\=\\\"color\: rgb\(167\, 167\, 167\)\;\\\"\> \\\")(.+?)(\\\"\<\\\/p\>)#';
$rule2="#(http://.+?/).+?\w+#";
$url=array();
mysql_connect('localhost','root','');
mysql_select_db('weibocat');//数据库选择
mysql_query("SET NAMES 'UTF8'");
mysql_query("SET CHARACTER SET UTF8");
mysql_query("SET CHARACTER_SET_RESULTS=UTF8'");

for($i=0;$i<($_SESSION['count']-1);$i++)
{
	if (isset($_SESSION['data'][$i]))
	{
	  #echo $_SESSION['data'][$i];
	  preg_match($rule,$_SESSION['data'][$i],$result);  
	 if(isset($result[0]))
	 {
		#echo $result[0]."<br>";
		array_push($url,$result[0]);
	  };
	  
	};
}
for($d=0;$d<1;$d++)
{
	if (isset($url[$d]))
	{
	$apiUrl='http://api.t.sina.com.cn/short_url/expand.json?source='.WB_AKEY.'&url_short='.$url[$d];
	$curlObj = curl_init();
	curl_setopt($curlObj, CURLOPT_URL, $apiUrl);
	curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curlObj, CURLOPT_HEADER, 0);
	curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
	$response = curl_exec($curlObj);
	curl_close($curlObj);
	$json = json_decode($response);
    $long_url = $json[0]->url_long;
	#echo $long_url;
	sleep(2);
	$curlObj1 = curl_init();
	curl_setopt($curlObj1, CURLOPT_URL, $long_url);
	curl_setopt($curlObj1, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curlObj1, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curlObj1, CURLOPT_HEADER, 0);
	curl_setopt($curlObj1, CURLOPT_HTTPHEADER, array('User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0','Host:weibo.com','Cookie:UOR=www.1626.com,widget.weibo.com,127.0.0.1:8081; SINAGLOBAL=9514746588622.535.1443449644967; ULV=1446771817104:56:9:9:3960578227687.1973.1446771817101:1446703835969; SUBP=0033WrSXqPxfM72wWs9jqgMF55529P9D9WWdzsTQYrUyEK-P_aNXBlkG5JpV2sfLUs8AI.Wrdg8DdF4odcXt; SUHB=0KAhZLTyAKR5Bq; un=760052139@qq.com; myuid=5748757748; YF-Ugrow-G0=56862bac2f6bf97368b95873bc687eef; SUB=_2AkMhYJCrdcNhrAZWnPASyWzlaIVXl12w6JyrQBmBRnpfMnoQgT5nqiRotBF_DN7nkUe6G6eAWZDCaAgMhcIZB_isX0Qnaq0.; YF-V5-G0=f59276155f879836eb028d7dcd01d03c; _s_tentry=login.sina.com.cn; Apache=3960578227687.1973.1446771817101; YF-Page-G0=82a2c733169b8fbd551fc09977b0f608; WBtopGlobal_register_version=0b6ec8a06b61dd96; login_sid_t=d30ca3e6bd7142753b6da01bd60acc5d'));
	$response = curl_exec($curlObj1);
	curl_close($curlObj1);
	sleep(2);
	preg_match_all($content,$response,$final);
	sleep(2);
	#print_r($final);
	for($g=0;$g<=30;$g++)
	{
		if (isset($final[2][$g]))
		{	
			$output=stripslashes($g.".".$final[2][$g]."<br>");
			#echo $output;
			preg_match($rule2,$output,$u);
			#echo $u[0]."<br>";
			sleep(2);
			if (isset($u[0]))
			{
				$sql='INSERT INTO message VALUES ('.'"'.$final[2][$g].'"'.','.'"'.$u[0].'"'.')';
				#echo $sql;
				$query = mysql_query($sql);
				#echo $query;
				if($query=0)
				{sleep(1);
				echo $url[$d]." is miss or exits"."<br>";}
				if($query=1)
				{
				echo $url[$d]." is complete"."<br>";
				}
			}
			sleep(5);
		}
	}
	};
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript">
</script> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LAB-SPIDER</title>
</head>

<body>


</body>
</html>