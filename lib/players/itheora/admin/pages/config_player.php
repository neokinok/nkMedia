<?php require_once("config/player.php");
require_once("../lib/fonctions.php");
function ischecked($param) {
	if($param==true) { return 'checked="checked"'; } else { return ''; }
}
$save=false;
$save = getp('save');
echo '<h1>'.txt($cp_title).'</h1>';

if(!$save) { // Formulaire pour configurer
echo '
<form action="'.$_SERVER['REQUEST_URI'].'" method="post"><div>
	<p class="indent">'.txt($cp_itheora_title).'<input type="text" name="itheora_title" value="'.$title.'" /></p>
	<br />'.txt($cp_options_enable).'<br />
	<table cellpadding="3px" cellspacing="0" border="0" class="indent">
	<tr>
		<td>'.txt($cp_dm).'</td><td><input type="checkbox" name="dm" value="m" '.ischecked($function_manual_play).' /></td>
		<td>'.txt($cp_di).'</td><td><input type="checkbox" name="di" value="i" '.ischecked($function_info).' /></td>
		<td>'.txt($cp_dt).'</td><td><input type="checkbox" name="dt" value="t" '.ischecked($function_ts).' /></td>
		<td>'.txt($cp_dn).'</td><td><input type="checkbox" name="dn" value="n" '.ischecked($function_name).' /></td>
	</tr><tr>
		<td>'.txt($cp_db).''.txt($cp_ds).'</td><td><input type="checkbox" name="ds" value="s" '.ischecked($function_share).' /></td>
		<td>'.txt($cp_dd).'</td><td><input type="checkbox" name="dd" value="d" '.ischecked($function_download).' /></td>
		<td>'.txt($cp_df).'</td><td><input type="checkbox" name="df" value="f" '.ischecked($function_fullscreen).' /></td>
		<td>'.txt($cp_do).'</td><td><input type="checkbox" name="do" value="o" '.ischecked($function_options).' /></td>
	</tr>
	<tr><td colspan="3">'.txt($cp_de).'</td><td><input type="checkbox" name="de" value="e" '.ischecked($function_error_but).' /></td>
	<td colspan="3">'.txt($cp_dpod).'</td><td><input type="checkbox" name="dpod" value="pod" '.ischecked($function_podcast).' /></td></tr>
	<tr><td colspan="3">'.txt($cp_dad).'</td><td><input type="checkbox" name="dad" value="ad" '.ischecked($function_alt_download).' /></td></tr>
	</table>
	
	<p>'.txt($cp_wl).'</p>
	<p class="indent">'.txt($cp_txt_wl).'</p>
	<textarea rows="5" cols="80" name="white" class="indent">';
		for($i=0; $i<count($whitelist); $i++) {
			if($whitelist[$i]!="") { // nettoie la liste au passage
				echo "$whitelist[$i]\n";
			}
		}
	echo '</textarea>
	<p>'.txt($cp_bl).'</p>
	<p class="indent">'.txt($cp_txt_bl).'</p>
	<textarea rows="10" cols="80" name="black" class="indent">';
		for($i=0; $i<count($blacklist); $i++) {
			if($blacklist[$i]!="") { // nettoie la liste au passage
				echo "$blacklist[$i]\n";
			}
		}
	echo '</textarea>
	<p class="indent">'.txt($cp_txt_ex).'</p>
	<br />
<p class="indent"><input type="submit" name="save" class="submit" value="'.txt($cp_save).'" /></p>
</div></form>
';
}

if($save==txt($cp_save)) {
	$file_config_player='<?php'."\n";
	$file_config_player .= (getp('itheora_title')!="") ? '$title="'.txt(getp('itheora_title')).'"; '."\n" : '$title="ITheora, I really broadcast myself";'."\n\n"; 
	$file_config_player .= (!isset($_POST['dm'])) ? '$function_manual_play=false; '."\n" : '$function_manual_play=true;'."\n"; 
	$file_config_player .= (!isset($_POST['di'])) ? '$function_info=false;'."\n" : '$function_info=true;'."\n"; 
	$file_config_player .= (!isset($_POST['dt'])) ? '$function_ts=false;'."\n" : '$function_ts=true;'."\n"; 
	$file_config_player .= (!isset($_POST['dn'])) ? '$function_name=false;'."\n\n" : '$function_name=true;'."\n\n"; 
	
	$file_config_player .= (!isset($_POST['ds'])) ? '$function_share=false;'."\n" : '$function_share=true;'."\n"; 
	$file_config_player .= (!isset($_POST['dd'])) ? '$function_download=false;'."\n" : '$function_download=true;'."\n"; 
	$file_config_player .= (!isset($_POST['df'])) ? '$function_fullscreen=false;'."\n" : '$function_fullscreen=true;'."\n"; 
	$file_config_player .= (!isset($_POST['do'])) ? '$function_options=false;'."\n\n" : '$function_options=true;'."\n\n"; 
	
	$file_config_player .= (!isset($_POST['de'])) ? '$function_error_but=false;'."\n" : '$function_error_but=true;'."\n"; 
	$file_config_player .= (!isset($_POST['dpod'])) ? '$function_podcast=false;'."\n" : '$function_podcast=true;'."\n"; 
	$file_config_player .= (!isset($_POST['dad'])) ? '$function_alt_download=false;'."\n\n" : '$function_alt_download=true;'."\n\n"; 
	
	$new_blacklist=explode("%", txtjs(str_replace(" ", "", str_replace("\n", "%", $_POST['black']))));
	$new_whitelist=explode("%", txtjs(str_replace(" ", "", str_replace("\n", "%", $_POST['white']))));
	
	$file_blacklist="";
	for($i=0; $i<count($new_blacklist); $i++) {
		$file_blacklist = $file_blacklist.($i).' => "'.$new_blacklist[$i].'", ';
	}
	$file_blacklist = ($file_blacklist!="") ? $file_blacklist="Array ( ".substr($file_blacklist, 0, -2). " )" : 0;
	
	$file_whitelist="";
	for($i=0; $i<count($new_whitelist); $i++) {
		$file_whitelist = $file_whitelist.($i).' => "'.$new_whitelist[$i].'", ';
	}
	$file_whitelist = ($file_whitelist!="") ? $file_whitelist="Array ( ".substr($file_whitelist, 0, -2). " )" : 0;
	
	$file_config_player .= '$blacklist = '.$file_blacklist."; \n";
	$file_config_player .= '$whitelist = '.$file_whitelist."; \n";
	$file_config_player .= '?>';
	
	$old_file_config_player= fopen("config/player.php","w");
	fwrite($old_file_config_player,$file_config_player);
	fclose($old_file_config_player);
	echo '<p>'.txt($cp_saved).'</p>';
}?>





