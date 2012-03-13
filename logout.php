<?php
error_reporting(E_ALL);
include 'config.php';
include 'functions.php';
$db_link = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
mysql_select_db(MYSQL_DATABASE, $db_link);

kill_sessions();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
html xmlns="http://www.w3.org/1999/xhtml" lang="de-AT">
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Example-Socialnetwork-Website.com - Logout</title>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen, projection" />
		<link rel="sitemap" href="sitemap.xml" />
	</head>
	<body>
		<div id="logout">
			<p>Sie sind Ausgeloggt, wieder <a href="index.php?page=loginout">Einloggen?</a></p>
		</div>
	</body>
</html>