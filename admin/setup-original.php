<?
$pagewidth=900;
require "auth.php";
include "../includes/headers.php";
$title = "Create your own ExperimentalTV Live Streaming Channel";
define ('BROWSER_TITLE',$title);
?>
<body>
<?include "../includes/top.php";?>
<center>
<div style="background-color:#fff;width:900px;margin-top:10px;padding-top:10px">
<h1><?=_MYACCOUNT_?></h1>
<?include "tiny_menu.php";?>
<form action="/lib/saveAccount.php" method="POST">
<font size="2">
<table class="admin">
<tr><td colspan=2>
<h3><?=_MYACCOUNT_?></h3>
<hr>
</td></tr>

<tr><td><?=constant('_USERNAME_')?> </td><td><input size="30" name="username" value="<?=$chn['username']?>"></td></tr>
<tr><td><?=_PASSWORD_?> </td><td> <input size="30" type="password" name="password" value="<?=$chn['password']?>"></td></tr>
<tr><td><?=_EMAIL_?> </td><td><input size="30" name="email" value="<?=$chn['email']?>"></td></tr>
<tr><td><?=_LANGUAGE_?> </td><td><select name="language">
	                                <? if ($chn['language']=="ct") $sel="selected"; else $sel=""; ?>
						<option value="ct" <?=$sel?>>catal&agrave;</option>
					<? if ($chn['language']=="es") $sel="selected"; else $sel=""; ?>
						<option value="es" <?=$sel?>>espa&ntilde;ol</option>
					<? if ($chn['language']=="en") $sel="selected"; else $sel=""; ?>
						<option value="en" <?=$sel?>>english</option>
					<? if ($chn['language']=="pt") $sel="selected"; else $sel=""; ?>
                                                <option value="pt" <?=$sel?>>portuguese</option>
			</select></td></tr>
<tr><td><?=_LOCATION_?> </td><td><input size="30" name="location" value="<?=$chn['location']?>"></td></tr>
<tr><td><?=_COUNTRY_?> </td><td><input size="30" name="country" value="<?=$chn['country']?>"></td></tr>
<?//<tr><td>T&iacute;tol de la p&agrave;gina </td><td><input size="30" name="title" value="<?=BROWSER_TITLE</td></tr> */?>

<tr><td colspan=2>
<br><h3>Channel config</h3>
<hr>
</td></tr>


<tr><td><?=_CHANNEL_NAME_?> </td><td><input size="30" name="channel_name" value="<?=$chn['channel_name']?>"></td></tr>
<tr><td><?=_STATUS_?> </td><td><select name="status">
                                        <? if ($chn['status']=="offline") $sel="selected"; else $sel=""; ?>
                                                <option value="offline" <?=$sel?>>offline</option>
                                        <? if ($chn['status']=="online") $sel="selected"; else $sel=""; ?>
                                             <option value="online" <?=$sel?>>online</option>
                        </select></td></tr>
<tr><td><?=_START_PAGE_?> </td><td><select name="start_page">
                                        <? if ($chn['start_page']=="live") $sel="selected"; else $sel=""; ?>
                                                <option value="live" <?=$sel?>>live</option>
                                        <? if ($chn['start_page']=="mediabase") $sel="selected"; else $sel=""; ?>
                                             <option value="mediabase" <?=$sel?>>mediabase</option>
                        </select></td></tr>
<tr><td><?=_URL_?> </td><td><input size="30" name="external_url" value="<?=$chn['external_url']?>"></td></tr>
<tr><td>Meta description </td><td><input size="30" name="meta_description" value="<?=$chn['meta_description']?>"></td></tr>
<tr><td>Meta keywords </td><td><input size="30" name="meta_keywords" value="<?=$chn['meta_keywords']?>"></td></tr>
<tr><td>Mountpoint URL </td><td><input size="30" name="mountpoint_url" value="<?=$chn['mountpoint_url']?>"></td></tr>
<tr><td>Twitter #hashtag OR @user</td><td><input size="30" name="twitter_search" value="<?=$chn['twitter_search']?>"></td></tr>
<tr><td colspan=2>
<br><h3>Disseny</h3>
<hr>
</td></tr>
<tr><td>Player type </td><td><select name="player_type">
                                <? if ($chn['player_type']=="basic") $sel="selected"; else $sel=""; ?>
                                <option name="basic" <?=$sel?>>basic</option>
                                </select></td></tr>
