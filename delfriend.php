				<h2>Freunde Löschen</h2>
<?php
if (!(check_login())) {
?>
				<p>Bitte <a href="index.php?page=loginout">Einloggen!</a></p>
<?php
} else {
?>
				<?php
				$user_id = getuser_id();
				$friend_id = $_GET['friend'];
				
			//schauen ob er wirklich bereits dein freund ist oder wirklich eine Einladung an dich geschickt hat:
				((isfriend($friend_id) != false) OR ((isfriend($friend_id) != "request_by_friend"))) OR
					die(htmldie(getuser_nickname($friend_id)." ist nicht dein Freund und hat auch keine Einladung geschickt\n"));
			//Löschen von Einladung oder Freund:
				$sql = "DELETE FROM `friends`
					WHERE ((user_id = '$user_id' AND user2_id = '$friend_id')
					OR (user_id = '$friend_id' AND user2_id = '$user_id')) LIMIT 1;";
				$result = mysql_query($sql) OR
					die(htmldie("Freund konnte nicht gelöscht werden, MYSQL-Error:".mysql_error()."\n"));
				echo "<p>Freund Wurde gelöscht</p>\n";
				?>
<?php
}
?>