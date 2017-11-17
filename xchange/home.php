<?php

	session_start();

	define("ROW_PER_PAGE",5);

	require_once 'database/class.user.php';

	$user_home = new USER();

	if(!$user_home->is_logged_in())
	{
		$user_home->redirect('index');
	}

	$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
	$stmt->execute(array(":uid"=>$_SESSION['userSession']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<?php include"includes/header.php" ?>
<?php include"includes/loggedin-nav.php" ?>
<?php include"includes/sidebar.php" ?>
<?php include"includes/footer.php" ?>
