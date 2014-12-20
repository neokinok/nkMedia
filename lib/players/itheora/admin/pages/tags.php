<?php // demonstrator for the oggtag class from the ogg.php librairie. (c) Nicolas Ricquemaque 2008, GPL3

require_once("../lib/ogg.class.php");
	
$action = getp('a'); 
$file = getp('file');

echo '<h1>'.txt($tags_title).'</h1>';

if (!$action) { // select file
	echo '<br />
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<div>
			<p class="indent">'.txt($tags_file_to_tag).'</p>
			<input type="text" name="file" size="50" value="'.$ipath.'data/" class="indent" />
			<input type="submit" name="a" value="'.txt($tags_bt_ok).'" style="margin-left : 20px;" />
			</div>
		</form>';
}
	
if ($action==txt($tags_bt_ok)) { // load file
	$tag=new Ogg($document_root.$file,UTF8,"../cache");
	if ($tag->LastError) { echo $tag->LastError; exit; }
	echo '<div style="margin-left : 100px">'.txt($tags_file).nl2br(htmlentities($tag->Streams['summary'])).'</div><br />
	<p style="width : 500px">'.txt($tags_txt_fields).' <a href="http://xiph.org/vorbis/doc/v-comment.html">Xiph.org</a></p><br />
	<form action="'.$_SERVER['REQUEST_URI'].'" method="post" ><div>';
	if (isset($tag->Streams['theora'])) { 
		echo '<b>VIDEO (Theora) :</b><br />
		<textarea rows="10" cols="80" name="theora">';
		if (isset($tag->Streams['theora']['comments'])) foreach ($tag->Streams['theora']['comments'] as $comment) echo "$comment\n";
		echo '</textarea><br /><br />
		';
	}
	if (isset($tag->Streams['vorbis'])) { 
		echo '<b>AUDIO (Vorbis) :</b><br />
		<textarea rows="10" cols="80" name="vorbis">';
		if (isset($tag->Streams['vorbis']['comments'])) foreach ($tag->Streams['vorbis']['comments'] as $comment) echo "$comment\n";
		echo '</textarea><br /><br />
		';
	}	
	echo '<input type="submit" value="'.txt($tags_bt_save).'" />
		<input type="hidden" name="a" value="p" />
		<input type="hidden" name="file" value="'.$file.'" />
	</div></form>';
}

$done=false;

if ($action=='p') { // process
	$tag=new Ogg($file);
	if ($tag->LastError) { echo $tag->LastError; exit; }
	if ($v=getp('vorbis')) $tag->Streams['vorbis']['comments']=explode("\n",rtrim(str_replace("\r","",$v),"\n"));
	if ($t=getp('theora')) $tag->Streams['theora']['comments']=explode("\n",rtrim(str_replace("\r","",$t),"\n")); 
	echo '<br />'.txt($tags_processing_file).'<b>'.$file.'</b>... <br /><span id="status">'.txt($tags_writing_header).'</span><br /><br />';
	@ob_flush(); @flush();
	$write=$tag->WriteNewComments(); //refresh every 5s by default
	if ($tag->LastError) { echo $tag->LastError; exit; }
	if ($write==$tag->Streams['size']) $done=true; 
	else { //hiddhen form to post data to a new php session to continue writting
		echo '
		<form name="phptag" action="'.$_SERVER['REQUEST_URI'].'" method="post"><div>
			<input type="hidden" name="a" value="c" />
			<input type="hidden" name="file" value="'.$file.'" />
		</div></form>
		<script language="javascript" type="text/javascript">document.phptag.submit();</script>';
		}
	}
	
if ($action=='c') { // continue
	$tag=new Ogg($file);
	if ($tag->LastError) { echo $tag->LastError; exit; }
	if (!isset($tag->Streams['tmpfileptr'])) { echo $tags_continue_error; exit;}
	echo '<br />'.txt($tags_proccessing_file).'<b>'.$file.'</b>... <br /><span id="status">'.round($tag->Streams['tmpfileptr']/$tag->Streams['size']*100).'% '.txt($tags_continue_done).'</span><br /><br />';
	@ob_flush(); @flush();
	$write=$tag->ContinueWrite();	
	if ($tag->LastError) { echo $tag->LastError; exit; }
	if ($write==$tag->Streams['size']) $done=true; 
	else { //hiddhen form to post data to a new php session to continue writting
		echo '
		<form name="phptag" action="'.$_SERVER['REQUEST_URI'].'" method="post"><div>
			<input type="hidden" name="a" value="c" />
			<input type="hidden" name="file" value="'.$file;'" />
		</div></form>
		<script language="javascript" type="text/javascript">document.phptag.submit();</script>';
	}
}

if ($done) { //file has been completed
	echo '<script language="javascript" type="text/javascript">document.getElementById(\'status\').innerHTML=\''.txt($tags_continue_completed).'\';</script>';
} ?>