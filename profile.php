				<h2>Profil</h2>
<?php
if (!(check_login())) {
?>
				<p>Bitte <a href="index.php?page=loginout">Einloggen!</a></p>
<?php
} else {
?>

<?php
	if(isset($_GET['user'])) {
		$user_id = $_GET['user'];
	} else {
		$user_id = getuser_id();
	}
?>

<?php
	if(isset($_POST['submit'])) {
		$sender_id = getuser_id();
		$recipient_id = $user_id;
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$sql = "INSERT INTO `profile_comments` (sender_id, recipient_id, subject, message) 
			VALUES ('$sender_id', '$recipient_id', '$subject', '$message');";
		$result = mysql_query($sql) OR
			die(htmldie("Kommentar konnte nicht hinzugefügt werden, MYSQL-Error:".mysql_error()."\n"));
	}
?>

				<h3>User Profil von <?php echo getuser_nickname($user_id); if($user_id==getuser_id()) {echo " (Das ist dein Profil)";} ?></h3>

				<?php
			//Freundes einladung:
				if ($user_id==getuser_id()) {
					echo "<p>Freund: Das bist du</p>\n";
				} elseif (isfriend($user_id) == 'friend') {
					echo "<p>Freund: Dieser User ist dein Freund, Freund <a href=\"index.php?page=delfriend&amp;friend=$user_id\">löschen</a>?</p>\n";
				} elseif (isfriend($user_id) == 'request') {
					echo "<p>Freund: Dieser User würde von dir Eingeladen</p>\n";
				} else {
					echo "<p>Freund: <a href=\"index.php?page=addfriend&amp;friend=$user_id\">Hinzufügen</a>!</p>\n";
				};
				
			//Freundesliste:
				$sql = "SELECT COUNT(*) FROM `friends`
					WHERE (user_id = '$user_id' OR user2_id = '$user_id') AND approved = 1;";
				$result = mysql_result(mysql_query($sql),0);	
				if (mysql_query($sql) == 0) {
					echo "User hat keine Freunde\n";
				} else {
					echo "<p>".getuser_nickname($user_id)." hat $result <a rel=\"me\" href=\"index.php?page=friends&amp;user=$user_id\">Freund";
					if ($result != 1) {echo "e";};
					echo "</a></p>\n";
				};
			//Informationen:
				$sql = "SELECT mail FROM `users` WHERE id = '$user_id';";
				$result = mysql_fetch_array(mysql_query($sql));
				echo "E-Mail Adresse: ".$result['mail'];
			?>
				<h3>Öffentliche User Kommentare</h3>
					<h4>Formular</h4>
						<form action="index.php?page=profile&amp;user=<?php echo $user_id; ?>" method="post">
							<p><label for="subject">Betreff: </label><input type="text" name="subject" id="subject" /><br />
							<label for="message">Nachricht: </label><textarea name="message" id="message" rows="6" cols="40"></textarea><br />
							<input type="submit" name="submit" value="Abschicken" /></p>
						</form>
					<h4>Kommentare</h4>
<?php
//Form Anzeige
	$sql = "SELECT COUNT(*) FROM `profile_comments` WHERE recipient_id = '$user_id';";
	$comment_count =  mysql_result(mysql_query($sql),0);
	if (!($comment_count > 0)) {	
		echo "<p>Noch keine Kommentare vorhanden</p>\n";
	} else {
		echo "<table class=\"profile_comments\">\n";
		$sql = "SELECT * FROM `profile_comments` WHERE recipient_id = '$user_id' ORDER BY id DESC;";
		$result = mysql_query($sql);
			while ($ds = mysql_fetch_object($result)) {
				$sender_id = $ds->sender_id;
				$subject = $ds->subject;
				$message = htmlentities($ds->message, ENT_QUOTES);
				echo "<tr><td>Von: <a href=\"index.php?page=profile&amp;user=$sender_id\">".getuser_nickname($sender_id)."</a><br />Betreff: $subject</td></tr>\n";
				echo "<tr><td>$message</td></tr>\n";
			}
		echo "</table>\n";
	}
?>

<?php
}
?>