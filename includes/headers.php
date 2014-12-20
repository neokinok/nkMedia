<html>
<head>

	<title><?=$chn['channel_name']?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="<?=$chn['meta_keywords']?>" />
	<meta name="description" content="<?=$chn['meta_description']?>"/>
	
	<!-- nk style -->
	<link href="/css/global.css" rel="stylesheet" type="text/css" />

        <!-- jQuery and jqModal Dependencies -->
        <script type="text/javascript" src="/lib/jquery/jquery-min.js"></script>
	<link rel="stylesheet" media="screen" type="text/css" href="/lib/colorpicker/css/colorpicker.css" />
	<script type="text/javascript" src="/lib/colorpicker/js/colorpicker.js"></script>

	<!-- global functions -->
	<script type="text/javascript" src="/lib/funcions.js"></script>
	<script type="text/javascript" src="/lib/ckeditor/ckeditor_basic.js"></script> 

	<link rel="shortcut icon" href="/img/icons/favicon.png" />

	<style>
	a {
	
	        text-decoration:none;
	        color:<?=$chn['links_color']?>;
	}
	
	a:hover   { color: <?=$chn['links_color']?>; text-decoration:none; }
	a:active  { text-decoration:none; }
	ul.index li:hover { color: <?=$chn['links_color']?>; }
	.nkbutton {
        background-color:transparent; /*<?=BCOLOR2?>;*/
        padding:5px;
	padding-left:10px;
	padding-right:10px;
        margin:0px;
        float:right;
        color:#<?=$chn['font_menu_color']?>;
        border:0px dotted <?=$chn['background_page_color']?>;
	}

        .nkbutton_selected {
	color:#<?=$chn['font_menu_color']?>;
        padding:5px;
        padding-left:10px;
        padding-right:10px;
        margin:0px;
        float:right;
        border:0px dotted <?=$chn['font_color']?>;

	}

	.nkbutton a {
	 color:#<?=$chn['font_menu_color']?>;
	font-weight:normal;
	}	

	  .nkbutton_selected a {
         color:#<?=$chn['font_menu_color']?>;
	 background-color:transparent;
	font-weight:bold;
        }  

	.producer {
	height: 18px;
	}
	
	td {
	padding:5px;
	}

	body {
	<? if ($chn['background_conf']=="Picture") { ?> background: url('<?=$chn['background_pic']?>') fixed center repeat; <? } ?>
	line-height:140%;
	background-color:#<?=$chn['background_color']?>;
	}
	</style>
</head>

