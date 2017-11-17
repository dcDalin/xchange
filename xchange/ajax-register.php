<?php

	header('Content-type: application/json');

	require_once 'database/class.user.php';

	$user_home = new USER();

	$response = array();

	if ($_POST) {

		$firstName = trim(ucfirst(strtolower((($_POST['firstName'])))));
		$midName = trim(ucfirst(strtolower((($_POST['midName'])))));
		$surName = trim(ucfirst(strtolower((($_POST['surName'])))));
		$userEmail = trim($_POST['userEmail']);
		$userAddress = trim($_POST['userAddress']);
    $postCode = trim($_POST['postCode']);
		$gender = trim($_POST['gender']);
		$dateOfBirth = trim($_POST['dateOfBirth']);
		$userPass = trim($_POST['userPass']);

		// sha256 password hashing
		$hashed_password = hash('sha256', $userPass);

    $query = "
      INSERT INTO `tbl_users`
        (`firstName`, `midName`, `surName`, `userEmail`, `userAddress`, `postCode`, `gender`, `dateOfBirth`, `userPass`)
      VALUES
        (:firstName, :midName, :surName, :userEmail, :userAddress, :postCode, :gender, :dateOfBirth, :userPass)
    ";
		$stmt = $user_home->runQuery( $query );

		$stmt->bindParam(':firstName', $firstName);
		$stmt->bindParam(':midName', $midName);
		$stmt->bindParam(':surName', $surName);
		$stmt->bindParam(':userEmail', $userEmail);
		$stmt->bindParam(':userAddress', $userAddress);
    $stmt->bindParam(':postCode', $postCode);
		$stmt->bindParam(':gender', $gender);
		$stmt->bindParam(':dateOfBirth', $dateOfBirth);
		$stmt->bindParam(':userPass', $hashed_password);


		// check for successfull registration
    if ( $stmt->execute() ) {
			$response['status'] = 'success';
			$response['message'] = 'Account created successfully';
    } else {
      $response['status'] = 'error'; // could not register
			$response['message'] = 'Error creating account, try again later';
    }
	}

	echo json_encode($response);
