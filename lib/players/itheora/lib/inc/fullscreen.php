<?php 
if(strstr($disable, "k")) { // "k" est le parametre reserve pour permettre de fermer le plein ecran
echo '
<div class="close">
	<a href="javascript:void(0);" onclick="self.close(\'ITheora - Fullscreen\')" '.linktitle(txt($bt_close)).' ></a>
</div>';
} else if($function_fullscreen) {  // la fonction plein ecran existe
echo '	
<div class="fullscreen">
	<a href="javascript:void(0);" onclick="ff=window.open(\'http://'.$ihost.$iscript.'?v='.ep($sv.$st.$ss.$sp.$sb.'&d='.$disable.'k'.$sx.$sf.$sl, 1).'\', \'ITheora - Fullscreen\', \'status=0,toolbar=0,location=0,directories=0,scrollbars=0,copyhistory=0,menuBar=0,width=\'+ (screen.width) +\',height=\'+ (screen.height) +\'\'); ff.focus(); stop(); return false;" '.linktitle(txt($bt_fullscreen)).' ></a>
</div>'; 
}
?>