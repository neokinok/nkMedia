<?$tw=$chn['twitter_search']; if ($tw=="") $tw=$chn['channel_name'];
$tw=str_replace("@","",$tw); $tw=str_replace("#","",$tw);
?>
<?echo $tw;?>
<a class="twitter-timeline" href="https://twitter.com/search?q=%23<?=$tw?>" height="700" data-widget-id="451745785118355456" data-screen-name="<?=trim(strip_tags($tw))?>">#<?=$tw?></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<?
  /*version: 2,
  type: 'search',
  search: '<?=$chn['twitter_search']?>',
  title: '<?=$chn['meta_description']?>',
  subject: '#<?=$chn['channel_name']?>',
      background: '#<?=$chn['background_playlist_color']?>',
      color: '#<?=$chn['font_color']?>'
      background: '#<?=$chn['background_color']?>',
      color: '#<?=$chn['font_color']?>',
      links: '#<?=$chn['links_color']?>'
*/
?>
