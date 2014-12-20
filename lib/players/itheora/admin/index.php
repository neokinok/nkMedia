<?php 
$p = isset( $_GET['page'] ) ? $_GET['page'] : 'code';
$lang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']); $lang =substr($lang[0], 0, 2);
 require('../lang/en/'.$p.'.php');
 require('../lang/en/menu.php');
 require('../lang/en/index.php');
if(file_exists( '../lang/'.$lang.'/'.$p.'.php' ) && $lang!="en") {require('../lang/'.$lang.'/'.$p.'.php');};
if(file_exists( '../lang/'.$lang.'/menu.php' ) && $lang!="en") {require('../lang/'.$lang.'/menu.php');};
if(file_exists( '../lang/'.$lang.'/index.php' ) && $lang!="en") {require('../lang/'.$lang.'/index.php');};

$ihost = $_SERVER['SERVER_NAME']; // domaine où se trouve ITheora
$apath = $_SERVER['SCRIPT_NAME']; // chemin vers "admin/index.php"
$ipath = str_replace('admin/index.php', '', $apath); // chemin vers "itheora/"
$iscript = $ipath."index.php"; // chemin vers "index.php"
$document_root=rtrim($_SERVER['DOCUMENT_ROOT'],"/"); // chemin pour les fichier de l'arborescence du serveur
$cacheogg=$document_root.$ipath.'cache';

$page = 'pages/'.$p.'.php';

include ('../lib/fonctions.php');
include ('config/admin.php');

session_start();
if(isset($_POST['user_id'])) { $_SESSION['login']=$_POST['user_id']; }
if(isset($_POST['user_pwd'])) { $_SESSION['pass']=$_POST['user_pwd']; }

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'.$lang.'" lang="'.$lang.'">
<head>
	<title>'.$admin_title.'</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-language" content="'.$lang.'" />
		<link rel="stylesheet" type="text/css" media="all" href="style.css" />
</head>
<body>
<div id="header">
	<img src="images/titre.jpg" alt="ITheora" title="ITheora" height="65" width="300" />
</div>
<div id="gauche">
	<div id="menu">';
	
$structure = '
		<div style="text-align: center">
			<br /><br />
			<span>
				<a href="http://validator.w3.org/check?uri=referer"><img
					src="http://www.w3.org/Icons/valid-xhtml10-blue"
					alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
			</span>
			<br /><br />
			<span>
				<a href="http://jigsaw.w3.org/css-validator/">
					<img style="border:0;width:88px;height:31px"
					src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
					alt="CSS Valide !" />
				</a>
			</span>
		</div>
	</div>
</div>
	<div id="article">
		<div id="contenu">';

$pied_page = '
		</div>
	</div>
	<div id="footer"></div>';

if(isset($_SESSION['login']) && isset($_SESSION['pass'])) { // Page d'accueil
	if(($_SESSION['login']==$admin_username) && ($_SESSION['pass']==$admin_pass)) {
	require( "menu.php");
	echo $structure;
	require( $page ); 
	echo $pied_page;
	} else {
		echo $structure;
		unset($_SESSION['login']); unset($_SESSION['pass']);
		echo '<p>'.txt($bad_login).'</p>';
		echo $pied_page;
	}
} else { // Formulaire d'entree
	echo $structure;
	echo '
		<h1>'.$admin_title.'</h1>
			<br />
			<form action="index.php" method="post"><div style="text-align : left; margin-left : 100px">
				<p><strong>'.txt($user_id).'</strong><br /><input name="user_id" type="text" maxlength="32" value="" /></p>
				<p><strong>'.txt($user_pwd).'</strong><br /><input name="user_pwd" type="password" /></p>
				<p><input class="submit" type="submit" value="'.txt($login_ok).'" /></p>
			</div></form>';
	echo $pied_page;
}
echo '
</body>
</html>';