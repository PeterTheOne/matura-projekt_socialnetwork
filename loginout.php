				<h2>Login/Logout</h2>
<?php
	function loginform_issubmission() {
		return isset($_POST['checksubmit']);
	}
?>

<?php
	function loginform_printform() {
		if (check_login()) {
			echo "<p><a href=\"logout.php\">Ausloggen?</a></p>";
		} else {
?>
				<p>Füllen sie bitte alle Felder aus:</p>
				<?php  loginform_error_msg(); ?>
				<form action="index.php?page=loginout" method="post">
				<table>
				<tr><td><label for="nickname">Nickname:</label></td><td><input type="text" name="nickname" id="nickname" /><br /></td></tr>
				<tr><td><label for="password">Passwort:</label></td><td><input type="password" name="password" id="password" /><br /></td></tr>
				<tr><td><input type="hidden" name="checksubmit" value="checksubmit" />
				<input type="submit" name="submit" value="Abschicken" /></td></tr>
				</table>
				</form>
				<p>Noch nicht Registriert? <a href="index.php?page=register">Registrieren</a></p>
<?php }} ?>

<?php
	function loginform_error_msg() {
		global $loginform_error_msg;
		if (isset($loginform_error_msg)) {
			echo "<p>Fehler:</p>\n";
			echo "<ul>\n";
			foreach ($loginform_error_msg as $e) {
				echo "<li>$e</li>\n";
			}
			echo "</ul>\n";
		}
	}
?>

<?php
	function loginform_isformvalid() {
		//noch nicht fertig! Noch unsicher!
		global $loginform_error_msg;
		if (strlen(trim($_POST['nickname'])) == 0) {
			$loginform_error_msg['nickname']= "Nickname fehlt.";
		}
		if (strlen(trim($_POST['password'])) == 0) {
			$loginform_error_msg['password']= "Passwort fehlt.";
		}
		return (!isset($loginform_error_msg));
	}
?>

<?php
	function loginform_processform() {
		echo "<ul>\n<li>Loginabfrage abgeschickt</li>\n";
		//Eingaben in Variablen speichern:
		$nickname = $_POST['nickname'];
		$password = $_POST['password'];
		//MySQL Anfrage erstellen um das Passwort aus der Datenbank zu holen:
		$sql = "SELECT password FROM `users` WHERE nickname = '$nickname';";
		if (!($result = mysql_fetch_assoc(mysql_query($sql))) || ($result == "")) {
			echo "<li>Passwort konnte nicht angefordert werden, MYSQL-Error:".mysql_error()."</li>\n</ul>\n";
			echo "<p><a href=\"index.php?page=loginout\">Noch ein Mal probieren</a></p>\n";
		} else {
			echo "<li>Passwort wurde angefordert</li>\n";
			if (!($result['password'] == $password)) {
				echo "<li>Passwort und/oder Nickname ist Falsch</li>\n</ul>\n";
				echo "<p><a href=\"index.php?page=loginout\">Noch ein Mal probieren</a></p>\n";
			} else {
				echo "<li>Passwort ist korrekt</li>\n</ul>\n";
				$_SESSION['login'] = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
				$_SESSION['nickname'] = $nickname;
				echo "<p>Zur \"<a href=\"index.php\">Home</a>\" Seite</p>\n";
			}
		}
	}
?>

<?php
	if (loginform_issubmission()) {
		if (loginform_isformvalid()) {
			loginform_processform();
		}
		else {
			loginform_printform();
		}
	}
	else {
		loginform_printform();
	}
?>