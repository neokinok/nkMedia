<?
require "auth.php";

include "../includes/headers.php";

$title = "Create your own ExperimentalTV Live Streaming Channel";

        $filename = "../data/tmp/title-".$_SESSION['username'].".txt";
        $fp = fopen($filename, "r");
        $contents = fread($fp, filesize($filename));
          $title= $contents;
           fclose($fp);

        $filename = "../data/tmp/about-".$_SESSION['username'].".txt";
        $fp = fopen($filename, "r");
        $contents = fread($fp, filesize($filename));
          $about=$contents;
           fclose($fp);

define ('BROWSER_TITLE',$title);

include "conf/".$_SESSION['username'].".php";
?>
<body>

<?include "../includes/top.php";?>

<center>

<div style="background-color:#fff;width:700px">
<br><h1>My account</h1>
<?include "tiny_menu.php";?>


<form action="/lib/saveAccount.php" method="POST">

<font size="2">
<br>
<table class="admin">



<tr><td colspan=2>
<h3>Live</h3>
<hr>
</td></tr>
<tr><td colspan=2>
<center>

<fieldset><legend>Text sobre player</legend>
<font size="2">Accepta format HTML</font><br>
<textarea name="uptext_live" cols="50" rows="5"><?=UPTEXT_LIVE?></textarea>
<br>
</fieldset>

<fieldset><legend>Text sota player 1</legend>
<font size="2">Accepta format HTML</font><br>
<textarea name="lowtext1_live" cols="50" rows="5"><?=LOWTEXT1_LIVE?></textarea>
<br>
</fieldset>

<fieldset><legend>Text sota player 2 </legend>
<font size="2">Accepta format HTML</font><br>
<textarea name="lowtext2_live" cols="50" rows="5"><?=LOWTEXT2_LIVE?></textarea>
<br>
</fieldset>

<h3>Mediabase</h3>
<hr>
</td></tr>
<tr><td colspan=2>
<center>

<fieldset><legend>Text sobre player</legend>
<font size="2">Accepta format HTML</font><br>
<textarea name="uptext_mb" cols="50" rows="5"><?=UPTEXT_MB?></textarea>
<br>
</fieldset>

<fieldset><legend>Text sota player </legend>
<font size="2">Accepta format HTML</font><br>
<textarea name="lowtext_mb" cols="50" rows="5"><?=LOWTEXT_MB?></textarea>
<br>
</fieldset>

<fieldset><legend>Ordre videos mediabase </legend>
<font size="2">Ordre</font><br>
<select name="orderby">
<option<? if (ORDERBY=='Most viewed') echo " selected"?>>Most viewed</option>
<option<? if (ORDERBY=='Creation date') echo " selected"?>>Creation date</option>
<option<? if (ORDERBY=='Predefined order') echo " selected"?>>Predefined order</option>
<option<? if (ORDERBY=='Title') echo " selected"?>>Title</option>
</select>
<br>
</fieldset>



<tr><td colspan=2>
<br><h3>Configuraci&oacute;</h3>
<hr>
</td></tr>

<tr><td>Username </td><td><input size="30" name="username" value="<?=USERNAME?>"></td></tr>
<tr><td>Password </td><td> <input size="30" name="password" value="<?=PASSWORD?>"></td></tr>
<?//<tr><td>T&iacute;tol de la p&agrave;gina </td><td><input size="30" name="title" value="<?=BROWSER_TITLE</td></tr> */?>
<tr><td>URL </td><td><input size="30" name="url" value="<?=URL?>"></td></tr>
<tr><td>URL imatge cap&ccedil;alera </td><td><input size="30" name="top_image" value="<?=TOP_IMAGE?>"></td></tr>
<tr><td>URL imatge logo</td><td><input size="30" name="top_logo" value="<?=TOP_LOGO?>"></td></tr>
<tr><td>URL imatge carta d'ajust</td><td><input size="30" name="standby_image" value="<?=STANDBY_IMAGE?>"></td></tr>
<tr><td>Fons</td><td>
<select name="fons">
<option<? if (FONS=='Picture') echo " selected"?>>Picture</option>
<option<? if (FONS=='Custom color') echo " selected"?>>Use background color</option>
</select>
</td></tr>
<tr><td>URL imatge de fons</td><td><input size="30" name="bg_image" value="<?=BG_IMAGE?>"></td></tr>
<tr><td>Meta description </td><td><input size="30" name="meta_description" value="<?=META_DESCRIPTION?>"></td></tr>
<tr><td>Meta keywords </td><td><input size="30" name="meta_keywords" value="<?=META_KEYWORDS?>"></td></tr>
<tr><td>Player type </td><td><input size="30" name="player_type" value="<?=PLAYER_TYPE?>"></td></tr>
<tr><td>Mountpoint URL </td><td><input size="30" name="mountpoint_url" value="<?=MOUNTPOINT_URL?>"></td></tr>
<tr><td>Mountpont file </td><td><input size="30" name="mountpoint" value="<?=MOUNTPOINT?>"></td></tr>
<tr><td>Live as default page</td><td><input type="checkbox" size="30" name="startlive" <? if (STARTLIVE=="on") echo "checked"?>></td></tr>

<tr><td colspan=2>
<br><h3>Disseny</h3>
<hr>
</td></tr>

<tr><td>Player width (max. 540)</td><td> <input size="30" name="player_width" value="<?=PLAYER_WIDTH?>"></td></tr>
<tr><td>Player height </td><td><input size="30" name="player_height" value="<?=PLAYER_HEIGHT?>"></td></tr>
<tr><td>Text footer (html) </td><td><input size="30" name="footer" value="<?=FOOTER?>"></td></tr>
<tr><td>Font color</td><td><input size="30" name="fcolor" value="<?=FCOLOR?>"></td></tr>
<tr><td>Links color</td><td><input size="30" name="lcolor" value="<?=LCOLOR?>"></td></tr>
<tr><td>Background color</td><td><input size="30" name="bcolor" value="<?=BCOLOR?>"></td></tr>
<tr><td>Background color page</td><td><input size="30" name="bcolor2" value="<?=BCOLOR2?>"></td></tr>

<tr><td colspan=2><br><hr><center><input type="submit" value="save changes"></center></td></tr>
</table>
</font>
</form>
<br>
<br>
</td></tr>

<a href="/<?=$_SESSION['username']?>">return to my channel</a>
<br><br></div>
</center><br>
</body>
