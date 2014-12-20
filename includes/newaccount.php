<?
$title = "Create your own ExperimentalTV Live Streaming Channel";
define ('BROWSER_TITLE',$title);

include "headers.php";

?>
<body>
<br>
<center><h1>Welcome to ExperimentalTV service</h1>
<h3><?=$title?></h3>

<form action="http://www.experimentaltv.org/lib/newaccount.php" method="POST">
<font size="2">
<table>
<tr><td>Username </td><td><input size="40" name="username" value="<?=$_POST['username']?>"></td></tr>
<tr><td>Password </td><td> <input size="40" name="password" value="<?=$_POST['password']?>"></td></tr>
<tr><td>Email </td><td> <input size="40" name="email" value="<?=$_POST['email']?>"></td></tr>
<tr><td>Channel Title </td><td><input size="40" name="channel_name" value="<?=$_POST['channel_name']?>"></td></tr>
<tr><td>URL (Optional) </td><td><input size="40" name="external_url" value="<?=$_POST['external_url']?>"></td></tr>
<tr><td>Channel description </td><td><input size="40" name="meta_description" value="<?=$_POST['meta_description']?>"></td></tr>
<tr><td>1+3+6=</td><td><input size="40" name="suma" value="<?=$_POST['suma']?>"></td></tr>
<tr><td></td><td><input type="submit" value="create channel"></td></tr>
</table>
</font>
</form>
<br>
<br>
<a href="index.php">return to ExperimentalTV main page</a></center>
</body>
