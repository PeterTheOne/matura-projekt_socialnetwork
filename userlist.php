				<h2>Userliste</h2>
<?php
if (!(check_login())) {
?>
				<p>Bitte <a href="index.php?page=loginout">Einloggen!</a></p>
<?php
} else {
?>

<?php
	if(isset($_POST['user'])) {
		$nickname_search = $_POST['user'];
	} else {
		$nickname_search = '';
	}
?>
	<form action="index.php?page=userlist" method="post">
		<label for="user">Search Nickname:</label><input type="text" name="user" id="user" />
		<input type="submit" name="submit" value="Abschicken" />
	</form>

<?php	
//Freundesliste:
	$sql = "SELECT COUNT(*) FROM `users`";
	if ($nickname_search != '') {$sql .= " WHERE nickname LIKE '%$nickname_search%'";}
	$sql .= ";";
	$result = mysql_result(mysql_query($sql),0);	
	if ($result == 0) {
		echo "<p>Es gibt keine User</p>";
	} else {

		$sql = "SELECT * FROM `users`";
		if ($nickname_search != '') {$sql .= " WHERE nickname LIKE '%$nickname_search%'";}
		$sql .= ";";
		$result = mysql_query($sql);
		echo "<table>\n";
		echo "<tr><td>ID</td><td>Nickname</td><td>Friends</td><td>Add to Friends</td></tr>\n";
		while ($ds = mysql_fetch_object($result)) {
			$id = $ds->id;
			$nickname = $ds->nickname;
			$sql = "SELECT COUNT(*) FROM `friends`
				WHERE (user_id = '$id' OR user2_id = '$id') AND approved = 1;";
			$friends_count = mysql_result(mysql_query($sql),0);
			echo "<tr>
				<td>$id</td><td>
				<a href=\"index.php?page=profile&amp;user=$id\">".getuser_nickname($id)."</a></td>
				<td><a href=\"index.php?page=friends&amp;user=$id\">$friends_count</a></td>";
			if ($id==getuser_id()) {
				echo "<td>Das bist du</td>";
			} elseif (isfriend($id) == 'friend') {
				echo "<td>Dein Freund</td>";
			} elseif (isfriend($id) == 'request') {
				echo "<td>Eingeladen</td>";
			} else {
				echo "<td><a href=\"index.php?page=addfriend&amp;friend=$id\">Freund hinzufügen</a></td>";
			};
			echo "</tr>\n";
		};
	echo "</table>\n";
	};
?>

<?php
}
?>