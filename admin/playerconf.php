<?
require "auth.php";

include "../includes/headers.php";

session_start();
     // missatge sota el video
           $filename = "../data/tmp/about-".$_SESSION['username'].".txt";
           $fp = fopen($filename, "r");
           $about = fread($fp, filesize($filename));
           fclose($fp);

           $filename = "../data/tmp/title-".$_SESSION['username'].".txt";
           $fp = fopen($filename, "r");
           $title = fread($fp, filesize($filename));
           fclose($fp);


?>

<center>
<fieldset><legend>Text del player </legend>
<form action="saveTitle.php" method="POST"> 
<font size="2">Accepta format HTML</font><br>
<textarea name="title" cols="60" rows="5"><?=$title?></textarea>
<br>
<input type="submit" value="canviar">
</form>
</fieldset>

<fieldset><legend>Informaci&oacute; del stream </legend>
<form action="saveAbout.php" method="POST">
<font size="2">Accepta format HTML</font><br>
<textarea name="about" cols="80" rows="5"><?=$about?></textarea>
<br>
<input type="submit" value="canviar">
</form>
</fieldset>

<fieldset><legend>Administraci&oacute; del xat</legend>
</fieldset>
<br>
<br>
<a href="/<?=$_SESSION['username']?>">return to my channel</a>
</center>
</body>
