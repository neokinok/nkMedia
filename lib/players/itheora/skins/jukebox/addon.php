<?php 
echo '<img src="'.substr($playlist, 0, -5).'.jpg" class="album" alt="" />';
?>

<script type="text/javascript" src="lib/scroll/mootools.js"></script>

<script type="text/javascript">
    window.addEvent('domready', function(){
        var scroll = new Scroller('container', {area: 100, velocity: 1});
        $('container').addEvent('mouseover', scroll.start.bind(scroll));
        $('container').addEvent('mouseout', scroll.stop.bind(scroll));
    });
</script>
</head>
<body>
<div id="container">
<?php
$rep = "data/jukebox/"; $dir = opendir($rep); 
$nb_playlist=0;
while ($f = readdir($dir)) {
	if(is_file($rep.$f) && substr($f, -5, 5)==".xspf") {
		$nb_playlist=$nb_playlist+1;
	}
}
closedir($dir);
?>
    <div class="slider" style="width : <?php echo ($nb_playlist*60)?>px;">
<?php		
$dir = opendir($rep);
while ($f = readdir($dir)) {
	if(is_file($rep.$f) && substr($f, -5, 5)==".xspf") {
		echo '<a href="index.php?v=jukebox/'.$f.'&amp;s=jukebox&amp;w='.$wplay.'&amp;h='.$hplay.'">';
		if(file_exists($document_root.$ipath.'data/jukebox/'.substr($f, 0, -5).'.jpg')) {
			echo '<img src="http://'.$ihost.$ipath.'data/jukebox/'.substr($f, 0, -5).'.jpg"';
		}  else {
			echo '<img src="http://'.$ihost.$ipath.'skins/jukebox/vorbis.jpg"';
		}
		echo ' class="albums"  onmouseover="this.style.width=\'60px\'; this.style.height=\'60px\';this.style.margin=\'0px\';" onmouseout="this.style.width=\'50px\'; this.style.height=\'50px\';this.style.margin=\'5px\';" alt="'.$f.'" /></a>';
	}
}
closedir($dir);
?>
    </div>
</div>