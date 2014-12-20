
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
			 <? if ($_SESSION['logged']) {
				echo "<span style='color:#fff'><a style='color:#FFb200' href='http://".$_SERVER['HTTP_HOST']."/".$_SESSION['username']."'><b>".$_SESSION['username']."</b></a></span>".$sep."<a class=\"experimental\" href='/admin/menu.php'>Admin</a>".$sep."<a href='/admin/logout.php?u=".$_GET['u']."' class='experimental'>Logout</a>"; 
				} else {
				echo "<a href='/admin/logoutin.php' class='experimental'>login</a>";
				} ?>
			<? if (!$_SESSION['logged']) { ?>
				        <?=$sep?><a href="http://www.experimentaltv.org/newaccount.php" title="Sign up for a ExperimentalTV account" rel="nofollow" class="experimental" >Sign Up</a>
			<? } ?>
			</div>
 	       </div>
</div>
</td></tr>
</table>
<center>

