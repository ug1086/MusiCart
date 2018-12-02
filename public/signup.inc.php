<?php

	  require "../includes/db.class.php";
      include ("validations.php");
      include_once ("LIB_project1.php");

      if(isset($_POST['submit'])){

      	$db = new DB();

      	$first = mysqli_real_escape_string($db->connection, $_POST['first']);
      	$last = mysqli_real_escape_string($db->connection, $_POST['last']);
      	$email = mysqli_real_escape_string($db->connection, $_POST['email']);
      	$uid = mysqli_real_escape_string($db->connection, $_POST['uid']);
      	$pwd = mysqli_real_escape_string($db->connection, $_POST['pwd']);

      	if(empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)){
	      	header("Location: signup.php?signup=empty");
      		exit();
      	} else {
      		if(!alphabetic($first) || !alphabetic($last)){
      			header("Location: signup.php?signup=invalid");
      			exit();
      		} else {
      			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      				header("Location: signup.php?signup=email");
      				exit();
      			} else {
      				$resultCheck = $db->checkUid($uid);

      				if($resultCheck > 0){
      					header("Location: signup.php?signup=usertaken");
      					exit();
      				} else {
      					// Hashing the password
      					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
      					$db->insertUser($first, $last, $email, $uid, $hashedPwd);
      					header("Location: login.php");
      					exit();
      				}
      			}

      		}
      	}

      } else {
      		header("Location: signup.php");
      		exit();
      }

?>