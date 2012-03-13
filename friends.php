				<h2>Freunde</h2>
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
			//Freundesliste:
				$sql = "SELECT COUNT(*) FROM `friends`
					WHERE (user_id = '$user_id' OR user2_id = '$user_id') AND approved = 1;;";
				$result = mysql_result(mysql_query($sql),0);	
				if ($result == 0) {
					echo "User hat keine Freunde";
				} else {
					echo "<h3><a>Freunde</a> von ".getuser_nickname($user_id)."</h3>\n";

				$sql = "SELECT * FROM `friends`
					WHERE (user_id = '$user_id' OR user2_id = '$user_id') AND approved = 1;";
				$result = mysql_query($sql);
				echo "<ul>\n";
				while ($ds = mysql_fetch_object($result)) {
					$user1_id = $ds->user_id;
					$user2_id = $ds->user2_id;
					if ($user1_id == $user_id) {
						echo "<li><a rel=\"friend\" href=\"index.php?page=profile&amp;user=$user2_id\">".getuser_nickname($user2_id)."</a></li>\n";
					} elseif ($user2_id == $user_id) {
						echo "<li><a rel=\"friend\" href=\"index.php?page=profile&amp;user=$user1_id\">".getuser_nickname($user1_id)."</a></li>\n";
					};
				};
				echo "</ul>\n";
				};
				?>
				<p>Zurück zum <a rel="me" href="index.php?page=profile&amp;user=<?php echo $user_id?>">Profil</a></p>
<?php
}
?>