<?php
// Tableau des langues courantes... pour alt_download et podcast
$languages = array( 1 => "ca", 2 => "cs", 3 => "de", 4 => "en", 5 => "es", 
6 => "eo", 7 => "fr", 8 => "it", 9 => "hu", 10 => "nl", 11 => "ja", 12 => "no", 13 => "pl", 
14 => "pt", 15 => "ro", 16 => "sk", 17 => "fi", 18 => "sv", 19 => "tr", 20 => "uk", 21 => "vo", 
22 => "zh" );

// ----------------------------------------------------- Fonctions
// Fonction pour recuperer le parametre via POST ou GET
function getp($p) {
	if (isset($_GET[$p])) return ($_GET[$p]);
	if (isset($_POST[$p])) return ($_POST[$p]);
	return (false);
} 

// Fonction pour simplifier l'affichage du texte
function isUTF8($string){
   return (utf8_encode(utf8_decode($string)) == $string);
} 

function txt($text) {
	$text = str_replace("#",'', $text);
	return (isUTF8($text) ? htmlentities($text, ENT_QUOTES, 'UTF-8') : htmlentities($text, ENT_QUOTES, 'ISO-8859-1'));
}

function txtjs($text) {
	$text = str_replace("\n",'', $text);
	$text = str_replace("\r",'', $text);
	$text = str_replace("\t",'', $text);
	$text = str_replace("'","\'", $text);
	return $text;
}

function linktitle($tooltip) { // Fonction affichage du titre active
		return 'title="'.$tooltip.'" onmouseover="infobulle(\' '.$tooltip.' \')" onmouseout="infobulle()"';
}


// -------------------------------------------------Fonctions XML

/* xmlize() is by Hans Anderson, www.hansanderson.com/contact/
 Ye Ole "Feel Free To Use it However" License [PHP, BSD, GPL].
 some code in xml_depth is based on code written by other PHPers
 as well as one Perl script.  Poor programming practice and organization
 on my part is to blame for the credit these people aren't receiving.
 None of the code was copyrighted, though.

 This is a stable release, 1.0.  I don't foresee any changes, but you
 might check http://www.hansanderson.com/php/xml/ to see

 usage: $xml = xmlize($xml_data);

 See the function traverse_xmlize() for information about the
 structure of the array, it's much easier to explain by showing you.
 Be aware that the array is very complex.  I use xmlize all the time,
 but still need to use traverse_xmlize or print_r() quite often to
 show me the structure!
*/

function xmlize($data, $WHITE=1) {
	$data = trim($data);
	$vals = $index = $array = array();
	$parser = xml_parser_create();
	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
	xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, $WHITE);
	if(!xml_parse_into_struct($parser, $data, $vals, $index)) {
		die(sprintf("XML error: %s at line %d", xml_error_string(xml_get_error_code($parser)), xml_get_current_line_number($parser)));
	}
	xml_parser_free($parser);
	$i = 0;
	$tagname = $vals[$i]['tag'];
	$array[$tagname]['@'] =  ( isset ($vals[$i]['attributes'])) ? $vals[$i]['attributes'] : array();
	$array[$tagname]["#"] = xml_depth($vals, $i);
	return $array;
}

/* You don't need to do anything with this function, it's called by
 xmlize.  It's a recursive function, calling itself as it goes deeper
 into the xml levels.  If you make any improvements, please let me know.
*/

function xml_depth($vals, &$i) {
	$children = array();
	if(isset($vals[$i]['value'])) {
		array_push($children, $vals[$i]['value']);
	}
	while (++$i < count($vals)) {
		switch ($vals[$i]['type']) {
			case 'open' :
				$tagname = (isset($vals[$i]['tag'])) ? $vals[$i]['tag'] : '';
				$size = (isset($children[$tagname])) ? sizeof($children[$tagname]) : 0;
				if(isset($vals[$i]['attributes'])) {
					$children[$tagname][$size]['@'] = $vals[$i]["attributes"];
				}
				$children[$tagname][$size]['#'] = xml_depth($vals, $i);
			break;
			case 'cdata' :
				array_push($children, $vals[$i]['value']);
			break;
			case 'complete' :
				$tagname = $vals[$i]['tag'];
				$size = (isset($children[$tagname])) ? sizeof($children[$tagname]) : 0;
				$children[$tagname][$size]["#"] = (isset($vals[$i]['value'])) ? $vals[$i]['value'] : '';
				if(isset ($vals[$i]['attributes'])) {
					$children[$tagname][$size]['@'] = $vals[$i]['attributes'];
				}                       
			break;
			case 'close' : return $children; break;
		}
	}
        return $children;
}

