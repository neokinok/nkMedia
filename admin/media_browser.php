<?

$orderby="creation_date desc";
if ($chn['order_videos']=="ORDERBY"||$chn['order_videos']=="creation date") $orderby="creation_date desc";
else if ($chn['order_videos']=="predefined order") $orderby="order_number";
else if ($chn['order_videos']=="title") $orderby="title";
else if ($chn['order_videos']=="most viewed") $orderby="views";
$select="select * from nkm_media where channel='{$_SESSION['username']}' order by ".$orderby;
$result=mysql_query($select);
echo "<table border=1 cellpadding=5 cellspacing=5 style='border:1px solid #aaa;font-size:12px'>";
echo "<tr style='background-color:#eee;color:#444'>";
echo "<td>Status</td><td>Datetime</td><td>Thumb</td><td>Title</td><td>Platform</td><td>Format</td><td>Duration</td><td colspan=2>Actions</td>";
echo "</tr>";
while ($row=mysql_fetch_array($result)) {
        echo "<tr>";
//echo $row['thumbnail']."<br>";
	if (substr($row['thumbnail'],0,4)=="http") $url_pic=$row['thumbnail']; else  $url_pic="/mediabase/{$_SESSION['username']}/thumb/{$row['file']}.png";
	echo "<td class=\"center\"><img src=\"/img/icons/".$row['status'].".gif\"></td>";
	echo "<td>".str_replace(" ","<br>",date('d-m-Y h:m:s',strtotime($row['creation_date'])))."</td>";
	echo "<td><img width=50 src='{$url_pic}'></td>";
	echo "<td>{$row['title']}";
		if (!file_exists("../mediabase/{$_SESSION['username']}/{$row['file']}")) echo "<br><span style='color:#f00'>file not found</span>";
	echo "</td>";
	echo "<td>{$row['platform']}</td>";
	echo "<td>{$row['format']}</td>";
	echo "<td>{$row['duration']}</td>";
	echo "<td><a href='?_=e&id={$row['id']}'>Edit</a></td>";
	echo "</tr>";
}
echo "</table><br><br>";
?>
