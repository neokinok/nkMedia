<?php 
if(!isset($_POST['v'])) {
// Recherche l'adresse de la video sur blip.tv
	$chaine = "";
	$blip = isset($_GET["url"]) ? $_GET["url"] : "0";   
	$fp=@fopen($blip,"r"); 
	if($fp) {
		while(!feof($fp)) { $chaine .= fgets($fp,1024);	}  
	}  
	$masque1 = '#http://(.*?).ogg"#i'; // adresse
	$masque2 = '#<title>(.*?)</title>#i'; // nom
	$masque3 = '#player.setWidth\((.*?)000\);#i'; // largeur
	$masque4 = '#player.setHeight\((.*?)000\);#i'; // hauteur
	preg_match_all("$masque1",$chaine,$out1,PREG_SET_ORDER);// 1ere occurence
	preg_match_all("$masque2",$chaine,$out2,PREG_SET_ORDER); 
	preg_match_all("$masque3",$chaine,$out3,PREG_SET_ORDER); 
	preg_match_all("$masque4",$chaine,$out4,PREG_SET_ORDER); 
	
// Fin de la recherche

?>
<h1><?php echo txt($c_title)?></h1>
<form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post">
<div>
<br />
<p class="indent"><?php echo txt($c_v)?> <span style="color: red">*</span></p>
<input type="text" name="v" size="50" maxlength="500" class="indent" <?php if($blip!="0") { echo "value=\"http://".$out1[0][1].".ogg\"";}?> />
<p style="width : 600px;"><?php if(file_exists("../lib/neolao.swf")) {echo txt($c_vtxt1).'<br />' ;} ?><?php echo txt($c_vtxt1b)?><br /><br /><?php echo txt($c_vtxt2)?><a href="javascript:document.location='http://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']; ?>?url='+escape(window.location);"><?php echo txt($c_title)?></a>. <?php echo txt($c_vtxt3)?></p>

<p class="indent"><?php echo txt($c_n)?></p>
<input type="text" name="n" size="50" maxlength="500" class="indent" <?php if($blip!="0") { echo "value=\"".$out2[0][1]."\"";}?> /><br /><br />

	<table cellpadding="3px" cellspacing="0" border="0" class="indent" >
		<tr><td><?php echo txt($c_t)?></td><td><input type="text" name="t" size="10" maxlength="10" /></td>
		<td><div style="margin-left:30px"><?php echo txt($c_w)?></div></td><td><input type="text" name="w" size="5" maxlength="10" <?php if($blip!="0" && isset($out3[0][1])) { echo 'value="'.$out3[0][1].'"';}?> /> px</td></tr>
		<tr><td></td><td></td>
		<td><div style="margin-left:30px"><?php echo txt($c_h)?></div></td><td><input type="text" name="h" size="5" maxlength="10" <?php if($blip!="0" && isset($out4[0][1])) { echo 'value="'.$out4[0][1].'"';}?> /> px</td></tr>
	</table>

<p style="width:600px"><?php echo txt($c_auto)?></p>

<p class="indent"><?php echo txt($c_s)?>
<select name="s" >
<?php
$rep = "../skins/"; $dir = opendir($rep); 
	echo '<option value="defaut">defaut</option>';
while ($f = readdir($dir)) {
	if(is_dir($rep.$f) && ($f!="." && $f!=".." && $f!="defaut")) {
		echo '<option value="'.$f.'">'.$f.'</option>';
	}
}
closedir($dir);
?>
</select>
</p><br /><br />

<?php echo txt($c_alt)?><input type="checkbox" onclick="var replydisplay=document.getElementById('alternatifs').style.display ? '' : 'none';document.getElementById('alternatifs').style.display = replydisplay;" /><br /><br />
<div id="alternatifs" style="display: none;">

<p class="indent"><?php echo txt($c_p)?></p>
<input type="text" name="p" size="50" maxlength="500" class="indent" /><br /><br />

<p class="indent"><?php echo txt($c_b)?></p>
<input type="text" name="b" size="50" maxlength="500" class="indent" /><br /><br />

<p class="indent"><?php echo txt($c_f)?></p>
<input type="text" name="f" size="50" maxlength="500" class="indent" /><br /><br />
</div>

<?php echo txt($c_adv)?><input type="checkbox" onclick="var replydisplay=document.getElementById('advanced').style.display ? '' : 'none';document.getElementById('advanced').style.display = replydisplay;" /><br /><br />
<div id="advanced" style="display: none;">
	<table cellpadding="3px" cellspacing="0" border="0" class="indent">
	<tr>
		<td><?php echo txt($c_dm)?></td><td><input type="checkbox" name="dm" value="m" checked="checked" /></td>
		<td><?php echo txt($c_di)?></td><td><input type="checkbox" name="di" value="i" checked="checked" /></td>
		<td><?php echo txt($c_dt)?></td><td><input type="checkbox" name="dt" value="t" checked="checked" /></td>
		<td><?php echo txt($c_dn)?></td><td><input type="checkbox" name="dn" value="n" checked="checked" /></td>
	</tr><tr>
		<td><?php echo txt($c_db)?><?php echo txt($c_ds)?></td><td><input type="checkbox" name="ds" value="s" checked="checked" /></td>
		<td><?php echo txt($c_dd)?></td><td><input type="checkbox" name="dd" value="d" checked="checked" /></td>
		<td><?php echo txt($c_df)?></td><td><input type="checkbox" name="df" value="f" checked="checked" /></td>
		<td><?php echo txt($c_do)?></td><td><input type="checkbox" name="do" value="o" checked="checked" /></td>
	</tr><tr>
		<td><?php echo txt($c_l)?></td><td></td>
		<td><select name="l" >
<?php $rep = "../lang/"; $dir = opendir($rep); 
	echo "<option value=\"".$lg." auto\">".$lg." auto</option>";
while ($f = readdir($dir)) {
	if(is_dir($rep.$f)) {
		echo "<option value=\"".substr($f, 5, 2)."\">".substr($f, 5, 2)."</option>";
	}
}
closedir($dir);
?></select></td>
	</tr>
	</table>
<br />
</div>
<p class="indent"><input type="submit" class="submit" value="<?php echo txt($c_ok)?>" /></p>
</div>
</form>
<p><span style="color: red">*</span> <?php echo txt($c_nota)?> </p>

<?php 
} else {
//--------------------------------------------Code Engine ----------------------------------------------------------//

if ($handle = @fopen('../skins/'.$_POST['s'].'/style.php', "r")) {
	$dataskin=@fread($handle,5000); // ce qu'on cherche est au debut du fichier
	fclose($handle);
	$masque1 = '#wskin=(.*?);#i'; 
	$masque2 = '#hskin=(.*?);#i'; 
	preg_match_all("$masque1",$dataskin,$out1,PREG_SET_ORDER);
	preg_match_all("$masque2",$dataskin,$out2,PREG_SET_ORDER);

	$wskin = (isset($out1[0][1])) ? $out1[0][1] : $wskin=20;
	$hskin = (isset($out2[0][1])) ? $out2[0][1] : $hskin=40;
} 

if($_POST['w']!="") { $wpar = "&w=".($_POST['w']+$wskin) ;} else { $wpar = "";};
if($_POST['h']!="") { $hpar = "&h=".($_POST['h']+$hskin) ;} else {$hpar = "" ;};

$d="";
if(!isset($_POST['dm'])) { $d = $d."m";}
if(!isset($_POST['di'])) { $d = $d."i";}
if(!isset($_POST['dt'])) { $d = $d."t";}
if(!isset($_POST['dn'])) { $d = $d."n";}

if(!isset($_POST['ds'])) { $d = $d."s";}
if(!isset($_POST['dd'])) { $d = $d."d";}
if(!isset($_POST['df'])) { $d = $d."f";}
if(!isset($_POST['do'])) { $d = $d."o";}

if(isset($_POST['v'])) {
	if(file_exists("../data/".$_POST['v'])) {
		$vpar='v=http://'.$ihost.$ipath.'data/'.$_POST['v'];
	} elseif (!strstr($_POST['v'], 'tp://') && $_POST['v'][1]!='/') {
		$vpar='v=http://'.$ihost.'/'.$_POST['v'];
	} else {
		$vpar='v='.$_POST['v'];
	}
} else { $vpar="";}
$vpar = ep($vpar, 0);
// Conversion de t en secondes
if (($_POST['t'])!="") {
	$tpar="&t=".h_to_s($_POST['t']);
} else { $tpar="";}
if($_POST['s']!="defaut") { $spar="&s=".$_POST['s'];} else { $spar="";}
if($_POST['p']!="") { $ppar="&p=".$_POST['p'];} else { $ppar="";}
if($_POST['b']!="") { $bpar="&b=".$_POST['b'];} else { $bpar="";}
if($_POST['n']!="") { $npar="&n=".$_POST['n'];} else { $npar="";}
if($d=="") {$dpar="";} else { $dpar="&d=".$d;}

if($_POST['f']!="") { $fpar="&f=".$_POST['f'];} else { $fpar="";}
if($_POST['l']!="fr auto") { $lpar="&l=".$_POST['l'];} else { $lpar="";}

echo '<h1>'.txt($c_code).'</h1>
	<div style="text-align : left; margin-left : 50px; margin-right : 50px;">
	<code >';
	$par=$vpar.$tpar.$spar.$ppar.$bpar.$npar.$dpar.$fpar.$lpar.$wpar.$hpar;
	$itheora_code=true;
	include ($itheora="../index.php");
	echo '</code>
	</div>';

// Apercu
echo '<h1>'.txt($c_overview).'</h1>
	<div style="margin-left: 20px;">';
	$par=$vpar.$tpar.$spar.$ppar.$bpar.$npar.$dpar.$fpar.$lpar.$wpar.$hpar;
	include ($itheora="../index.php");
	echo '</div>';
}
?>
