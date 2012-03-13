				<h2>Registrieren</h2>
<?php
	function regform_issubmission() {
		return isset($_POST['checksubmit']);
	}
?>

<?php function regform_printform() { ?>
				<p>Füllen sie bitte alle Felder aus:</p>
				<?php  regform_error_msg(); ?>
				<form action="index.php?page=register" method="post">
				<table>
				<tr><td><label for="nickname">Nickname:</label></td><td><input type="text" name="nickname" id="nickname" /><br /></td></tr>
				<tr><td><label for="password">Passwort:</label></td><td><input type="password" name="password" id="password" /><br /></td></tr>
				<tr><td><label for="mail">E-Mail:</label></td><td><input type="text" name="mail" id="mail" /><br /></td></tr>
				<tr><td><input type="hidden" name="checksubmit" value="checksubmit" />
				<input type="submit" name="submit" value="Abschicken" /></td></tr>
				</table>
				</form>
<?php } ?>

<?php
	function regform_error_msg() {
		global $regform_error_msg;
		if (isset($regform_error_msg)) {
			echo "<p>Fehler:</p>\n";
			echo "<ul>\n";
			foreach ($regform_error_msg as $e) {
				echo "<li>$e</li>\n";
			}
			echo "</ul>\n";
		}
	}
?>

<?php
	function regform_isformvalid() {
		//noch nicht fertig! Noch unsicher!
		global $regform_error_msg;
		if (strlen(trim($_POST['nickname'])) == 0) {
			$regform_error_msg['nickname']= "Nickname fehlt.";
		}
		if (strlen(trim($_POST['password'])) == 0) {
			$regform_error_msg['password']= "Passwort fehlt.";
		}
		if (strlen(trim($_POST['mail'])) == 0) {
			$regform_error_msg['mail']= "Mail fehlt.";
		}
		return (!isset($regform_error_msg));
	}
?>

<?php
	function regform_processform() {
		echo "<ul>\n<li>Registrierung abgeschickt</li>\n";
		//Eingaben in Variablen speichern:
		$nickname = $_POST['nickname'];
		$password = $_POST['password'];
		$mail = $_POST['mail'];
		//MySQL Anfrage erstellen: (noch unsicher!! passwort nicht verschlüsselt!!!)
		//Noch keine überprüfung ob es den user schon gibt!
		$sql = "INSERT INTO `users` (nickname, password, mail) VALUES ('$nickname', '$password', '$mail');";
		$result = mysql_query($sql) OR
			die(htmldie("<li>Sie konnten nicht Registriert werden, MYSQL-Error:".mysql_error()."</li>\n</ul>\n"));
		echo "<li>Sie wurden in die user-tabelle eingetragen</li>\n";
	}
?>

<?php
	if (regform_issubmission()) {
		if (regform_isformvalid()) {
			regform_processform();
		}
		else {
			regform_printform();
		}
	}
	else {
		regform_printform();
	}
?>