<?php 
require_once("config/admin.php");
require_once("../lib/fonctions.php");

$save=false;
$save = getp('save');
echo '<h1>'.txt($ca_title).'</h1>';

if(!$save) { // Formulaire pour configurer
echo '
<form action="'.$_SERVER['REQUEST_URI'].'" method="post"><div>
	'.txt($ca_param_connect).'<br />
	<table cellpadding="3px" cellspacing="0" border="0" class="indent">
	<tr><td>'.txt($ca_admin_username).'</td><td><input type="text" name="admin_username" value="'.$admin_username.'" /></td></tr>
	<tr><td>'.txt($ca_admin_pass).'</td><td><input type="password" name="admin_pass" value="'.$admin_pass.'" /></td></tr>
	<tr><td>'.txt($ca_admin_repass).'</td><td><input type="password" name="admin_repass" value="'.$admin_pass.'" /></td></tr>
	</table>
<br />
<br />
	'.txt($ca_param_upload).'<br />
	<table cellpadding="3px" cellspacing="0" border="0" class="indent">
	<tr><td>'.txt($ca_ftp_host).'</td><td><input type="text" name="ftp_host" value="'.$ftp_host.'" /></td></tr>
	<tr><td>'.txt($ca_ftp_username).'</td><td><input type="text" name="ftp_username" value="'.$ftp_username.'" /></td></tr>
	<tr><td>'.txt($ca_ftp_pass).'</td><td><input type="password" name="ftp_pass" value="'.$ftp_pass.'" /></td></tr>
	<tr><td>'.txt($ca_ftp_repass).'</td><td><input type="password" name="ftp_repass" value="'.$ftp_pass.'" /></td></tr>
	<tr><td>'.txt($ca_ftp_prefix).'</td><td><input type="text" name="ftp_prefix" value="'.$ftp_prefix.'" /></td></tr>
	<tr><td>'.txt($ca_ftp_dir).'</td><td><input type="text" name="ftp_dir" value="'.$ftp_dir.'" /></td></tr>
	</table>
	<p class="indent"><input type="submit" name="save" class="submit" value="'.txt($ca_save).'" /></p>
</div></form>';
}

if($save==txt($ca_save)) {
	if(getp('ftp_pass')!=getp('ftp_repass') || getp('admin_pass')!=getp('admin_repass')) {
		echo '<p>'.txt($ca_error).'</p>';
	} else {
	$file_config_admin='<?php'."\n";
	$file_config_admin .= (isset($_POST['ftp_host'])) ? '$ftp_host="'.$_POST['ftp_host'].'"; '."\n" : '$ftp_host="";'."\n"; 
	$file_config_admin .= (isset($_POST['ftp_username'])) ? '$ftp_username="'.$_POST['ftp_username'].'"; '."\n" : '$ftp_username="";'."\n"; 
	$file_config_admin .= (isset($_POST['ftp_pass'])) ? '$ftp_pass="'.$_POST['ftp_pass'].'"; '."\n" : '$ftp_pass="";'."\n"; 
	$file_config_admin .= (isset($_POST['ftp_prefix'])) ? '$ftp_prefix="'.$_POST['ftp_prefix'].'"; '."\n" : '$ftp_prefix="";'."\n"; 
	$file_config_admin .= (getp('ftp_dir')!="") ? '$ftp_dir="'.getp('ftp_dir').'"; '."\n" : '$ftp_dir="'.$ipath.'data";'."\n\n";
	
	$file_config_admin .= (isset($_POST['admin_username'])) ? '$admin_username="'.$_POST['admin_username'].'"; '."\n" : '$admin_username="";'."\n"; 
	$file_config_admin .= (isset($_POST['admin_pass'])) ? '$admin_pass="'.$_POST['admin_pass'].'"; '."\n" : '$admin_pass="";'."\n\n"; 
	$file_config_admin .= '?>';
	
	$old_file_config_admin= fopen("config/admin.php","w");
	fwrite($old_file_config_admin,$file_config_admin);
	fclose($old_file_config_admin);
	echo '<p>'.txt($ca_saved).'</p>';
	}
}
?>





