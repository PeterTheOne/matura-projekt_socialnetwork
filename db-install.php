				<h2>Datenbank Installation</h2>
				<?php
				echo "<ul>\n";
			// Versuch MYSQL Verbindung aufbauen
				($db_link) OR
					die(htmldie("<li> MYSQL Verbindung konnte nicht aufgebaut werden, MYSQL-Error:".mysql_error()."</li>\n</ul>\n"));
				echo "<li>SQL Verbindung aufgebaut</li>\n";
			// Versuch Datenbank Verbindung aufzubauen:
				!(mysql_select_db(MYSQL_DATABASE, $db_link)) OR
					die(htmldie("<li>Die Datenbank \"".MYSQL_DATABASE."\" gibt es schon! (Die Datenbank könnte bereits installiert sein)</li>\n</ul>\n")); 
				echo "<li>Die Datenbank \"".MYSQL_DATABASE."\" gibt es noch nicht (muss aufgebaut werden)</li>\n";
			// Versuch Datenbank zu erstellen:
				$sql = "CREATE DATABASE `".MYSQL_DATABASE."`;";
				$result = mysql_query($sql) OR
					die(htmldie("<li>Die Datenbank \"".MYSQL_DATABASE."\" konnte nicht aufgebaut werden, MYSQL-Error:".mysql_error()."</li>\n</ul>\n"));
				echo "<li>Die Datenbank \"".MYSQL_DATABASE."\" wurde erfolgreich aufgebaut</li>\n";
				mysql_select_db(MYSQL_DATABASE, $db_link);
			// Versuch Tabelle "users" zu erstellen:
				$sql = "CREATE TABLE `users`(
					`id` INT NOT NULL AUTO_INCREMENT ,
					`nickname` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
					`password` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
					`mail` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
					`admin` INT( 1 ) NOT NULL ,
					PRIMARY KEY ( `id` ));";
				$result = mysql_query($sql) OR
					die(htmldie("<li>Die Tabelle \"users\" konnte nicht aufgebaut werden, MYSQL-Error:".mysql_error()."</li>\n</ul>\n"));
				echo "<li>Die Tabelle \"users\" wurde erfolgreich aufgebaut</li>\n";
			// Versuch Tabelle "friends" zu erstellen:
				$sql = "CREATE TABLE `friends`(
					`user_id` INT NOT NULL,
					`user2_id` INT NOT NULL ,
					`approved` INT( 1 ) NOT NULL);";
				$result = mysql_query($sql) OR
					die(htmldie("<li>Die Tabelle \"friends\" konnte nicht aufgebaut werden, MYSQL-Error:".mysql_error()."</li>\n</ul>\n"));
				echo "<li>Die Tabelle \"friends\" wurde erfolgreich aufgebaut</li>\n";
			// Versuch Tabelle "profile_comments" zu erstellen:
				$sql = "CREATE TABLE `profile_comments`(
					`id` INT NOT NULL AUTO_INCREMENT ,
					`sender_id` INT NOT NULL ,
					`recipient_id` INT NOT NULL ,
					`subject` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
					`message` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
					PRIMARY KEY ( `id` ));";
				$result = mysql_query($sql) OR
					die(htmldie("<li>Die Tabelle \"profile_comments\" konnte nicht aufgebaut werden, MYSQL-Error:".mysql_error()."</li>\n</ul>\n"));
				echo "<li>Die Tabelle \"profile_comments\" wurde erfolgreich aufgebaut</li>\n";
				
				echo "<li>Fertig</li>\n";
				echo "</ul>\n";
				?>