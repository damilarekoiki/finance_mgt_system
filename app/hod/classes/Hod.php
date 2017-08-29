<?php
  /**
   *
   */
  class Hod{
    private $db_connection;
    function __construct($db){
      $this->db_connection=$db;
    }
    public function login($username,$password){
      # code...
      try {
        $stmt=$this->db_connection->prepare("SELECT * FROM hod WHERE username=:username AND password=:password");
        $stmt->execute(array("username"=>$username,"password"=>$password));
        $row=$stmt->fetchAll();
        if(count($row)>0){
          $_SESSION['hod']=$username;
          return true;
        }
        else return false;
      } catch (PDOException $e) {
          return $e->getMessage();
      }

    }
    public function is_login()  {
      # code...
      if (isset($_SESSION['hod'])) {
        # code...
        return true;
      }
    }
    public function get_login_user(){
      # code...
      if($this->is_login()){
        return $_SESSION['hod'];
      }
    }
    public function get_user_id(){
      # code...
      $user=$this->get_login_user();
      try {
        $stmt=$this->db_connection->prepare("SELECT id FROM hod WHERE username=?");
        $stmt->execute(array($user));
        $row=$stmt->fetch();
        return $row['id'];
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }
    public function approve($inst_id,$table,$table_col='is_approved'){
      # code...
      try {
        $stmt=$this->db_connection->prepare("UPDATE $table SET $table_col=? WHERE inst_id=?");
        if($stmt->execute(array(1,$inst_id))){
          return json_encode(array('message'=>'Approval Successfully made'));
        }
      } catch (PDOException $e) {
        return $e->getMessage();
      }

    }
    public function decline($inst_id,$table,$table_col='is_approved'){
      # code...
      try {
        $stmt=$this->db_connection->prepare("UPDATE $table SET $table_col=? WHERE inst_id=?");
        if($stmt->execute(array(-1,$inst_id))){
          return json_encode(array('message'=>'Decline Successfully made'));
        }
      } catch (PDOException $e) {
        return $e->getMessage();
      }

    }
    public function change_password($id,$table,$secretary_id){
      # code...
    }
    public function reset_password($id,$table,$secretary_id){
      # code...
    }
    public function redirect($url){
      # code...
      header("Location: ".$url."");
    }
    public function logout(){

    }

  }

?>