/* function by acebone@f2s.com, a HUGE help!
 this helps you understand the structure of the array xmlize() outputs
 usage:
 traverse_xmlize($xml, 'xml_');
 print '<pre>' . implode("", $traverse_array . '</pre>';
*/

function traverse_xmlize($array, $arrName = "array", $level = 0) {
	foreach($array as $key=>$val) {
		if(is_array($val)) {
			traverse_xmlize($val, $arrName . "[" . $key . "]", $level + 1);
		} else {
			$GLOBALS['traverse_array'][] = '$' . $arrName . '[' . $key . '] = "' . $val . "\"\n";
		}
	}
	return 1;
}
// ------------------------------------ Fin Fonctions XML

// Fonction pour reecrire l'eperluette et le point d'interrogation en passant
function ep($text, $type) {
	switch ($type) {
		case 0 :	$text = str_replace("&", '%26', $text); break; // & convertis en base 16
		case 1 :	$text = str_replace("&", '&amp;', $text); break;// & convertis en &amp
		case 2 :	$text = str_replace("&", '&amp;amp;', $text); break; // & convertis en &amp;amp;
	}
	$text = str_replace("?", '%3F', $text); // ? convertis en base 16
	return $text;
}

function get_extra_query () {

$iquery = array( 1 => "v", 2 => "n", 3 => "t", 4 => "d", 5 => "s",
6 => "l", 7 => "x", 8 => "w", 9 => "h", 10 => "p", 11 => "b", 12 => "f",
13 => "out", 14 => "reload" );
	$url='';
	foreach ($_GET as $k => $v) {
	$url .= '&'.$k.'='.$v;
	}
	for($i=1; $i<=count($iquery); $i++) {
		if(isset($_GET[$iquery[$i]])) {
			$url=str_replace('&'.$iquery[$i].'='.$_GET[$iquery[$i]], '', $url);
		}
	}
	return $url;
}

function url_to_file($url) {
	$file=substr(strrchr($url, '/'), 1);
	return $file;
}

function url_to_ext($url) {
	$file=substr(strrchr($url, '.'), 1);
	return $file;
}

// Fonction pour tester l'url
function url_exists ($url, $ext) {
	if(strstr($url, "http://".$_SERVER['SERVER_NAME']."/") && $ext!="xml") { // if the url has the same host
		$file=str_replace("http://".$_SERVER['SERVER_NAME'], $_SERVER['DOCUMENT_ROOT'], $url); 
		if(!file_exists($file)) {return false;} // check if file exist locally and escape if not. Else check the url will not be a problem...
	}
	$handle = @fopen ($url, "r");
	if($handle) {
		switch ($ext) {
			case "ogg" : $file = (@fread ($handle, 4)=="OggS"); break; // utilise uniquement lorsque la video est en flash (pb de redirection)
			case "jpg" : $file = (@fread ($handle, 4)=="ÿØÿà"); break;
			case "torrent" : $file = (@fread ($handle, 4)=="d8:a"); break;
			case "flv" : $file = (@fread ($handle, 3)=="FLV"); break;
			case "xml" : $file = (@fread ($handle, 4)=="<?xm"); break;
			case "ext" : $start=@fread ($handle, 4); $file = (($start!="<!DO") && ($start!="<htm")); break; // verifie juste que l'extension est bonne et n'est pas une page html de redirection ou autre
			case "html" : $start=@fread ($handle, 4); $file = (($start=="<!DO") || ($start=="<htm")); break;
		}
		@fclose ($handle);
		return $file;
	} else { 
		return false;
	}
}

