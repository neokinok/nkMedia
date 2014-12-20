<?
session_start();
require "../includes/db.php";
$update="UPDATE nkm_channels SET 
	`status`=\"{$_POST['status']}\",
	`main_player_type`=\"{$_POST['main_player_type']}\",
	`player_type`=\"{$_POST['player_type']}\",
	`player_controls`=\"{$_POST['player_controls']}\",
	`start_page`=\"{$_POST['start_page']}\",
	`username`=\"{$_POST['username']}\",
	`password`=\"{$_POST['password']}\",
	`email`=\"{$_POST['email']}\",
	`channel_name`=\"{$_POST['channel_name']}\",
	`meta_description`=\"{$_POST['meta_description']}\",
	`meta_keywords`=\"{$_POST['meta_keywords']}\",
	`language`=\"{$_POST['language']}\",
	`player_lang`=\"{$_POST['player_lang']}\",
	`location`=\"{$_POST['location']}\",
	`country`=\"{$_POST['country']}\",
	`external_url`=\"{$_POST['external_url']}\",
	`header_pic`=\"{$_POST['header_pic']}\",
	`standby_pic`=\"{$_POST['standby_pic']}\",
	`background_pic`=\"{$_POST['background_pic']}\",
	`background_conf`=\"{$_POST['background_conf']}\",
	`mountpoint_url`=\"{$_POST['mountpoint_url']}\",
	`default_live`=\"{$_POST['default_live']}\",
	`player_width`=\"{$_POST['player_width']}\",
	`player_height`=\"{$_POST['player_height']}\",
	`player_autoplay`=\"{$_POST['player_autoplay']}\",
	`footer_text`=\"{$_POST['footer_text']}\",
	`font_color`=\"{$_POST['font_color']}\",
	`links_color`=\"{$_POST['links_color']}\",
	`background_color`=\"{$_POST['background_color']}\",
	`background_page_color`=\"{$_POST['background_page_color']}\",
	`uptext_live`=\"".str_replace('"',"'",$_POST['uptext_live'])."\",
	`lowtext1_live`=\"".str_replace('"',"'",$_POST['lowtext1_live'])."\",
	`lowtext2_live`=\"".str_replace('"',"'",$_POST['lowtext2_live'])."\",
	`order_videos`=\"{$_POST['order_videos']}\",
	`uptext_mb`=\"".str_replace('"',"'",$_POST['uptext_mb'])."\",
	`lowtext1_mb`=\"".str_replace('"',"'",$_POST['lowtext1_mb'])."\",
	`lowtext2_mb`=\"".str_replace('"',"'",$_POST['lowtext2_mb'])."'\",
	`background_menu_color`=\"{$_POST['background_menu_color']}\",
	`background_playlist_color`=\"{$_POST['background_playlist_color']}\",
	`font_menu_color`=\"{$_POST['font_menu_color']}\",
	`draw_menu_lines`=\"{$_POST['draw_menu_lines']}\",
	`twitter_search`=\"{$_POST['twitter_search']}\" 
where `id`=\"{$_SESSION['id']}\"";
$result=mysql_query($update);
if (!$result) die (mysql_error()."<br><br><br>".$update."END");

mkdir ("../mediabase/".$_POST['username'],0777);  
chmod ("../mediabase/".$_POST['username'],0777);


header('location: /admin');
?>
