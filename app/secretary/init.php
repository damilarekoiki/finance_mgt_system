<?php
  session_start();
  include_once '../../action/connect.inc.php';
  include_once 'classes/Secretary.php';
  $secretary=new Secretary($pdo);
  include_once '../../Documents.php';
  $documents=new Documents($pdo,'secretary');
  
?>
