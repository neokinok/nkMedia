<?php 
$bouton_playlist= " ";
if($playlist!='0') { 

if($function_share) { 
	// URL
	$ecran_share_playlist_url = ' 
	<form action="" name="URLForm" id="URLForm">
		<textarea onclick="javascript:document.URLForm.code.focus();document.URLForm.code.select();" 
			id="code" name="code" class="code" readonly="readonly" />
			http://'.$ihost.$iscript.'?v='.ep($playlist.$sn.$sd.'&out=link', 3).'
		</textarea>
	</form>
	';
	// Code HTML valide W3C
	$ecran_share_playlist_w3c = ' 
	<form action="" name="W3CForm" id="W3CForm">
		<textarea onclick="javascript:document.W3CForm.code.focus();document.W3CForm.code.select();" 
			id="code" name="code" class="code" readonly="readonly" />
			&lt;object data="http://'.$ihost.$iscript.'?v='.ep($playlist.$st.$sb.$sn.$sp.$sd, 2).'" type="application/xhtml+xml" style="width: '.($x+20).'px; height: '.($y+40).'px;"&gt;
				\n\t&lt;!--[if IE]&gt;
					\n\t\t&lt;iframe src="http://'.$ihost.$iscript.'?v='.ep($playlist.$st.$sb.$sn.$sp.$sd, 2).'" style="width: '.($x+20).'px; height: '.($y+40).'px;" allowtransparency="true" frameborder="0" &gt;
					\n\t\t&lt;/iframe&gt;
				\n\t&lt;![endif]--&gt;
			\n&lt;/object&gt;
		</textarea>
	</form>
	';
if($function_ts) {
	if($lang='fr') { 
		$lang_ts='fr';
	} elseif($lang='es') {
		$lang_ts='es';
	} else {
		$lang_ts='en';
	}
	$ecran_share_playlist_ts = '<tr>
				<td><p><a href="http://'.$lang_ts.'.theorasea.org/submit.php?url=http://'.$ihost.$iscript.'?v='.$playlist.'" onclick="window.open(this.href); return false;">'.txt($txt_ts).'</a></p></td>
				<td>
					<div class="big_TS">
					<a href="http://'.$lang_ts.'.theorasea.org/submit.php?url=http://'.$ihost.$iscript.'?v='.$playlist.'" onclick="window.open(this.href); return false;"></a>
					</div>
				</td>
			</tr>';
} else {
	$ecran_share_playlist_ts = '';
}

	$ecran_share_playlist = '
	<div class="msg_share">
		<div class="msg">
			<p><a href="http://'.$ihost.$iscript.'?v='.ep($playlist.$sn.$sd.'&out=link', 3).'" onclick="window.open(this.href); return false;">'.txt($txt_url).'</a></p>
			<div class="codebox">
			'.$ecran_share_playlist_url.'
			</div>
			
			<p>'.txt($txt_embed).'</p>
			<div class="codebox">
			'.$ecran_share_playlist_w3c.'
			</div>
			
			<table><tr>
				<td><p><a href="mailto:?subject='.txt($txt_email_subject).'&amp;body=http://'.$ihost.$iscript.'?v='.ep($playlist.$sd.'&out=link', 0).'" onclick="window.open(this.href); return false;">'.txt($txt_email).'</a></p></td>
				<td>
					<div class="big_Email">
					<a href="mailto:?subject='.txt($txt_email_subject).'&amp;body=http://'.$ihost.$iscript.'?v='.ep($playlist.$sd.'&out=link', 0).'" onclick="window.open(this.href); return false;"></a>
					</div>
				</td>
				</tr>'.$ecran_share_playlist_ts.'</table>
		</div>		
	</div>
	';
	
echo '
<script type="text/javascript"><!--
	function share_playlist() { document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_share_playlist).'\'; bouton=\'\';}
//--></script>
	';

echo '
<script type="text/javascript"><!--
	var jaxtp = null; 
	if (window.XMLHttpRequest) {
		jaxtp = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		jaxtp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	function tab_playlist() {
		var divtp = document.getElementById("tab_playlist");
		jaxtp.open("GET", "lib/ajax/tab_playlist.php?url='.ep($playlist, 0).'&w='.$x.'&h='.$y.'&s='.$skin.'&l='.$lang.'", true); 
		jaxtp.onreadystatechange = function() {
			if (jaxtp.readyState == 4) {
				divtp.innerHTML = jaxtp.responseText;
				msg_playlist = \'<div class="msg_playlist"><div class="msg"><div id="tab_playlist">\'+ divtp.innerHTML +\'</div></div></div>\';
			}
		}
		jaxtp.send(null);
	}
	var playlist_loaded = false;
	function playlist() { 
		if(playlist_loaded==false) {
			document.getElementById(\'vid\').innerHTML = \'<div class="msg_playlist"><div class="msg"><div id="tab_playlist"><div class="loader"></div></div></div></div>\'; 
			tab_playlist(); 
			playlist_loaded=true;
		} else { 
			document.getElementById(\'vid\').innerHTML =msg_playlist;
		}
	}
	function b_playlist() {if(bouton==\'playlist\') {stop();} else {playlist(); bouton=\'playlist\';}}	
//--></script>';

$bouton_playlist = '	
<div class="playlist">
	<a href="javascript:b_playlist();" '.linktitle(txt($bt_playlist)).' ></a>
</div>'; // Pour ne pas l'afficher onload
}
}
?>