<tr><td>Player width (max. 540)</td><td> <input size="30" name="player_width" value="<?=$chn['player_width']?>"></td></tr>
<tr><td>Player height </td><td><input size="30" name="player_height" value="<?=$chn['player_height']?>"></td></tr>
<tr><td>Live as default page</td><td><input type="checkbox" size="30" name="default_live" <? if ($chn['default_live']=="on") echo "checked"?>></td></tr>
<tr><td><?=_URL_HEADERPIC_?> </td><td><input size="30" name="header_pic" value="<?=$chn['header_pic']?>"></td></tr>
<tr><td><?=_URL_LOGO_?> </td><td><input size="30" name="top_logo" value="<?=TOP_LOGO?>"></td></tr>
<tr><td>URL imatge inicial </td><td><input size="30" name="player_initial_image" value="<?=$chn['player_initial_image']?>"></td></tr>
<tr><td>Text footer (html) </td><td><input size="30" name="footer_text" value="<?=$chn['footer_text']?>"></td></tr>
<tr><td>Font color</td><td>
<input size="30" id="font_color" name="font_color" size="6" value="<?=$chn['font_color']?>" style="background-color:#<?=$chn['font_color']?>">
</td></tr>
<tr><td>Links color</td><td><input id="links_color" size="6" name="links_color" value="<?=$chn['links_color']?>" style="background-color:#<?=$chn['links_color']?>"></td></tr>
<tr><td>Background color</td><td><input size="6" id="background_color" name="background_color" value="<?=$chn['background_color']?>" style="background-color:#<?=$chn['background_color']?>"></td></tr>
<tr><td>Background page color</td><td><input size="6" id="background_page_color" name="background_page_color" value="<?=$chn['background_page_color']?>" style="background-color:#<?=$chn['background_page_color']?>"></td></tr>
<tr><td>Font menu color</td><td><input size="6" id="font_menu_color" name="font_menu_color" value="<?=$chn['font_menu_color']?>" style="background-color:#<?=$chn['font_menu_color']?>"></td></tr>
<tr><td>Background menu color</td><td><input size="6" id="background_menu_color" name="background_menu_color" value="<?=$chn['background_menu_color']?>" style="background-color:#<?=$chn['background_menu_color']?>"></td></tr>
<tr><td>Background playlist color</td><td><input size="30" id="background_playlist_color" name="background_playlist_color" value="<?=$chn['background_playlist_color']?>" style="background-color:#<?=$chn['background_playlist_color']?>"></td></tr>
<tr><td>URL imatge de fons</td><td><input size="30" name="background_pic" value="<?=$chn['background_pic']?>"></td></tr>
<tr><td><?=_BACKGROUNDCONFIG_?></td><td>
<select name="background_conf">
<option<? if ($chn['background_config']=='Picture') echo " selected"?>>Picture</option>
<option<? if ($chn['background_config']=='Custom color') echo " selected"?>>Use background color</option>
</select>
</td></tr>
<tr><td><?=_DRAWMENULINES_?></td><td>
<select name="draw_menu_lines">
<option<? if ($chn['draw_menu_lines']==0) echo " selected"?> value="0"><?=_NO_?></option>
<option<? if ($chn['draw_menu_lines']==1) echo " selected"?> value="1"><?=_YES_?></option>
</select>
</td></tr>
<tr><td><?=_URL_ADJUSTPIC_?></td><td><input size="30" name="standby_pic" value="<?=$chn['standby_pic']?>"></td></tr>
<tr><td colspan=2>
<h3>Live</h3>
<hr>
</td></tr>
<tr><td colspan=2>
<center>

<fieldset><legend>Text sobre player</legend>
<font size="2">Accepta format HTML</font><br>
<textarea id="editor" name="uptext_live" cols="50" rows="5"><?=$chn['uptext_live']?></textarea>
<br>
</fieldset>

<fieldset><legend>Text sota player 1</legend>
<font size="2">Accepta format HTML</font><br>
<textarea id="lowtext1" name="lowtext1_live" cols="50" rows="5"><?=$chn['lowtext1_live']?></textarea>
<br>
</fieldset>

<fieldset><legend>Text sota player 2 </legend>
<font size="2">Accepta format HTML</font><br>
<textarea id="lowtext2" name="lowtext2_live" cols="50" rows="5"><?=$chn['lowtext2_live']?></textarea>
<br>
</fieldset>

<h3>Mediabase</h3>
<hr>
</td></tr>
<tr><td colspan=2>
<center>

<fieldset><legend>Text sobre player</legend>
<textarea id="uptext" name="uptext_mb" cols="50" rows="5"><?=$chn['uptext_mb']?></textarea>
<br>
</fieldset>

<fieldset><legend>Text sota player </legend>

<textarea cols="50" id="lowtext" name="lowtext1_mb" rows="6"><?=$chn['lowtext1_mb']?></textarea>

<script type="text/javascript">
 CKEDITOR.replace( 'lowtext',
                {  toolbar:  [['Styles', 'Format'],['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', '-','TextColor']] });
 CKEDITOR.replace( 'uptext',
                {  toolbar:  [['Styles', 'Format'],['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', '-','TextColor']] });
 CKEDITOR.replace( 'lowtext1',
                {  toolbar:  [['Styles', 'Format'],['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', '-','TextColor']] });
 CKEDITOR.replace( 'lowtext2',
                {  toolbar:  [['Styles', 'Format'],['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', '-','TextColor']] });
 CKEDITOR.replace( 'editor',
                {  toolbar:  [['Styles', 'Format'],['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', '-','TextColor']] });
</script>

</fieldset>

<fieldset><legend>Ordre videos mediabase </legend>
<font size="2">Ordre</font><br>
<select name="order_videos">
<option value="most viewed" <? if ($chn['orderby']=='most viewed') echo " selected"?>>Most viewed</option>
<option value="creation date" <? if ($chn['orderby']=='creation date') echo " selected"?>>Creation date</option>
<option value="predefined order" <? if ($chn['orderby']=='predefined order') echo " selected"?>>Predefined order</option>
<option value="title" <? if ($chn['orderby']=='title') echo " selected"?>>Title</option>
</select>
<br>
</fieldset>

<tr><td colspan=2><br><hr><center><input type="submit" value="save changes"></center></td></tr>
</table>
</font>
</form>
<br>
<br>
</td></tr>
</table>

<a href="/<?=$_SESSION['username']?>">return to my channel</a>
<br><br></div>
</center><br>


<script language="javascript">
 $('#font_color, #links_color, #background_color, #background_page_color, #background_menu_color, #background_playlist_color').ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
                $(el).val(hex);
                $(el).ColorPickerHide();
                $(el).attr('style','background-color:#'+hex);
        },
        onBeforeShow: function () {
                $(this).ColorPickerSetColor(this.value);
        }
});

</script>

</body>
