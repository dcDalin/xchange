<?php

	session_start();

	require_once 'database/class.user.php';

	$user_home = new USER();

	if($user_home->is_logged_in()!="")
	{
		$user_home->redirect('home.php');
	}

	if(isset($_POST['btn-login']))
	{
		//$user_name = $_POST['user_name'];
		//$user_email = trim($_POST['email']);
    $user_email = trim($_POST['email']);
		$user_password = trim($_POST['password']);

		$password = hash('sha256', $user_password);



		try
		{

			$query = "SELECT * FROM tbl_users WHERE userEmail=:email";
			$stmt = $user_home->runQuery( $query );
			$stmt->execute(array(":email"=>$user_email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();

			if($row['userPass']==$password){

				echo "ok"; // log in
				$_SESSION['userSession'] = $row['userID'];
			}
			else{

				echo "Sorry, email and or password is wrong"; // wrong details
			}

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>
