<?
function message($txt,$type) {
	if ($type=="error") $bgcolor="#f99"; else $bgcolor="#9f9";
 echo "<div style='width:100%;height:20px;background-color:{$bgcolor};color:#000;text-align:center;padding-top:3px'>{$txt}</div>";
}
