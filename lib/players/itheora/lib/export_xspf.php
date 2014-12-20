<?
include ("fonctions.php");

$track = getp('location_tk_1');

$file=getp('file');
$image=getp('p');
$name = (getp('n')!="") ? getp('n') : $file ;
$time=getp('t');

if(url_to_ext($file)=="xspf") {
	header('Content-Type: application/force-download; name="'.url_to_file($file).'"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Disposition: attachment; filename="'.url_to_file($file).'"');
	header('Expires: 0');
	header('Cache-Control: no-cache, must-revalidate');
	header('Pragma: no-cache');
	$handle = @fopen ($file, "r");
	if($handle) {
		while(!feof($handle)) { $data .= fgets($handle,1024); }  
	}
	echo $data;
  	@fclose ($handle);
	exit();
} elseif($file!="") {
	header('Content-Type: application/force-download; name="'.url_to_file($file).'.xspf"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Disposition: attachment; filename="'.url_to_file($file).'.xspf"');
	header('Expires: 0');
	header('Cache-Control: no-cache, must-revalidate');
	header('Pragma: no-cache');
echo '<?xml version="1.0" encoding="UTF-8"?>
<playlist version="0" xmlns="http://xspf.org/ns/0/">
	<title>'.$name.'</title>
	<trackList>
		<track>
			<location>'.$file.'</location>
			<image>'.$image.'</image>
			<duration>'.$time.'000</duration>
		</track>
	</trackList>
</playlist>
';
exit();
} elseif($track!="") { 
	header('Content-Type: application/force-download; name="playlist.xspf"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Disposition: attachment; filename="playlist.xspf"');
	header('Expires: 0');
	header('Cache-Control: no-cache, must-revalidate');
	header('Pragma: no-cache');
echo '<?xml version="1.0" encoding="UTF-8"?>
<playlist version="0" xmlns="http://xspf.org/ns/0/">
	<title>'.getp('title').'</title>
	<creator>'.getp('creator').'</creator>
	<info>http://'.$_SERVER['SERVER_NAME'].'</info>
	<trackList>';
	$i=1;
	while (getp('location_tk_'.$i.'')!="") {
	echo '
		<track>
			<location>'.getp('location_tk_'.$i.'').'</location>';
		if(getp('creator_tk_'.$i.'')!="") {
		echo '
			<creator>'.getp('creator_tk_'.$i.'').'</creator>';
		}
		if(getp('album_tk_'.$i.'')!="") {
		echo '
			<album>'.getp('album_tk_'.$i.'').'</album>';
		}
		if(getp('title_tk_'.$i.'')!="") {
		echo '
			<title>'.getp('title_tk_'.$i.'').'</title>';
		}
		if(getp('duration_tk_'.$i.'')!="") {
		echo '
			<duration>'.h_to_s(getp('duration_tk_'.$i.'')).'000</duration>';
		}
		if(getp('image_tk_'.$i.'')!="" && strstr(getp('image_tk_'.$i.''), "tp://")) {
		echo '
			<image>'.getp('image_tk_'.$i.'').'</image>';
		}
		if(getp('info_tk_'.$i.'')!="" && strstr(getp('info_tk_'.$i.''), "tp://")) {
		echo '
			<info>'.getp('info_tk_'.$i.'').'</info>';
		}
		if(getp('meta_tk_'.$i.'')!="" && strstr(getp('license_tk_'.$i.''), "tp://")) {
		echo '
			<meta rel="'.getp('meta_tk_'.$i.'').'">'.getp('meta_tk_'.$i.'').'</meta>';
		}
	echo'
		</track>';
	$i=$i+1;
	}
echo '		
	</trackList>
</playlist>
';
}
?>
