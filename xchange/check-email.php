<?php

	require_once 'database/class.user.php';

	$user_home = new USER();

	if ( isset($_REQUEST['userEmail']) && !empty($_REQUEST['userEmail']) ) {

		$email = trim($_REQUEST['userEmail']);
		$email = strip_tags($email);

		$query = "SELECT userEmail FROM tbl_users WHERE userEmail=:email";
		$stmt = $user_home->runQuery( $query );
		$stmt -> execute(array(':email'=>$email));

		if ($stmt->rowCount() == 1) {
			echo 'false'; // email already taken
		} else {
			echo 'true';
		}
	}
