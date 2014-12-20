<? 
$pagewidth=900;
session_start();
include "../includes/db.php";

if (($_POST['username']!="")) {
        $_SESSION['username']=$_POST['username'];
        $_SESSION['password']=$_POST['password'];
}

$sel="select * from nkm_channels where username='{$_SESSION['username']}'";
$result=mysql_query($sel);
if (!$result) { header('Location: http://'.$_SERVER['HTTP_HOST']); }
$chn=mysql_fetch_array($result);
if ($chn['language']!="") include "../locale/".$chn['language'].".php";
//include "../conf/".$_SESSION['username'].".php";
//include "../locale/".$chn['language'].".php";
if (($_SESSION['username']!=$chn['username'])||($_SESSION['password']!=$chn['password'])) {
	include "../includes/headers.php";
	//login
	echo "<br><center><h1>ExperimentalTV login</h1><br><br><br><form id='login' action='index.php' method='post'><table width='200'><tr><td>Username:</td><td><input type='text' name='username'></td></tr><tr><td>Password:</td><td><input type='password' name='password'></tr><tr><td></td><td><input type='submit' value='login'></td></tr></table></form>";
	echo "<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://".$_SERVER['HTTP_HOST']."\">go to home page</a></center>";
	exit;
}	
	$_SESSION['id']=$chn['id'];
	$_SESSION['logged']=true;
?>
