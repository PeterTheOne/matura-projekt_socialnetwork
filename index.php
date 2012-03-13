<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
error_reporting(E_ALL);
include 'config.php';
include 'functions.php';
$db_link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
mysql_select_db(MYSQL_DATABASE, $db_link);
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="de-AT">
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Example-Socialnetwork-Website.com - Home</title>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen, projection" />
		<link rel="sitemap" href="sitemap.xml" />
	</head>
	<body>
		<div id="sidebar">
			<?php include 'sidebar.php' ?>
		</div>
		<div id="content">
			<div id="header">
				<?php include 'header.php' ?>
			</div>
			<div id="page">
				<?php
				// Auswahl der Page (noch nicht sicher!!!)
				if(isset($_GET['page'])) {
					$page = htmlentities($_GET['page'],ENT_QUOTES).'.php';
					if (file_exists($page)) {
						include $page;}
					else {
						include 'home.php';}}
				else {
					include 'home.php';}
				?>
			</div>
			<div id="footer">
				<?php include 'footer.php' ?>
			</div>
		</div>
		<div id="ads">
			<?php include 'ads.php' ?>
		</div>
	</body>
</html>