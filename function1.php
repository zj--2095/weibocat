<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$a=array();
for($i=1; $i<20; $i++)
{	
	$user_message = $c->home_timeline($i);
	for ($x=0; $x<100; $x++)
	{
	  if (isset($user_message['statuses'][$x]['text'])) 
		{
			$count=(($i-1)*100+$x+1);
			echo $count.".".$user_message['statuses'][$x]['text']."<br>";
			array_push($a,$user_message['statuses'][$x]['text'].' ');
		};
	};
}
$_SESSION['count']=$count;
$_SESSION['data'] = $a;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>腾讯玄武实验室爬虫</title>
</head>

<body>
	




</body>
</html>
