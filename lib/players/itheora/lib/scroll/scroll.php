<?php
if($function_podcast) {
	if($vhost==$ihost) { // Podcast local
		$scrolllist='http://'.$ihost.$ipath.'podcast.php?dir='.str_replace('/'.url_to_file($vpath), '', $vpath);
	} elseif ($vhost=="blip.tv") { // Podcast de blip.tv
		$scrolllist='http://'.strtolower($username).'.blip.tv/rss';
	}
	
	if(url_exists($scrolllist, "xml")) {
echo '
<script type="text/javascript">
	function infobulle(text) {
		if(text==null) { text= " ";}
		$("#info").html(text);
	}
</script>
<div id="container">
<div class="jMyCarousel"  />
	<ul>';
if(substr($scrolllist, -5, 5)==".xspf") { // Playlist XSPF
	$data = implode("",file($scrolllist)) or die("could not open XML input file");
        $xml = xmlize($data); 
	$plsxml = $xml["playlist"]["#"]["trackList"][0]["#"]["track"];

	for($i=0; $i< sizeof($plsxml); $i++) {
	// Liste des variables
		$p_location = $plsxml[$i]["#"]["location"][0]["#"];
		$p_title = isset($plsxml[$i]["#"]["title"][0]["#"]) ? $plsxml[$i]["#"]["title"][0]["#"] : "Track ".$i ;
		$p_image = isset($plsxml[$i]["#"]["image"][0]["#"]) ? $plsxml[$i]["#"]["image"][0]["#"] : "";
		if(substr($p_location,-4,3)==".og" && !strstr($p_location, "error.ogv")) {
		$size=$size+1;
		$slider=$slider.'<li><a href="http://'.$ihost.$iscript.'?v='.$p_location.'&amp;out=link"><img src="'.$p_image.'" class="albums"  onmouseover="this.style.width=\'138px\'; this.style.height=\'106px\';this.style.margin=\'0px\'; infobulle(\''.txtjs($p_title).'\')" onmouseout="this.style.width=\'128px\'; this.style.height=\'96px\';this.style.margin=\'5px\';  infobulle()" alt="'.$p_title.'" '.linktitle(txt($p_title)).' /></a></li>';
		}
	}
	echo $slider;
} else if(substr($scrolllist, -5, 5)!=".xspf") { // PODCAST
	$data = implode("",file($scrolllist)) or die("could not open XML input file");
	$xml = xmlize($data); 
	$plsxml = $xml["rss"]["#"]["channel"][0]["#"]["item"]  ;
	
$size=0; $slider="";
	for($i=0; $i< sizeof($plsxml) && $i<=20; $i++) {
	// Liste des variables
		if(strstr($scrolllist, "blip.tv/rss")) {
			$p_location=""; 
			if(isset($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"])) {
				for($j=0; $j<count($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"]); $j++) { 
					if(isset($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"][$j]["@"]["url"])) {
						if(substr($plsxml[$i]["#"]["media:group"][0]["#"]["media:content"][$j]["@"]["url"], -4, 3)==".og") {
							$p_location = $plsxml[$i]["#"]["media:group"][0]["#"]["media:content"][$j]["@"]["url"];
						}
					}
				}
			}
		} else {
		$p_location = isset($plsxml[$i]["#"]["enclosure"][0]["@"]["url"]) ? $plsxml[$i]["#"]["enclosure"][0]["@"]["url"] : "" ;
		}
		$p_title = isset($plsxml[$i]["#"]["title"][0]["#"]) ? $plsxml[$i]["#"]["title"][0]["#"] : "Track ".$i;
		$p_name_blip="";
		if(isset($plsxml[$i]["#"]["image"][0]["#"]["url"][0]["#"])) {
			$p_image = $plsxml[$i]["#"]["image"][0]["#"]["url"][0]["#"];
		} elseif(strstr($p_location, "http://blip.tv/")) { 
			$p_image = $p_location.'.jpg';
			$p_name_blip = '&amp;n='.$p_title;
		}
		if(substr($p_location,-4,3)==".og" && !strstr($p_location, "error.ogv")) {
		$size=$size+1;
		$slider=$slider.'<li><a href="http://'.$ihost.$iscript.'?v='.$p_location.$p_name_blip.'&amp;out=link"><img src="'.$p_image.'" class="albums"  onmouseover="this.style.width=\'138px\'; this.style.height=\'106px\';this.style.margin=\'0px\'; infobulle(\''.txtjs($p_title).'\')" onmouseout="this.style.width=\'128px\'; this.style.height=\'96px\';this.style.margin=\'5px\';  infobulle()" alt="'.txt($p_title).'"/></a></li>';
		}
	}
	echo $slider;
}
echo '</ul>
</div>
<div id="info"></div>
</div>
';
if ($size==1) {
echo '<script type="text/javascript">$("#container").hide();</script>
';
}
}
}
?>