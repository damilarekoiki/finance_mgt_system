<?php
	session_start();
  include_once '../../action/connect.inc.php';
  include 'classes/Secretary.php';
  $secretary=new Secretary($pdo);
  include 'classes/Documents.php';
  $documents=new Documents($secretary);
?>
