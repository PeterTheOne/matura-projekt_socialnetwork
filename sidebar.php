			<h2>Menu</h2>
			<ul>
				<li><a href="index.php?page=home">Home</a></li>
				<li><a href="index.php?page=profile">Mein Profil</a></li>
				<li><a href="index.php?page=friends">Meine Freunde</a></li>
				<li><a href="index.php?page=loginout">Login/Logout</a></li>
				<li><a href="index.php?page=admin">Admin Menu</a></li>
			</ul>
			<?php
				if (check_login()) {
					echo "<p>Eingeloggt als ".getuser_nickname(getuser_id()).", <a href=\"logout.php\">Ausloggen</a>?</p>\n";
				} else {
					echo "<p>Nicht eingeloggt, <a href=\"index.php?page=loginout\">Einloggen</a>?</p>\n";
				}
			?>