function s_to_h ($duration) {
	$hour = intval($duration/3600); $min = intval(($duration%3600)/60); $sec = ($duration%3600)%60;
	if ($min < 10) $min = "0".$min; if ($sec < 10) $sec = "0".$sec;
	if(!empty($hour)) { 
		return $hour.':'.$min.':'.$sec;
	} else {
		return $min.':'.$sec;
	}
}

function h_to_s ($duration) {
	if(strlen($duration)==8) {
		$hour = substr($duration, -8,2); $min = substr($duration,-5,2); $sec = substr($duration,-2,2);
		return (3600*$hour+60*$min+1*$sec);
	} else if(strlen($duration)==7) {
		$hour = substr($duration, -7,1); $min = substr($duration,-5,2); $sec = substr($duration,-2,2);
		return (3600*$hour+60*$min+1*$sec);
	} else if(strlen($duration)==5) {
		$min = substr($duration,-5,2); $sec = substr($duration,-2,2);
		return (60*$min+1*$sec);
	} else if(strlen($duration)==4) {
		$min = substr($duration,-4,1); $sec = substr($duration,-2,2);
		return (60*$min+1*$sec);
	} else {	
		return $duration;	
	}
}

function get_torrent ($url) {
	if(strstr($url, $_SERVER['SERVER_NAME'])) { // Video locale
		if(file_exists($_SERVER['DOCUMENT_ROOT'].str_replace('http://'.$_SERVER['SERVER_NAME'], '' ,$url).'.torrent')) {
			$torrent = $url.".torrent";
		} elseif(file_exists($_SERVER['DOCUMENT_ROOT'].substr(str_replace('http://'.$_SERVER['SERVER_NAME'], '' ,$url), 0, -4).'.torrent')) {
			$torrent = str_replace('.'.url_to_ext($url), '', $url).".torrent";
		} else {
			$torrent = "";
		}
	} else { // Video distante
		if(url_exists($url.".torrent", "torrent")) { // fichier de type *.ogx.torrent
			$torrent = $url.".torrent";
		} elseif(url_exists(str_replace('.'.url_to_ext($url), '', $url).".torrent", "torrent")) { // fichier de type *.torrent
			$torrent = str_replace('.'.url_to_ext($url), '', $url).".torrent";
		} else { 
			$torrent = "";
		}
	}
	return $torrent;
}

function get_coral ($url) {
	$parsed_url = parse_url ($url);
	$coral=str_replace($parsed_url['host'], $parsed_url['host'].".nyud.net:8090", $url);
	return $coral;
}

function get_jpg ($url) {
	if(strstr($url, "http://upload.wikimedia.org/")) { // Video chez wikimedia
		if(url_to_ext($url)=="ogv") {
		$image = str_replace('http://upload.wikimedia.org/wikipedia/commons/', 'http://upload.wikimedia.org/wikipedia/commons/thumb/', $url).'/mid-'.url_to_file($url).'.jpg';
		} else {
		$image = false;
		}
	} elseif(strstr($url, "http://blip.tv/")) { // Video chez blip.tv
		$image = $url.'.jpg';
	} elseif(strstr($url, "http://www.archive.org/")){ // No picture. There's a bug on archive.org (temp picture is loaded)
		$image=false;
	} elseif(strstr($url, $_SERVER['SERVER_NAME'])) { // Video locale
		if(file_exists($_SERVER['DOCUMENT_ROOT'].str_replace('http://'.$_SERVER['SERVER_NAME'], '' ,$url).'.jpg')) {
			$image = $url.'.jpg';
		} elseif(file_exists($_SERVER['DOCUMENT_ROOT'].substr(str_replace('http://'.$_SERVER['SERVER_NAME'], '' ,$url), 0, -4).'.jpg')) {
			$image = str_replace('.'.url_to_ext($url), '', $url).".jpg";
		} else {
			$image=false;
		}
	} else { // Video distante
		if(url_exists($url.".jpg", "jpg")) { // fichier de type *.ogx.jpg
			$image = $url.".jpg";		
		} elseif(url_exists(str_replace('.'.url_to_ext($url), '', $url).".jpg", "jpg")) { // fichier de type *.jpg
			$image = str_replace('.'.url_to_ext($url), '', $url).".jpg";
		} else { 
			$image = false;
		}
	}
	return $image;
}

