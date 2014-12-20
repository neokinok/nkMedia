
<?

while ($row=mysql_fetch_array($result)) {
         echo "<div style=\"background-image:url('".$row['header_pic']."');font-size:11px;text-align:center;height:120px;width:150px;float:left;padding:5px;border:1px dotted #ccc;margin:10px;\"><a style='padding:2px;color:#333;background-color:#fff;font-size:12px' href=\"http://www.experimentaltv.org/".$row['username']."\"><b>".$row['channel_name']."</b></a><br><br><br><a href=\"http://www.experimentaltv.org/".$row['username']."\"><img border='0' src='img/play.png' width=50 height=50></a></div>";
}
/*
if (file_exists($fullurl)) {
        foreach (new DirectoryIterator($fullurl) as $fileInfo) {
        $n++;
            if($fileInfo->isDot()) continue;
            $account = substr($fileInfo->getFilename(),0,strlen($fileInfo->getFilename())-4);
//          require "conf/".$account.".php";  no carrega constants dos vegades

                echo "<div style=\"background-image:url('".TOP_IMAGE."');font-size:11px;text-align:center;height:120px;width:150px;float:left;padding:5px;border:1px dotted #ccc;margin:10px;\"><a href=\"http://www.experimentaltv.org/".$account."\"><b>".$account."</b><br><br><br><img src='admin/video.png' width=50 height=50></a></div>";
             
        }
}
*/
echo "</td></tr></table>";
?>
