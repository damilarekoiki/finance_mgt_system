<?php
// $db=new mysqli('127.0.0.1','root','','sad_project');
// if($db->connect_errno){
//   die('Sorry, we are having some problem...');
// }

  
  $host = '127.0.0.1';
  $db   = 'sad_project';
  $user = 'root';
  $pass = '';
  $charset = 'utf8';

  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  $pdo = new PDO($dsn, $user, $pass, $opt);
?>
