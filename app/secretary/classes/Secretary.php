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
        return true;
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
    public function get_uniq_id($table){
      # code...
      $stmt= $this->db_connection->query("SELECT COUNT(*) FROM $table");
      $uniq_id=$stmt->fetchColumn() + 1;
      return $uniq_id;
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

    public function get_all_budgets($is_approved=''){
      # code...
      try {
        if(isset($is_approved)){
          $num_stmt= $this->db_connection->query("SELECT COUNT(*) FROM budget WHERE is_approved='$is_approved'");
          $stmt=$this->db_connection->prepare("SELECT * FROM budget WHERE is_approved=?");
          $stmt->execute(array($is_approved));
        }
        else {
          $num_stmt= $this->db_connection->query("SELECT COUNT(*) FROM budget");
          $stmt=$this->db_connection->prepare("SELECT * FROM budget");
          $stmt->execute();
        }
        $count=$num_stmt->fetchColumn();

        $budget=array();
        $data=array();
        $i=0;
        if($count>0){
          while ($row=$stmt->fetch()) {
            # code...
            $budget+=array(
              $i=>array(
                'uniq_id'=>$row['uniq_id'],'project_name'=>$row['project_name'],'category'=>$row['category'],'item'=>$row['item'],
                'amount'=>$row['amount'],'cdate'=>$row['cdate']
              ));
              $i++;
          }
          $data+=array('count'=>$count,'budget'=>$budget);
        }else {
          $data+=array('count'=>$count);
        }
        return json_encode($data);
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function get_all_expense_reports($is_approved=''){
      # code...
      try {
        if (isset($is_approved)) {
          $num_stmt= $this->db_connection->query("SELECT COUNT(*) FROM expense_report WHERE is_approved='$is_approved'");
          $stmt=$this->db_connection->prepare("SELECT * FROM expense_report WHERE is_approved=?");
          $stmt->execute(array($is_approved));
        }
        else{
          $num_stmt= $this->db_connection->query("SELECT COUNT(*) FROM expense_report");
          $stmt=$this->db_connection->prepare("SELECT * FROM expense_report");
          $stmt->execute();
        }
        $count=$num_stmt->fetchColumn();
        $exp_report=array();
        $data=array();
        $i=0;
        if($count>0){
          while ($row=$stmt->fetch()) {
            # code...
            $exp_report+=array(
              $i=>array(
                'uniq_id'=>$row['uniq_id'],'item'=>$row['item'],'description'=>$row['description'],
                'amount'=>$row['amount'],'item_date'=>$row['item_date'],'cdate'=>$row['cdate']
              ));
              $i++;
          }
          $data+=array('count'=>$count,'expense_report'=>$exp_report);
        }else {
          $data+=array('count'=>$count);
        }
        return json_encode($data);
      } catch (PDOException $e) {
        return $e->getMessage();
      }

    }

    public function get_uniq_budget($uniq_id){
      try {
        $num_stmt= $this->db_connection->query("SELECT COUNT(*) FROM budget WHERE uniq_id='$uniq_id'");
        $count=$num_stmt->fetchColumn();

        $stmt=$this->db_connection->prepare("SELECT * FROM budget WHERE uniq_id=?");
        $stmt->execute([$uniq_id]);
        $budget=array();
        $revenue=array();
        $expense=array();
        $data=array();
        $j=0;
        for ($i=0;$i<$count/2;$i++) {
          # code...
          $row=$stmt->fetch();
          $revenue+=array(
            $i=>array(
              'uniq_id'=>$row['uniq_id'],'project_name'=>$row['project_name'],'category'=>$row['category'],'item'=>$row['item'],
              'amount'=>$row['amount'],'cdate'=>$row['cdate']
            ));
            //$j++;
        }
        $budget+=array('revenue'=>$revenue);

        for ($i=$count/2;$i<$count;$i++) {
          # code...
          $row=$stmt->fetch();
          $expense+=array(
            $j=>array(
              'uniq_id'=>$row['uniq_id'],'project_name'=>$row['project_name'],'category'=>$row['category'],'item'=>$row['item'],
              'amount'=>$row['amount'],'cdate'=>$row['cdate']
            ));
            $j++;
        }
        $budget+=array('expense'=>$expense);

        $data+=array('count'=>$count,'budget'=>$budget);
        return json_encode($data);
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function get_uniq_expense_report($uniq_id){
      try {
        $num_stmt= $this->db_connection->query("SELECT COUNT(*) FROM expense_report WHERE uniq_id='$uniq_id'");
        $count=$num_stmt->fetchColumn();

        $stmt=$this->db_connection->prepare("SELECT * FROM expense_report WHERE uniq_id=?");
        $stmt->execute([$uniq_id]);
        $exp_report=array();
        $data=array();
        $i=0;
        while ($row=$stmt->fetch()) {
          # code...
          $exp_report+=array(
            $i=>array(
              'uniq_id'=>$row['uniq_id'],'item'=>$row['item'],'description'=>$row['description'],
              'amount'=>$row['amount'],'item_date'=>$row['item_date'],'cdate'=>$row['cdate']
            ));
            $i++;
        }
        $data+=array('count'=>$count,'expense_report'=>$exp_report);
        return json_encode($data);
      } catch (PDOException $e) {
        return $e->getMessage();
      }
    }

    public function filter($array,$main_key,$sub_key,$count){
      $filtered=array();
      for($i=0;$i<$count;$i++){
        $item1=$array[$main_key][$i][$sub_key];
        for($j=$i+1;$j<$count;$j++){
          $item2=$array[$main_key][$j][$sub_key];
          if($item1==$item2){
            if(count($filtered)>0){
              array_pop($filtered);
            }
            if(!in_array($item2,$filtered))
            array_push($filtered,$item2);
          }
          else {
            if(!in_array($item2,$filtered))array_push($filtered,$item2);
          }
        }
      }
      return $filtered;
    }
    public function normal_filter($array,$count){
      $filtered=array();
      for($i=0;$i<$count;$i++){
        $item1=$array[$i];
        for($j=$i+1;$j<$count;$j++){
          $item2=$array[$j];
          if($item1==$item2){
            if(count($filtered)>0){
              array_pop($filtered);
            }
            if(!in_array($item2,$filtered))
            array_push($filtered,$item2);
          }
          else {
            if(!in_array($item2,$filtered))array_push($filtered,$item2);
          }
        }
      }
      return $filtered;
      
    }
    public function forward_stmt_of_acc_quer($id,$table,$secretary_id){
      # code...
    }
    public function change_password($id,$table,$secretary_id){
      # code...
    }
    public function reset_password($id,$table,$secretary_id){
      # code...
    }
    public function redirect($page){
      # code...
    }
    public function logout(){
      # code...
      $user=$this->get_user_id();
      session_destroy();
      session_unset($user);

    }
  }
