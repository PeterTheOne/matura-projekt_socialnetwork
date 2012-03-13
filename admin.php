				<h2>Admin Menu</h2>
<?php
if (!(check_login())) {
?>
				<p>Bitte <a href="index.php?page=loginout">Einloggen!</a></p>
<?php
} else {
?>

<?php
if (!(check_admin())) {
?>
				<p>Sie sind kein Admin!</p>
<?php
} else {
?>

					<h3>Info:</h3>
						<p>
						<?php
						if($db_link) {
							echo "MYSQL Datenbank-Verbindung ist: Aufgebaut<br />\n"; }
						else {
							echo "MYSQL Datenbank-Verbindung ist: NICHT Aufgebaut!<br />\n"; }
						$sql = "SELECT COUNT(*) FROM `users`";
						$result = mysql_result(mysql_query($sql),0);
						echo "Anzahl an registrierten Mitgliedern: $result<br />\n";
						$sql = "SELECT COUNT(*) FROM `friends`";
						$result = mysql_result(mysql_query($sql),0);
						echo "Anzahl an Freundes-verbindungen: $result<br />\n";
						$sql = "SELECT COUNT(*) FROM `profile_comments`";
						$result = mysql_result(mysql_query($sql),0);
						echo "Anzahl an öffentlichen Nachrichten in Profilen: $result<br />\n";
						?>
						</p>
					<h3>Optionen:</h3>
						<ul>
							<li><a href="index.php?page=db-install">Datenbank installieren</a></li>
						</ul>

<?php
}
?>

<?php
}
?>