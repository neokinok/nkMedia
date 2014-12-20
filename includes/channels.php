
<table width="100%" cellspacing="0" cellpadding="0" style="margin-top:40px">
<tr><td>
<div style="width:<?=$pagewidth+60?>px;background-color:#<?=$chn['background_page_color']?>" st=";-moz-opacity:50%;opacity:.95;filter:alpha(opacity=90)">
		<div id="header" style="height:30px;width:100%"></div>
		<div id="user_contents" style="display:none"></div>
		<? $sep="<span style='color:#888'>&nbsp;|&nbsp;</span>"; ?>
		 <div class="inner" style="position:absolute;width:900px;margin-left:auto;margin-right:auto;left:0px;right:0px;top:0px;z-index:999">
			<div style="float:left;margin-top:3px;">
		        <a style="color:#aaa" href="/" title="ExperimentalTV stream Guide" rel="nofollow" id="logo"><img src="/img/logoexperimentaltv.png" border="0"></a>
			</div>
			<div style="float:left;padding-top:6px">
		       <?=$sep?> <a title="View the Livestream Channel Guide" rel="nofollow"  class="experimental" href="http://www.experimentaltv.org">Channels</a>
			</div>
			<div style="float:right;padding-top:6px">
			   <?=$sep?>
			 <? if ($_SESSION['logged']&&$_SESSION['username']==$_GET['u']) echo "<span style='color:#fff'><b>".$_SESSION['username']."</b></span>".$sep."<a class=\"experimental\" href='/admin/menu.php'>Edit</a>".$sep."<a href='/admin/logout.php?u=".$_GET['u']."' class='experimental'>Logout</a>"; else echo "<a href='/admin/logoutin.php' class='experimental'>login</a>";?>
			<?=$sep?>
		        <a href="http://www.experimentaltv.org/newaccount.php" title="Sign up for a ExperimentalTV account" rel="nofollow" class="experimental" >Sign Up</a>
			</div>
 	       </div>
</div>
</td></tr>
</table>
<center>

<? if ($chn['background_page_color']!="") $sty="background-color:#".$chn['background_page_color']; else $sty=""; ?>
<table width="<?=$pagewidth?>" border="0" cellspacing="0" cellpadding="0" style="<?=$sty?>">

<? if ($chn['background_page_color']!="") $sty="padding:10px"; else $sty="padding:0px;"; ?>
<tr><td style="<?=$sty?>">

		<table width="100%"  border=0 style="border:0px;padding:0px" cellpadding="0" cellspacing="0">
		<? if ($chn['header_pic']=="") $top = '/data/images/streamtop2.png'; else $top=$chn['header_pic']; 
		?>
		<tr><td align="left" style="padding:0px"><a href="<?=$chn['external_url']?>"><img width="100%" src="<?=$top?>" border="0" title="<?=$chn['channel_name']?>"></a></td></tr>
		</table>
