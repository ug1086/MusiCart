<?php

	session_start();
	
	require "../includes/db.class.php";
	include ("validations.php");

	if(isset($_POST['submit'])){

		$db = new DB();

		$uid = mysqli_real_escape_string($db->connection, $_POST['uid']);
      	$pwd = mysqli_real_escape_string($db->connection, $_POST['pwd']);

      	if(empty($uid) || empty($pwd)){
	      	header("Location: login.php?login=empty");
      		exit();
      	} else {
      		$result = $db->checkUid($uid);
      		$resultCheck = count($result['id']);
      		 if($resultCheck<1){
      		 	header("Location: login.php?login=error1");
      		 	exit();
      		 } else {
      		 	if($resultCheck>0){
      		 		// De-hashing the password
      		 		$hashedPwdCheck = password_verify($pwd, $result['pwd']);
      		 		if($hashedPwdCheck == false){
      		 			header("Location: login.php?login=error2");
      		 			exit();
      		 		} elseif ($hashedPwdCheck == true) {
      		 			// Log in the user
      		 			$_SESSION['id'] = $result['id'];
      		 			$_SESSION['first'] = $result['first'];
      		 			$_SESSION['last'] = $result['last'];
      		 			$_SESSION['email'] = $result['email'];
      		 			$_SESSION['userid'] = $result['userid'];
      		 			header("Location: index.php");
      		 			exit();
      		 		}
      		 	}
      		 }
      	}
	} else {
	 	header("Location: login.php?login=error3");
	 	exit();
	}

?>