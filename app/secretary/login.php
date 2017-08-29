<?php
	header('Content-type:application/json');
	include 'init.php';
	if(isset($_POST['sec_user'],$_POST['sec_pass'])){
		$username=$_POST['sec_user'];
		$password=$_POST['sec_pass'];
		if($secretary->login($username,$password)){
			echo json_encode(array('status'=>1,'message'=>'Login successful, we are directing you. Please wait...'));
		}
		else {
			echo json_encode(array('status'=>0,'message'=>'Invalid Username or password'));
		}
	}



?>
