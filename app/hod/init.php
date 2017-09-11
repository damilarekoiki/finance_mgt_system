<?php
  session_start();
  include '../../action/connect.inc.php';
  include 'classes/Hod.php';
  $hod=new Hod($pdo);
  include '../../Documents.php';
  $documents=new Documents($pdo,'hod');
  
?>
