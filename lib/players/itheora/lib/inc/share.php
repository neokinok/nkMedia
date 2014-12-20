<?php
if($function_share) { 
	// URL
	$ecran_share_url = ' 
	<form action="" name="URLForm" id="URLForm">
		<textarea onclick="javascript:document.URLForm.code.focus();document.URLForm.code.select();" 
			id="code" name="code" class="code" readonly="readonly" />
			http://'.$ihost.$iscript.'?v='.$sv.$sn.$sd.'
		</textarea>
	</form>
	';
	// Code HTML valide W3C
	$ecran_share_w3c = ' 
	<form action="" name="W3CForm" id="W3CForm">
		<textarea onclick="javascript:document.W3CForm.code.focus();document.W3CForm.code.select();" 
			id="code" name="code" class="code" readonly="readonly" />
			&lt;object data="http://'.$ihost.$iscript.'?v='.ep($sv.$ss.$sn.$sp.$sd.$sl, 2).'" type="application/xhtml+xml" style="width: '.($x+20).'px; height: '.($y+40).'px;"&gt;
				\n\t&lt;!&#150;-[if IE]&gt;
					\n\t\t&lt;iframe src="http://'.$ihost.$iscript.'?v='.ep($sv.$ss.$sn.$sp.$sd.$ls, 2).'" style="width: '.($x+20).'px; height: '.($y+40).'px;" allowtransparency="true" frameborder="0" &gt;
					\n\t\t&lt;/iframe&gt;
				\n\t&lt;![endif]-&#150;&gt;
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
	$ecran_share_ts = '';
} else {
	$ecran_share_ts = '';
}

	$ecran_share = '
	<div class="msg_share">
		<div class="msg">
			<p><a href="http://'.$ihost.$iscript.'?v='.$sv.$sl.$ss.$sd.$sn.$sp.'" onclick="window.open(this.href); return false;">'.txt($txt_url).'</a></p>
			<div class="codebox">
			'.$ecran_share_url.'
			</div>
			
			<p>'.txt($txt_embed).'</p>
			<div class="codebox">
			'.$ecran_share_w3c.'
			</div>
			
			<table><tr>
				<td><p><a href="mailto:?subject='.txt($txt_email_subject).'&amp;body=http://'.$ihost.$iscript.'?v='.$sv.$sl.$ss.$sd.$sn.$sp.'">'.txt($txt_email).'</a></p></td>
				<td>
					<div class="big_Email">
					<a href="mailto:?subject='.txt($txt_email_subject).'&amp;body=http://'.$ihost.$iscript.'?v='.$sv.$sl.$ss.$sd.$sn.$sp.'"></a>
					</div>
				</td>
				</tr>'.$ecran_share_ts.'</table>
		</div>		
	</div>
	';
	
echo '
<script type="text/javascript"><!--
	function share() { document.getElementById(\'vid\').innerHTML = \''.txtjs($ecran_share).'\'; }
	function b_share() {if(bouton==\'share\') {stop();} else {share(); bouton=\'share\';}}	
//--></script>
	
<div class="share">
	<a href="javascript:b_share()" '.linktitle(txt($bt_share)).'></a>
</div>
	';
}
?>
