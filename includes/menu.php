<? if ($chn['draw_menu_lines']==1) $add="border-bottom:1px solid #".$chn['font_menu_color'].";border-top:1px solid #".$chn['font_menu_color'].";"; ?>
<table  width="100%" border="0" cellpadding="0" cellspacing="0"  style="<?=$add?>background-color:#<?=$chn['background_page_color']?>"><tr><td style="padding:0px;background-color:#<?=$chn['background_menu_color']?>">
<b>
<? if ($_SESSION['logged']&&$_SESSION['username']==$_GET['u']) { ?><div class="nkbutton<?if ($_GET['s']=="producer") echo "_selected";?>" style="border-right:0px"><a href="/<?=$_GET['u']?>/producer">PRODUCER</a></div><? } ?>
<div class="nkbutton<?if ($_GET['s']=="mediabase") echo "_selected";?>" style="border-right:0px"><a href="/<?=$_GET['u']?>/mediabase">MEDIABASE</a></div>
<div class="nkbutton<?if ($_GET['s']=="live") echo "_selected";?>" style="border-right:0px"><a href="/<?=$_GET['u']?>/live">LIVE</a></div>
<div class="nkbutton<?if ($_GET['s']=="about") echo "_selected";?>" style="border-right:0px"><a href="<?=$chn['external_url']?>">HOME</a></div>
</b>
</td></tr>
</table>

