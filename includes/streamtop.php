<? if ($chn['background_page_color']!="") $sty="background-color:#".$chn['background_page_color']; else $sty=""; ?>
<table width="<?=$pagewidth?>" border="0" cellspacing="0" cellpadding="0" style="<?=$sty?>">

<? if ($chn['background_page_color']!="") $sty="padding:10px"; else $sty="padding:0px;"; ?>
<tr><td style="<?=$sty?>">

                <table width="100%"  border=0 style="border:0px;padding:0px" cellpadding="0" cellspacing="0">
                <? if ($chn['header_pic']=="") $top = '/img/streamtop2.png'; else $top=$chn['header_pic'];
                ?>
                <tr><td align="left" style="padding:0px"><a href="<?=$chn['external_url']?>"><img width="100%" src="<?=$top?>" border="0" title="<?=$chn['channel_name']?>"></a></td></tr>
                </table>

