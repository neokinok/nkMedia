<table width="100%" cellspacing="0" cellpadding="0" style="margin-top:20px">
<tr><td>
<div style="width:100%;background-color:#<?=$chn['background_page_color']?>" st=";-moz-opacity:50%;opacity:.95;filter:alpha(opacity=90)">
		<div id="header" style="height:30px;width:100%"></div>
		<div id="user_contents" style="display:none"></div>
		<? $sep="<span style='color:#888'>&nbsp;|&nbsp;</span>"; ?>
		 <div class="inner" style="position:absolute;width:100%;margin-left:auto;margin-right:auto;left:0px;padding-left:10px;top:0px;z-index:999">
			<div style="float:left;margin-top:3px;">
		        <a style="color:#aaa" href="/" title="ExperimentalTV stream Guide" rel="nofollow" id="logo"><img src="/img/logoexperimentaltv.png" border="0"></a>
			</div>
			<div style="float:right;padding-top:6px;padding-right:20px;">
<?if ($_SESSION['logged']&&$_SESSION['username']==$_GET['u']) echo "<span style='color:#fff'><b>".$_SESSION['username']."</b></span>".$sep."<a class=\"experimental\" href='/admin/menu.php'>Edit</a>".$sep."<a href='/admin/logout.php?u=".$_GET['u']."' class='experimental'>Logout</a>"; else echo "<a href='/admin/logoutin.php' class='experimental'>login</a>";?>
			</div>
 	       </div>
</div>
</td></tr>
</table>
<center>

