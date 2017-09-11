<?php
  /**
   *
   */
  class Secretary{
    private $db_connection;
    function __construct($db){
      $this->db_connection=$db;
    }
    public function login($username,$password){
      # code...
      try {
        $stmt=$this->db_connection->prepare("SELECT * FROM secretary WHERE username=:username AND password=:password");
        $stmt->execute(array("username"=>$username,"password"=>$password));
        $row=$stmt->fetchAll();
        if(count($row)==1){
          $_SESSION['secretary']=$username;
          return true;
        }
        else return false;
      } catch (PDOException $e) {
          return $e->getMessage();
      }
    }
    public function is_login()  {
      # code...
      if (isset($_SESSION['secretary'])) {
        # code...
        return true;
      }
      else {
        return false;
      }
    }
    public function get_login_user(){
      # code...
      if($this->is_login()){
        return $_SESSION['secretary'];
      }
    }
    public function get_user_id(){
      # code...
      $user=$this->get_login_user();
      try {
        $stmt=$this->db_connection->prepare("SELECT id FROM secretary WHERE username=?");
        $stmt->execute(array($user));
        $row=$stmt->fetch();
        return $row['id'];
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function forward_budget($data_array,$secretary_id){
      # code...
      $item=$data_array['item'];
      $amount=$data_array['amount'];
      $project_name=$data_array['project_name'];
      $category=$data_array['category'];
      $uniq_id=$data_array['uniq_id'];
      try {
        $stmt=$this->db_connection->prepare(
          "INSERT INTO budget(uniq_id,project_name,category,item,amount,secretary_id,cdate) VALUES(?,?,?,?,?,?,NOW())");
        $res=$stmt->execute([$uniq_id,$project_name,$category,$item,$amount,$secretary_id]);
        if($res){
          $message=json_encode(array('status'=>1));
        }
        else{
          $message=json_encode(array('status'=>0));
        }
        return $message;

      } catch (PDOException $e) {
        return $e->getMessage();
      }


    }
    public function forward_expense_report($data_array,$secretary_id){
      # code...
      $uniq_id=$data_array['uniq_id'];
      $item=$data_array['item'];
      $amount=$data_array['amount'];
      $description=$data_array['description'];
      $date=$data_array['date'];
      $secretary_id=$secretary_id;
      try {
        $stmt=$this->db_connection->prepare(
          "INSERT INTO expense_report(uniq_id,item,description,amount,item_date,secretary_id,cdate) VALUES(?,?,?,?,?,?,NOW())");
        $res=$stmt->execute([$uniq_id,$item,$description,$amount,$date,$secretary_id]);
        if($res){
          $message=json_encode(array('status'=>1));
        }
        else{
          $message=json_encode(array('status'=>0));
        }
        return $message;

      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function forward_stmt_of_acc_query($query_msg,$secretary_id){
      try {
        $stmt=$this->db_connection->prepare(
          "INSERT INTO stmt_account(query_message,secretary_id,cdate) VALUES(?,?,NOW())");
        $res=$stmt->execute([$query_msg,$secretary_id]);
        if($res){
          $message=json_encode(array('status'=>1));
        }
        else{
          $message=json_encode(array('status'=>0));
        }
        return $message;

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
