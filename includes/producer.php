<?include "conf/".$_GET['u'].".php";?>
<? include "headers.php";?>

<table width="<?=$pagewidth?>" border="0" bgcolor="<?=BCOLOR2?>" cellspacing="0" cellpadding="0" style="border:0px solid #ccc;border-top:0px">
<tr>
<td valign="top" width="<?=PLAYER_WIDTH?>" style="padding-right:20px">
<div id="tele" style="display:block;">

<? 
// --- player -- ?>
<embed width="<?=$_GET['w']?>" height="<?=$_GET['h']?>" target="/lib/players/itheora/index.php?v=/mediabase/<?=$_SESSION['username'];?>/files/<?=$_GET['file']?>&s=<?=$_GET['s']?>&l=<?=$_GET['l']?>&n=<?=$_GET['n']?>&p=<?=$_GET['img']?>&d=t" type="application/xhtml+xml" style="width:<?=$_GET['w']?>px; height:<?=$_GET['h']?>px;">

<? 
//=MOUNTPOINT_URL.MOUNTPOINT?>

         <div id="botvideo" style="height:225px;padding-left:0px;padding-top:5px;">
          <LABEL class="titol" id="titol" style="color:<?=FCOLOR?>;text-align:center"><?
           // missatge sota el video
           $filename = "data/tmp/title-".$_GET['u'].".txt";
           $fp = fopen($filename, "r");
           $contents = fread($fp, filesize($filename));
            echo $contents;
           fclose($fp);
        ?></LABEL>
        <br><br>
        </div>

</div>

</td>
<td  valign="top" style="
dding:0px;">

<div style='background-color:#333;padding:5px'>
<center>Broadcast your live stream to:<br>
<b><?=MOUNTPOINT_URL.MOUNTPOINT?></b>
</center>
</div>

<div style='background-color:#333;padding:5px'>
<center>or broadcast from network stream:
<input class="producer" type="text" name="mpurl" value="url mountpoint" size="35">
</center>
</div>
<div style='background-color:#333;padding:5px'>
<center>or broadcast a video from Mediabase:</center>
<?

$th=PLAYER_HEIGHT+450;
echo "<div style='background-color:".BCOLOR.";height:".$th."px;overflow:auto'>";
    if ($dh = opendir($dir)) {
        $i=0;
        while (($file = readdir($dh)) !== false) {
                if (!isset($first)) $first = $file;

                if ($file!="."&&$file!="..") {
                     echo  "<div style='border:0px solid ".FCOLOR.";background-color:".BCOLOR.";width:94%;height:70px;float:left;margin:3px'><table width=100%><tr><td><a href='#' onclick='playvideo(\"/mediabase/".$_GET['u']."/".$file."\")'><img src='/data/images/Video.png' border=0></a></td><td><font size=1><a href='#' onclick='playvideo(\"/mediabase/".$_GET['u']."/".$file."\")'>".$file."</a></font></td></tr></table></div>";
                }
                $fecha = date ("Y-m-d", filectime($dir."/".$file));
            
                //if (($file!="..")and($file!=".")and(notexists($file))) { $query =  "INSERT into views_clips (file,title,date) values ('$file','$file','$fecha')"; 
                //      echo $query."\n";  
                //      $exec = mysql_query($query);

                $i++;
        } 
        if ($i==2) echo "<br><center><font color='".FCOLOR."'>no videos found in mediabase.<font></center>";
        //                 filetype($dir . $file) . "\n";
        //      echo  "<div style='border:1px solid #ccc;width:90px;height:50px;float:left'>".$file."</div>";
 
       closedir($dh);
        echo "</div>";

    } else {
        echo "no puedo abrir $dir";
        }

//echo "clips have been updated in extranet!";
?>
<br>
</div>

<div style='background-color:#333;padding:5px;margin-top:2px;margin-bottom:2px'>
<center><a href="admin/clearLogs.php">clear chat</a></center>
</div>

<div style='background-color:#333;padding:5px'><center>
<input  class="producer" type="checkbox" name="saveas"> save stream as
<input   class="producer" type="text" name="mpurl" value="filename" size="20">
</center>
</div>

</td></tr>
</table>

