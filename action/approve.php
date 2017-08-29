<?php
  include 'connect.php';
  $table=$_GET['action'];
  if($table=='budget') $id=$_POST['approve_bdgt'];
  $aprv_doc_num=count($id);
  $track=0;
  for($i=0;$i<$aprv_doc_num;$i++){
    if(isset($id)){
      $query=$db->query("UPDATE budget SET is_approved='1' WHERE id='$id'");
      $track++;
    }

  }
  if($track==$aprv_doc_num){
    echo "DOCUMENTS SUCCESSFULLY APPROVED";
  }
  else echo "could not approve";


?>
