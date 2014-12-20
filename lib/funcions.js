function resizeIframe(idIframe)
{
 var miIframe=document.getElementById(idIframe);
 var alturaPagina=miIframe.contentWindow.document.body.scrollHeight;
 miIframe.style.height=alturaPagina;
}

function cargaLive(src) {
 titol="Streaming";
 descr="<br>Not available. Coming Soon"; 
 document.getElementById('tv').src = src;
 document.getElementById('descr').innerHTML=descr;
 //location = "#tv";
}

function cargaFLV(num,src,titol,descr) {
 str = "flvplayer.php?num="+num+"&src="+src;
 document.getElementById('tv').src = str;
}

function changeTitle(title) {
 document.getElementById('titol').innerHTML=title;
 alert ('titol canviat per '+title);
}

function gotop() {
  location = "http://www.neokinok.tv/greenpeace/index.php#comments";
}

function switchChatMediabase() {
  if (document.getElementById('mediaChat').src=="http://surpas09.neokinok.tv/lib/phpfreechat/index.php") srcload="http://surpas09.neokinok.tv/mediabase.php"; else srcload="http://surpas09.neokinok.tv/lib/phpfreechat/index.php";
  document.getElementById('mediaChat').src=srcload;

}

function buttonOn (mybut) {
  mybut.style.backgroundColor='#ffffff';
   $(mya).css("color","#888888");
}

function buttonOff (mybut,mya) {
  mybut.style.backgroundColor='#990000';
  $(mya).css("color","#ff0000");
//  $("#"+mya).css('color:#888888');
  
}

function golive() {
document.getElementById('mediaChat').src = "/lib/xat/?u=<?=$_GET['u']?>";
}

function startproducer() {
 document.getElementById('mediaChat').src = "/producer.php?u=<?=$_GET['u']?>";
  //admin/playerconf.php
 <? $htm= "<table width=95%><tr><td>Emision is offline : <a href=\'#\'><b>GO LIVE</b></a></td><td align=\'right\'>Online users: 0</td></tr></table><br>"; ?>
 $('#botvideo').html("<?=$htm?>");
}

function startmediabase() {
  document.getElementById('mediaChat').src = "/mediabase.php?u=<?=$_GET['u']?>";
}

function startabout() {
  document.getElementById('mediaChat').src = "/about.php?u=<?=$_GET['u']?>";
}

$('ul#menu li div').onmousedown=function() {
	alert($('#menu').attr('name'));
}