function get_flv ($url) {
	if(strstr($url, "http://blip.tv/")) { // Video chez blip.tv
		$url_ex=explode('-', str_replace("http://blip.tv/file/get/", "", $url));
		$username=$url_ex[0];
		$data = implode("",file("http://".strtolower($username).".blip.tv/rss")) or die("could not open XML input file");
		$xml = xmlize($data); 
		$plsxml = $xml["rss"]["#"]["channel"][0]["#"]["item"]  ;
		$flv=""; 
		for ($i=0; $i<sizeof($plsxml); $i++) { // Scanne le flux rss de l'utilisateur
			if(isset($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"])) {
				for($j=0; $j<count($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"]); $j++) { // Cherche la position de l'url
					if(isset($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"][$j]["@"]["url"])) {
						if($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"][$j]["@"]["url"]==$url) { // Si trouvee
							for($k=0; $k<count($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"]); $k++) { // Cherche le flv equivalent
								if(isset($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"][$k]["@"]["url"])) {
									if(url_to_ext($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"][$k]["@"]["url"])=="flv") { // Touve
										$flv = $plsxml[$i]["#"]["media:group"][0]["#"]["media:content"][$k]["@"]["url"];
									}
								}
							}
						}
					}
				}
			}
		}
	} elseif(strstr($url, $_SERVER['SERVER_NAME'])) { // Video locale
		if(file_exists($_SERVER['DOCUMENT_ROOT'].str_replace('http://'.$_SERVER['SERVER_NAME'], '' ,$url).'.flv')) {
			$flv = $url.".flv";
		} elseif(file_exists($_SERVER['DOCUMENT_ROOT'].substr(str_replace('http://'.$_SERVER['SERVER_NAME'], '' ,$url), 0, -4).'.flv')) {
			$flv = str_replace('.'.url_to_ext($url), '', $url).".flv";
		} else {
			$flv = "";
		}
	} else { // Video distante
		if(url_exists($url.".flv", "flv")) { // fichier de type *.ogx.flv
			$flv = $url.".flv";
		} elseif(url_exists(str_replace('.'.url_to_ext($url), '', $url).".flv", "flv")) { // fichier de type *.torrent
			$flv = str_replace('.'.url_to_ext($url), '', $url).".flv";
		} else { 
			$flv = "";
		}
	}
	return $flv;
}

function get_first_video ($url, $ext) {
	$handle = @fopen ($url, "r");
	$data = "";
	for ($i=0; $i<300; $i++) { $data .= @fgets ($handle, 1024); }  
	if($ext=="xspf") { // Playlist XSPF
		$masque1 = '#<location>(.*?)</location>#i'; 
		preg_match_all("$masque1",$data,$out1,PREG_SET_ORDER);
	} else { // PODCAST	
		$masque1 = '#<enclosure .*?url="(.*?)"#i'; 
		preg_match_all("$masque1",$data,$out1,PREG_SET_ORDER);
	}
	$masque2 = '#<title>(.*?)</title>#i';  
	preg_match_all("$masque2",$data,$out2,PREG_SET_ORDER);
	@fclose ($handle);
	$out[0]="";$out[1]="";
	// Scanne la liste des (x premiers) fichiers media
	for ($i=0; $i<count($out1); $i++) { 
		if($out[0]=="" && (substr(url_to_ext($out1[$i][1]), 0, 2)=='og')) {
			$out[0]=$out1[$i][1];
		} 
	}
	if(isset($out2[1][1])) {
		$out[1]=str_replace("]]>", "", str_replace("<![CDATA[", "", $out2[1][1]));
	}
	return $out;
}

?>