<?php
echo '<h1>'.txt($upload_title).'</h1>';
if(!strstr($ftp_host, $ihost) && !strstr($ftp_host, url_to_file($ihost))) {
	echo '<p>'.txt($upload_error).'</p>';
} else {
echo '<p>'.txt($upload_txt).'</p>';
echo '<div style="text-align : center">';
if (ereg("MSIE", getenv("HTTP_USER_AGENT"))) { // Applet java (code IE)
	echo '
	<object classid="clsid:8AD9C840-044E-11D1-B3E9-00805F499D93" width="450" height="300">
		<param name="code" value="ZUpload" />
		<param name="archive" value="pages/ZUpload.jar" />
		<param name="host" value="'.$ftp_host.'">
		<param name="user" value="'.$ftp_username.'">
		<param name="pass" value="'.$ftp_pass.'">
		<param name="path" value="'.$ftp_prefix.$ftp_dir.'">
		<param name="postscript" value="http://'.$ihost.$ascript.'">
	</object>
	';
} else { // Applet java (code !IE)
	echo '
	<object classid="java:ZUpload.class" type="application/x-java-applet"  width="450" height="300" archive="pages/ZUpload.jar" >
		<param name="archive" value="pages/ZUpload.jar" />
		<param name="host" value="'.$ftp_host.'">
		<param name="user" value="'.$ftp_username.'">
		<param name="pass" value="'.$ftp_pass.'">
		<param name="path" value="'.$ftp_prefix.$ftp_dir.'">
		<param name="postscript" value="http://'.$ihost.$apath.'">
	</object>
	';
}
echo '</div>';
}
?>