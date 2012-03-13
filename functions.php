<?php
	function htmldie($error_msg) {
	echo $error_msg;
	echo "			</div>
			<div id=\"footer\">
				";include ("footer.php"); echo "
			</div>
		</div>
		<div id=\"ads\">
			";include ("ads.php"); echo "
		</div>
	</body>
</html>";}

	function check_login() {
		if (isset($_SESSION['login']) && ($_SESSION['login'] == md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']))) {
			return true;
		} else {
			return false;
		}
	}

	function kill_sessions() {
		session_start();
		$_SESSION = array();
		if (isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-86400, '/');
		}
		session_destroy();
	}
	
	function getuser_id() {
		$nickname = $_SESSION['nickname'];
		$sql = "SELECT id FROM `users` WHERE nickname = '$nickname';";
		$result = mysql_fetch_array(mysql_query($sql));
		return $result['id'];
	}
	
	function getuser_nickname($id) {
		$sql = "SELECT nickname FROM `users` WHERE id = '$id';";
		$result = mysql_fetch_array(mysql_query($sql));
		return $result['nickname'];
	}
	
	function isfriend($friend_id) {
		$user_id = getuser_id();
		unset($result);
		$sql = "SELECT * FROM `friends`
			WHERE (user_id = '$user_id' AND user2_id = '$friend_id')
			OR (user_id = '$friend_id' AND user2_id = '$user_id');";
		if (!(mysql_query($sql) == false)) {
			$result = mysql_fetch_array(mysql_query($sql));
			if ($result['approved'] === '0' AND $result['user2_id'] === $friend_id) {
				if ($result['user2_id'] === $friend_id) {return "request_by_you";}
				elseif ($result['user1_id'] === $friend_id) {return "request_by_friend";}
			} elseif ($result['approved'] === '1') {
				return "friend";
			} else {
				return false;
			}
		}
	}

	function check_admin() {
	$user_id = getuser_id();
	$sql = "SELECT admin FROM `users` WHERE id = '$user_id';";
	$result = mysql_fetch_array(mysql_query($sql));
	if ($result['admin'] == 1) { return true;}
	if ($result['admin'] == 0) { return false;}
	}
?>