<?
// HTML5 player
if ($chn['standby_pic']=="") $chn['standby_pic']="/img/colorbars.jpg";
if ($chn['player_controls']=="") $chn['player_controls']="controls";
else if ($chn['player_controls']=="none") $chn['player_controls']="";
if ($chn['player_autoplay']=="on") $chn['player_autoplay']="autoplay";
?>
<div class="box">
<video width="<?=$_GET['w']?>" id="video1" <?=$chn['player_controls']?> poster="<?=$chn['standby_pic']?>" <?=$chn['player_autoplay']?>>
<source src="<?=$url_video?>" type="video/ogg">
Your browser does not support HTML5 video tag.
</video>
</div>
<h3 style="color:#000;margin:0px"><?=$video['title']?></h3>

<div id="toolbox" style="height:200px;margin-top:5px">
<span onclick="getEmbed()" class="button">EMBED</span>
 <select onchange="setPlaySpeed(this.value)" ><option value="0.5">slow x0.5</option><option value="1">normal x1</option><option value="1.5">faster x1.5</option><option value="2">fastest x2</option><option value="3">ultra fast x3</option><option value="4">fast forward x4</option></select>
<span class="button" onclick="$('#producer_options').toggle('slow')">ADD METADATA</span>
<div id="producer_options" style="display:none">
<select id="metatype">
<option>image</option>
<option>comment</option>
<option>subtitle</option>
<option>transcription</option>
<option>link</option>
</select><br>
<textarea cols="50" rows="2" id="msg"></textarea><br>
<button onclick="saveCuePoint()" type="button">SAVE</button>
</div>
</div>

<script>
myVid=document.getElementById("video1");
function getEmbed() {
	prompt("Copy to clipboard: Ctrl+C, Enter","<video width=\"<?=$_GET['w']?>\" height=\"<?=$_GET['h']?>\" id=\"video1\" controls=\"controls\" poster=\"<?=$chn['standby_pic']?>\" <?=$chn['autoplay']?>><source src=\"http://www.experimentaltv.org/mediabase/<?=$_GET['u']?>/<?=$_GET['v']?>\" type=\"video/ogg\">Your browser does not support HTML5 video tag.</video>");
}
function setPlaySpeed(v) { 
  myVid.playbackRate=v;
} 
function setCurTime(go)
  { 
  myVid.currentTime=go;
  }
function enableControls()
  { 
  myVid.controls=true;
  myVid.load();
  } 
function disableControls()
  { 
  myVid.controls=false;
  myVid.load();
  } 
/*function addNewTextTrack()
  { 
  //still not supported by any browser 
  text1=myVid.addTextTrack("caption");
  text1.addCue(new TextTrackCue("Test text", 01.000, 04.000,"","","",true));
  } 
*/ 
function download() {
  alert(myVid.currentSrc);
}
function saveCuePoint() {
//	alert ('p='+myVid.currentTime+'&vid=<?=$_GET['v']?>&chn=<?=$_GET['u']?>&type='+$('#metatype').val()+'&val='+$('#msg').val());
	$.ajax({
                        url: "/lib/saveCuePoint.php",
                        type: "GET",
                        data: 'p='+myVid.currentTime+'&vid=<?=$_GET['v']?>&chn=<?=$_GET['u']?>&type='+$('#metatype').val()+'&val='+$('#msg').val(),
                        cache: false,
                        global: true,
                        dataType: "html",
                        success: function(msg){ 
                            alert('saved');
                         },
                        error: function (xhr, ajaxOptions, thrownError){
                            alert(xhr.status);
                        }
                    });
}
</script> 
