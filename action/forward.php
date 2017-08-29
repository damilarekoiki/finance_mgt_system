<?php
	//define("FOLDER","C:/xampp/htdocs/S.A.D_project/documents/");
	include "connect.php";
	$table=$_GET['action'];
	if($table=='budget'){
		$file=$_FILES['hod_bdgt_doc'];
		$note=$_POST['hod_bdgt_note'];
		$cdate=$_POST['hod_bdgt_date'];
		$repository="C:/xampp/htdocs/S.A.D_project/documents/budget_hod";
	}
	elseif($table=='account_query'){
		$file=$_FILES['hod_query_doc'];
		$note=$_POST['hod_query_note'];
		$cdate=$_POST['hod_query_date'];
		$repository="C:/xampp/htdocs/S.A.D_project/documents/acc_query_hod";
	}
	elseif($table=='expense_report'){
		$file=$_FILES['hod_rep_doc'];
		$note=$_POST['hod_rep_note'];
		$cdate=$_POST['hod_rep_date'];
		$repository="C:/xampp/htdocs/S.A.D_project/documents/expense_report_hod";
	}
	// $hodQuery=$db->query("SELECT id FROM hod");
	// $length=$hodQuery->num_rows;
	$date_sent=date("d-M-Y-H-i-s");
	$file_name=$date_sent.'_'.$file['name'];
	$file_type=$file['type'];
	forward_document($table,$file_name,$note,$file_type,$cdate,$date_sent);

	function forward_document($table,$file_name,$note,$file_type,$cdate,$date_sent){
		global $db;
		global $file;
		global $repository;
		if(is_uploaded_file($file['tmp_name'])){
			if(!is_dir($repository)){
				mkdir($repository);
			}
			$result=move_uploaded_file($file['tmp_name'],$repository."/$file_name") or die("Could not forward document");

			$query="INSERT INTO $table(file_name,note,file_type,date_created,date_sent) VALUES(?,?,?,?,NOW())";
			$statement=$db->prepare($query);
			$statement->bind_param('ssss',$file_name,$note,$file_type,$cdate);
			if($statement->execute()){
				echo "done";
			}
		}
		else{
			echo "You did not select a document";
		}


	}
?>
