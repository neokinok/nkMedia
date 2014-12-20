<table cellpadding="0" cellspacing="0" width='100%' height='100%' border=0><tr><td width="200" style="background-color:#eee;vertical-align:top;padding:0px;border-right:1px solid #ccc">
<ul id="menu">

<li class='<? if ($_GET['p']=="active-channels") echo "current"?>' onclick="go('active-channels')"><div>Active Channels</div></li>
<li class='<? if ($_GET['p']=="now-playing") echo "current"?>' onclick="go('now-playing')"><div>Now playing</div></li>
<li class='<? if ($_GET['p']=="all-channels") echo "current"?>' onclick="go('all-channels')"><div>All Channels</div></li>
<? /*<li><div>Offline Channels</div></li>*/?>
<li class='<? if ($_GET['p']=="wiki") echo "current"?>' onclick="go('wiki')"><div>Wiki</div></li>
<li class='<? if ($_GET['p']=="help-developing") echo "current"?>' onclick="go('help-developing')"><div>Help developing</div></li>
</ul>
</td><td>
<?
include "includes/".$_GET['p'].".php";?>
</td></tr></table>
<script language="javascript">
function go(page) {
document.location="/?p="+page;
}
/*$('ul#menu li').onclick=function() {
        alert($('#menu').attr('name'));
}*/

</script>
