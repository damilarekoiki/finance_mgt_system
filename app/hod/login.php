<?php
	header('Content-type:application/json');
	include 'init.php';
	if(isset($_POST['hod_user']) && isset($_POST['hod_pass'])){
		$username=$_POST['hod_user'];
		$password=$_POST['hod_pass'];
		if($hod->login($username,$password)){
			echo json_encode(array('status'=>1,'message'=>'Login successful, we are directing you. Please wait...'));
		}
		else {
			echo json_encode(array('status'=>0,'message'=>'Invalid Username or password'));
		}
	}



?>
