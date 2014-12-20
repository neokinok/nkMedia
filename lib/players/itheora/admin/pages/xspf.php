<?php
echo '<h1>'.txt($xspf_title).'</h1>
<form action="http://'.$ihost.$ipath.'lib/export_xspf.php" method="post"><div>
<p>'.txt($xspf_txt).'</p>
<table cellpadding="3px" cellspacing="0" border="0" class="indent">
<tr><td>'.txt($xspf_title).'</td><td><input type="text" name="title" size="20" maxlength="200" /></td></tr>
<tr><td>'.txt($xspf_creator).'</td><td><input type="text" name="creator" size="20" maxlength="200" /></td></tr>
</table>
<div id="model">
<h2>Piste 1</h2>
<table cellpadding="3px" cellspacing="0" border="0" class="indent">
	<tr><td>'.txt($xspf_tk_location).' <span style="color: red">*</span></td><td colspan="3"><input type="text" name="location_tk_1" size="60" maxlength="200" /></td></tr>
	<tr><td>'.txt($xspf_tk_creator).'</td><td><input type="text" name="creator_tk_1" size="20" maxlength="200" /></td>
	<td>'.txt($xspf_tk_image).'</td><td><input type="text" name="image_tk_1" size="20" maxlength="200" /></td></tr>
	<tr><td>'.txt($xspf_tk_album).'</td><td><input type="text" name="album_tk_1" size="20" maxlength="200" /></td>
	<td>'.txt($xspf_tk_info).'</td><td><input type="text" name="info_1" size="20" maxlength="200" /></td></tr>
	<tr><td>'.txt($xspf_tk_title).'</td><td><input type="text" name="title_tk_1" size="20" maxlength="200" /></td>
	<td>'.txt($xspf_tk_license).'</td><td><input type="text" name="license_tk_1" size="20" maxlength="200" /></td></tr>
	<tr><td>'.txt($xspf_tk_duration).'</td><td><input type="text" name="duration_tk_1" size="10" maxlength="200" /></td></tr>
</table>
</div>
<div id="next2"></div>
<script type="text/javascript"><!--
 i = 2;
function add_track() {
	var model= document.getElementById(\'model\').innerHTML;
	var regtk=new RegExp("(_tk_1)", "g");
	var regpt=new RegExp("(1</h2>)", "g");
	var id="next" + i;
	document.getElementById(id).innerHTML = document.getElementById(id).innerHTML + model.replace(regtk,"_tk_"+ i +"").replace(regpt,""+ i +"</h2>") + \'<div id="next\'+ (i+1) +\'"></div>\';
	i = i+1;
}
function remove_track() {
	if(i>2) {
	i = i-1;
	var id="next" + i;
	document.getElementById(id).innerHTML = "";
	}
}

//--></script>
<p class="indent"><input type="button" class="submit" value="'.txt($xspf_add_track).'" onclick="javascript:add_track()"/> <input type="button" class="submit" value="'.txt($xspf_remove_track).'" onclick="javascript:remove_track()"/></p>
<br />
<p class="indent"><input type="submit" class="submit" value="'.txt($xspf_ok).'" /></p>
</div></form>
<p><span style="color: red">*</span> '.txt($xspf_nota).'</p>';?>