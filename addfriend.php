				<h2>Freunde Hinzufügen</h2>
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
				
			//schauen ob man sich selbst als Freund hinzufügen will
				!($user_id == $friend_id) OR
					die(htmldie("<p>Du kannst dich nicht selbst als Freund hinzufügen!</p>\n"));
			//schauen ob er bereits ein freund ist
				isfriend($friend_id) != "friend" OR
					die(htmldie(getuser_nickname($friend_id)." ist bereits dein Freund\n"));
			//schauen ob bereits eine einladung geschickt worden ist
				isfriend($friend_id) != "request_by_you" OR
					die(htmldie("Du hast bereits eine Einladung geschickt an ".getuser_nickname($friend_id)."\n"));
					
				$sql = "SELECT COUNT(*) FROM `friends` WHERE user_id = '$friend_id' AND user2_id = '$user_id' AND approved = '0';";
				$result = mysql_result(mysql_query($sql),0);
				if ($result!=0) {
				//Einladung bestätigen:
					$sql = "UPDATE `friends` SET approved = '1' WHERE user2_id = '$user_id' AND user_id = '$friend_id' AND approved = '0';";
					$result = mysql_query($sql) OR
						die(htmldie("Freund-Einladung konnte nicht bestätigt werden, MYSQL-Error:".mysql_error()."\n"));
					echo "Freund-Einladung von <a href=\"index.php?page=profile&amp;user=$friend_id\">".getuser_nickname($friend_id)."</a> wurde bestätigt\n";
				} else {
				//Einladung schicken:
					$sql = "INSERT INTO `friends` (user_id, user2_id, approved) VALUES ('$user_id', '$friend_id', '0');";
					$result = mysql_query($sql) OR
						die(htmldie("Freund konnte nicht hinzugefügt werden, MYSQL-Error:".mysql_error()."\n"));
					echo "Freund hinzugefügt! Jetzt muss ihr Freund die Einladung nur noch bestätigen.\n";
				}
				?>
<?php
}
?>