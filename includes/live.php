<table width="<?=$pagewidth?>" border="0" bgcolor="<?=$chn['background_page_color']?>" cellspacing="0" cellpadding="0" style="border:0px dotted #333;border-top:0px;">
<tr>
<td valign="top" width="<?=$chn['player_width']?>" style="padding-right:20px;vertical-align:top">
<? // --- player -- ?>
<iframe name="status" id="status" frameborder="0" width="1" height="1" src="/lib/streamStatus/update.php" style="margin:0;padding:0px" scrolling="auto"></iframe>
<? include "lib/streamStatus/getInfo.php"?>

<?// if ($title!="") { ?>
<b><div style="padding-bottom:5px"><?=$chn['uptext_live']?></div></b>

<iframe src="/lib/players/itheora/index.php?l=<?=$chn['player_lang']?>&v=<?=$chn['mountpoint_url']?>&amp;w=<?=$chn['player_width']?>&amp;h=<?=$chn['player_height']?>&amp;t=5&amp;n=<?=$_SESSION['username']?>mediabase&amp;s=<?=$chn['player_type']?>&amp;p=<?=$chn['standby_pic']?>&d=m" style="width:<?=$chn['player_width']?>px; height:<?=$chn['player_height']?>px;" allowtransparency="true" frameborder="0"></iframe>

        <div id="botvideo" style="height:225px;padding-left:10px;padding-top:5px;margin-top:15px;border-top:1px dotted #<?=$chn['background_color']?>">
        <LABEL class="titol" id="titol" style="padding:0px;color:<?=$chn['font_color']?>;font-size:15px;text-align:center;line-height:19px;padding-top:0px">
<div style="padding:5px;font-size:12px;text-align:left;padding-left:0px">
<b><?=$chn['lowtext1_live']?></b><br>
<?=$chn['lowtext2_live']?><br>
</div>
        </LABEL>
	</div>



</td>
<td  valign="top" align="top" style="padding-top:7px;vertical-align:top">
<? /*<iframe name="mediaChat" id="mediaChat" frameborder="0" width="100%" height="<?=PLAYER_HEIGHT+225?>" src="/lib/xat/index.php?u=<?=$_GET['u']?>" style="margin:0;padding:0px" scrolling="auto"></iframe>*/ ?>

<div style="width:<? $size=$chn['player_width']; $size=900-$size; echo $size?>"><? include "twitter.php";?></div>

<? /*
<iframe src="/lib/chat/index.php?channel=<?=$_GET['u']?>" width="<? $size=$chn['player_width']; $size=900-$size; echo $size?>" height="490" frameborder="0" scrolling="no"></iframe>
*/?>

<? /*<div style="padding-left:15px"><iframe src="http://www.ustream.tv/twitterjs/iframe?prefix=%40neokinok&suffix=+%28%40neokinok+live+at+http%3A%2F%2Fustre.am%2FlkQl+%29" width="363" height="225" frameborder="0" style="border:0px none transparent" scrolling="no" ></iframe></div> */ ?>

</td></tr>
</table>

