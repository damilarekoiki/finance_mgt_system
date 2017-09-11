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
      else{
        return false;
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
    public function approve($uniq_id,$table,$col_array){
      # code...
      $set_col=$col_array['set_col'];
      $where_col=$col_array['where_col'];

      $res=json_decode($this->update_table($table,$col_array,$uniq_id,1),true);
      $status=$res['status'];
      if($status=1){
        return json_encode(array('status'=>1,'message'=>'Approval Successfully Made'));
      }else {
        # code...
        return json_encode(array('status'=>0,'message'=>'Something Went Wrong'));
      }
      
    }
    public function rev_approval($uniq_id,$table,$col_array){
      # code...
      $res=json_decode($this->update_table($table,$col_array,$uniq_id,0),true);
      $status=$res['status'];
      if($status=1){
        return json_encode(array('status'=>1,'message'=>'Approval Successfully Reversed'));
      }else {
        # code...
        return json_encode(array('status'=>0,'message'=>'Something Went Wrong'));
      }
    }

    public function update_table($table,$col_array,$uniq_id,$data){
      # code...
      try {
        $set_col=$col_array['set_col'];
        $where_col=$col_array['where_col'];

        $stmt=$this->db_connection->prepare("UPDATE $table SET $set_col=? WHERE $where_col=?");
        if($stmt->execute(array($data,$uniq_id))){
          return json_encode(array('status'=>1));
        }
        else{
          return json_encode(array('status'=>0));
        }
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function approve_or_disapprove($table,$col_array){
      if(isset($_POST['approve'])){
        $uniq_id=$_POST['uniq_id'];
        $res=json_decode($this->approve($uniq_id,$table,$col_array),true);
        $message=$res['message'];
        if($res['status']==1){
            echo "<div class='alert alert-success'> $message </div>";
        }
        else{
            echo "<div class='alert alert-danger'> $message </div>";
        }
      }elseif(isset($_POST['rev_approval'])) {
          $res=json_decode($this->rev_approval($uniq_id,$table,$col_array),true);
          $message=$res['message'];
          if($res['status']==1){
              echo "<div class='alert alert-success'> $message </div>";
          }
          else{
              echo "<div class='alert alert-danger'> $message </div>";
          } 
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
      header("Refresh: 1; URL=$url");
      exit();
    }
    public function logout(){
      # code...
      session_unset();
      session_destroy();

    }

  }

?>
