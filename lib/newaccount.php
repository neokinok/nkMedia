<?
session_start();
require "../includes/db.php";
require "../includes/functions.php";
require "../lib/mail.php";

if ($_POST['username']!=""&&$_POST['password']!=""&&$_POST['email']!=""&&$_POST['channel_name']!=""&&$_POST['suma']=="10") {

$insert="insert into nkm_channels (status,start_page,creation_date,upload_date,username,password,email,channel_name,meta_description) values (\"offline\",\"mediabase\",\"".date('Y-m-d H:i:s')."\",\"".date('Y-m-d H:i:s')."\",\"{$_POST['username']}\",\"{$_POST['password']}\",\"{$_POST['email']}\",\"{$_POST['channel_name']}\",\"{$_POST['meta_description']}\")";

$result=mysql_query($insert);
if (!$result) die (mysql_error().$insert);

if (file_exists('conf/'.$_POST['username'].'.txt')) {
mkdir ("../mediabase/".$_POST['username'],0777);  
chmod ("../mediabase/".$_POST['username'],0777);
mkdir ("../mediabase/".$_POST['username']."/thumb",0777);
chmod ("../mediabase/".$_POST['username']."/thumb",0777);
}

//header('location: /admin');
$admin_name="Daniel";
$admin_email="daniel@neokinok.tv";
$from="no-reply@".str_replace("www.","",$_SERVER['SERVER_NAME']);
$to=$_POST['email'];
$subject="Your new channel '{$_POST['channel_name']}' is ready";
$body="Welcome to experimentalTV.org,<br><br>Your ExperimentalTV account has been created and now you can start customizing your channel.<br><br>Channel url: <a href='http://www.experimentaltv.org/{$_POST['username']}'>http://www.experimentaltv.org/{$_POST['username']}</a><br>Administration login: <a href='http://www.experimentaltv.org/admin'>http://www.experimentaltv.org/admin</a><br><br>Username: ".$_POST['username']."<br>Password: ".$_POST['password']."<br><br>--<br>experimentaltv.org";
sendemail($from,$to,$subject,$body);

$from="no-reply@experimentaltv.org";
$to=ADMIN_EMAIL;
$subject="New channel '{$_POST['username']}' created on ExperimentalTV";
$body="Hello, <br><br>A new ExperimentalTV account has been created. <br><br>Channel url: <a href='http://www.experimentaltv.org/{$_POST['username']}'>http://www.experimentaltv.org/{$_POST['username']}</a><br>Administration login: <a href='http://www.experimentaltv.org/admin'>http://www.experimentaltv.org/admin</a><br><br>Username: ".$_POST['username']."<br>Password: ".$_POST['password']."<br><br>--<br>experimentaltv.org";
sendemail($from,$to,$subject,$body);

echo "Channel '<b>{$_POST['channel_name']}</b>' created: <br><a href='http://www.experimentaltv.org/{$_POST['username']}'>http://www.experimentaltv.org/{$_POST['username']}</a>";

} else {
	message("PLEASE FILL THE DATA FORM","error");
	include "../newaccount.php";
}
?>
