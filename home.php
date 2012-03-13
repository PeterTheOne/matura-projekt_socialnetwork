				<h2>Home</h2>
<?php
if (!(check_login())) {
?>
				<p>Bitte <a href="index.php?page=loginout">Einloggen!</a></p>
<?php
} else {
?>

<?php
//User einladungen anzeigen:
	$user_id = getuser_id();
	$sql = "SELECT COUNT(*) FROM `friends`	WHERE user2_id = '$user_id' AND approved = '0';";
	$result = mysql_result(mysql_query($sql),0);
	if ($result != 0) {
		echo "<p>Freundes Einladungen:</p>\n";
		echo "<ul>\n";
		$sql = "SELECT * FROM `friends`	WHERE user2_id = '$user_id' AND approved = '0';";
		$result = mysql_query($sql);
	while ($row = mysql_fetch_array($result)) {
		echo "<li>Einladung von ";
		echo "<a href=\"index.php?page=profile&amp;user=";
		echo $row['user_id'];
		echo "\">";
		echo getuser_nickname($row['user_id']);
		echo "</a>";
		echo ", <a href=\"index.php?page=addfriend&amp;friend=";
		echo $row['user_id'];
		echo "\">Annehmen</a> oder <a href=\"index.php?page=delfriend&amp;friend=";
		echo $row['user_id'];
		echo "\">Ablehnen</a>?</li>\n";
	}
		echo "</ul>\n";
	}
?>

				<p>Die letzten 10 Leute, die sich registriert haben (neueste oben):</p>
<?php
//Die letzten 10 Leute die sich Registriert haben anzeigen:
	$sql = "SELECT id, nickname FROM `users` ORDER BY id DESC LIMIT 0,10;";
	$result = mysql_query($sql);
	echo "<ul>\n";
	while ($ds = mysql_fetch_object($result)) {
		$id = $ds->id;
		$nickname = $ds->nickname;
		echo "<li><a href=\"index.php?page=profile&amp;user=$id\">$nickname</a></li>\n";
	}
	echo "</ul>\n";
	echo "<p>Zur <a href=\"index.php?page=userlist\">Userliste</a></p>\n";
?>

<?php
}
?>