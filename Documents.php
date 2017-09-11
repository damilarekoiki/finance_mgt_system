<?php

    class Documents{
        private $db_connection;
        private $requested_by;
        private $approved;
        private $thispage;
        function __construct($pdo, $who){
          $this->db_connection=$pdo;
          $this->requested_by=$who;
          $this->approved=0;
          $this->thispage=$_SERVER['PHP_SELF'];
        }

        public function get_uniq_id($table){
          # code...
          $stmt= $this->db_connection->query("SELECT COUNT(*) FROM $table");
          $uniq_id=$stmt->fetchColumn() + 1;
          return $uniq_id;
        }

        public function get_all_budgets($is_approved=''){
            # code...
            try {
              if($is_approved!=''){
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
              if ($is_approved!='') {
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
                    'is_approved'=>$row['is_approved'], 'amount'=>$row['amount'], 'cdate'=>$row['cdate']
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
                    'amount'=>$row['amount'],'item_date'=>$row['item_date'],'is_approved'=>$row['is_approved'],'cdate'=>$row['cdate']
                  ));
                  $i++;
              }
              $data+=array('count'=>$count,'expense_report'=>$exp_report);
              return json_encode($data);
            } catch (PDOException $e) {
              return $e->getMessage();
            }
          }
      
          public function get_uniq_stmt_acc($paging,$is_approved=''){
            try {
              $get_page=$paging;
              $start=$get_page['start'];
              $limit=$get_page['limit'];
      
              if($is_approved!=''){
                $stmt = $this->db_connection->prepare("SELECT * FROM stmt_account WHERE is_approved=? LIMIT $start,$limit");
                $stmt->execute(array($is_approved));
                $stmt_num_rows= $this->db_connection->query("SELECT COUNT(*) FROM stmt_account WHERE is_approved='$is_approved'");
                
              }
              else{
                $stmt = $this->db_connection->prepare("SELECT * FROM stmt_account LIMIT $start,$limit");
                $stmt->execute();
                $stmt_num_rows= $this->db_connection->query("SELECT COUNT(*) FROM stmt_account");
                
              }
              $total_query=$stmt_num_rows->fetchColumn();
      
              if ($total_query%$limit==0) {
                $total_pages=floor($total_query/$limit);
              }
              else {
                $total_pages=floor($total_query/$limit)+1;
              }
              $queries=array();
              $data=array();
              $i=0;
              while ($row=$stmt->fetch()) {
                $queries+=array($i=>array('id'=>$row['id'],'query_msg'=>$row['query_message'],'is_approved'=>$row['is_approved'],'date'=>$row['cdate']));
                $i++;
              }
              $data+=array('total_pages'=>$total_pages,'count'=>$i,'query'=>$queries,'is_approved'=>$is_approved);
              return json_encode($data);
            } catch (PDOException $e) {
              return $e->getMessage();
            } 
          }
      
          public function filter($array,$main_key,$sub_key,$count){
            $filtered=array();
            for($i=0;$i<$count;$i++){
              $item1=$array[$main_key][$i][$sub_key];
              for($j=0;$j<$count;$j++){
                $item2=$array[$main_key][$j][$sub_key];
                  if(!in_array($item2,$filtered)) array_push($filtered,$item2);
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

        
        public function budgets($is_approved=''){
            if($is_approved!=''){
                $result=json_decode($this->get_all_budgets($is_approved),true);
            }
            else {
                $result=json_decode($this->get_all_budgets(),true);
                
            }
            
            $count=$result['count'];
            if($count>0){
                $uniq_id_array=$this->filter($result,'budget','uniq_id',$count);

                if(isset($_GET['uniq_id'])){
                $uniq_id=$_GET['uniq_id'];
                }
                else{
                $uniq_id=$uniq_id_array[0];
                }
                $uniq_result=json_decode($this->get_uniq_budget($uniq_id),true);
                $uniq_count=$uniq_result['count'];
            ?>
                <div class='col-md-9'>
                  <table id='table'>
                    <tbody id='tableBody'>
                      <tr align="center">
                      <th>  </th>
                      <th colspan="2"> REVENUE  </th>
                      </tr>
                      <tr class="tableRow">
                          <?php
                              for($i=0;$i<$uniq_count/2;$i++){
                                  $item=$uniq_result['budget']['revenue'][$i]['item'];
                                  echo "<th><input type='text' value='{$item}' name='revenue_item[]' class='form-control'></th>";
                                  $approved=$uniq_result['budget']['revenue'][$i]['is_approved'];
                              }

                          ?>
                      </tr>
                      <tr class="tableRow">
                          <?php
                              for($i=0;$i<$uniq_count/2;$i++){
                                  $amount=$uniq_result['budget']['revenue'][$i]['amount'];
                                  echo "<td><input type='text' value='{$amount}' class='form-control' ></td>";
                                  $this->approved=$uniq_result['budget']['revenue'][$i]['is_approved'];
                              }

                              
                              
                          ?>
                      </tr>
                      <tr align="center">
                      <th>  </th>
                      <th colspan="2"> EXPENSES  </th>
                      </tr>

                      <tr class="tableRow">
                          <?php
                              for($i=0;$i<$uniq_count/2;$i++){
                                  $item=$uniq_result['budget']['expense'][$i]['item'];
                                  echo "<th><input type='text' value='{$item}' class='form-control'></th>";
                              }

                          ?>
                      </tr>
                      <tr class='tableRow'>
                          <?php
                              for($i=0;$i<$uniq_count/2;$i++){
                                  $amount=$uniq_result['budget']['expense'][$i]['amount'];
                                  echo "<td><input type='text' value='{$amount}' class='form-control'  ></td>";

                              }
                          ?>
                      </tr>
                    </tbody>
                  </table>

                  <div class='col-md-5 col-xs-offset-7' style="margin-top:15px;">
                    <?php

                      if($this->requested_by=='secretary'){
                        if($this->approved==0){
                          echo "<span class='btn btn-danger' style='cursor:default;'>unapproved</span>";
                        }
                        elseif($this->approved==1){
                          echo "<span class='btn btn-primary' style='cursor:default;'>approved</span>";
                        }
                      }
                      elseif($this->requested_by=='hod'){
                        if($this->approved==0){
                          echo "<input type='hidden' value='$uniq_id' name='uniq_id'/>";
                          echo "<input type='submit' value='approve' name='approve' class='btn btn-success'/>";
                        }
                        elseif($this->approved==1){
                          echo "<input type='hidden' value='$uniq_id' name='uniq_id'/>";
                          echo "<input type='submit' value='reverse approval' name='rev_approvaa' class='btn btn-success'/>";
                        }
                      }
                    ?>
                  </div>

                <ul class="pagination pagination-lg">
                  <?php
                    // paginate result
                    // if(isset($_GET['uniq_id'])){
                      for($i=0;$i<count($uniq_id_array);$i++){
                        $pag_uniq_id=$uniq_id_array[$i];
                        if(isset($_GET['uniq_id'])){
                          if($pag_uniq_id==$_GET['uniq_id']){
                            echo "<li class='active'><a href='{$this->thispage}?uniq_id=$pag_uniq_id'>".($i+1)."</a></li>";
                          }
                          else{
                            echo "<li><a href='{$this->thispage}?uniq_id=$pag_uniq_id' style='background-color: black;'>".($i+1)."</a></li>";
                          }
                        }
                        else{
                          echo "<li><a href='{$this->thispage}?uniq_id=$pag_uniq_id' style='background-color: black;'>".($i+1)."</a></li>";
                        }
                      }
                    // }
                    
                  ?>
                </ul>
                </div>
                
                .
            <?php
            }else echo "<div>None found for this category</div>";
        }

        public function expense_reports($is_approved=''){
            if($is_approved!=''){
                $result=json_decode($this->get_all_expense_reports($is_approved),true);
            }
            else {
                $result=json_decode($this->get_all_expense_reports(),true);
            }
            $count=$result['count'];
            if($count>0){
                $uniq_id_array=$this->filter($result,'expense_report','uniq_id',$count);
                if(isset($_GET['uniq_id'])){
                $uniq_id=$_GET['uniq_id'];
                }
                else{
                $uniq_id=$uniq_id_array[0];
                }
                $uniq_result=json_decode($this->get_uniq_expense_report($uniq_id),true);
                $uniq_exprep_count=$uniq_result['count'];
                $item_array=$this->filter($uniq_result,'expense_report','item',$uniq_exprep_count);
                $approved_array=$this->filter($uniq_result,'expense_report','is_approved',$uniq_exprep_count);
            ?>
            <div class='col-md-12'>
            <table id='table'>
                        <thead>
                        <tr class="tableRow">
                            <th><input type="text" value="Date" readonly  class="form-control"></th>
                            <th><input type="text" value="Description"  readonly class="form-control"></th>
                            <?php
                                for ($i=0; $i < count($item_array); $i++) { 
                                    # code...
                                    echo "<th><input type='text' value='{$item_array[$i]}' name='item[]' class='form-control'></th>
                                    ";
                                    if($i<=count($approved_array)-1)
                                    $this->approved=$approved_array[$i];
                                }
                            ?>
                        </tr>
                        </thead>
                        <tbody id='tableBody'>
                            <?php
                                $item_date=array();
                                $item_description=array();
                                $item_amount=array();

                                $filt_item_date=array();
                                $filt_item_description=array();
                                $filt_item_amount=array();

                                $a=array();
                                $k=0;
                                $z=0;
                                for($i=0;$i<($uniq_exprep_count - count($item_array));$i++){
                                    $item_date[]=$uniq_result['expense_report'][$i]['item_date'];
                                    $item_description[]=$uniq_result['expense_report'][$i]['description'];
                                    $item_amount[]=$uniq_result['expense_report'][$i]['amount'];
                                    $p=0;
                                    
                                    echo '<tr class="tableRow">';
                                    if($k<count($uniq_result['expense_report'])){
                                        echo "<td><input type='text' value='{$uniq_result['expense_report'][$k]['item_date']}' class='form-control'/></td>";
                                        echo "<td><input type='text' value='{$uniq_result['expense_report'][$k]['description']}' class='form-control'/></td>";
                                    }
                                    
                                    for($j=0;$j<count($item_array);$j++){
                                        try{
                                            if($z+$p<count($uniq_result['expense_report']))
                                            echo "<td><input type='text' value='{$uniq_result['expense_report'][$z+$p]['amount']}'  class='form-control'/></td>";
                                        }
                                        catch(Exception $e){

                                        }
                                        $z++;
                                    }
                                    $k+=count($item_array);
                                    echo "</tr>";
                                }
                                $result=[];
                                ?>

                        </tbody>
                    </table>

                    <div class='col-md-5 col-xs-offset-7' style="margin-top:15px;">
                      <?php

                      if($this->requested_by=='secretary'){
                        if($this->approved==0){
                          echo "<span class='btn btn-danger' style='cursor:default;'>unapproved</span>";
                        }
                        elseif($this->approved==1){
                          echo "<span class='btn btn-primary' style='cursor:default;'>approved</span>";
                        }
                      }
                      elseif($this->requested_by=='hod'){
                        if($this->approved==0){
                          echo "<input type='hidden' value='$uniq_id' name='uniq_id'/>";
                          echo "<input type='submit' value='approve' name='approve' class='btn btn-success'/>";
                        }
                        elseif($this->approved==1){
                          echo "<input type='hidden' value='$uniq_id' name='uniq_id'/>";
                          echo "<input type='submit' value='reverse approval' name='rev_approval' class='btn btn-success'/>";;
                        }
                      }
                    ?>
                  </div>

                    <ul class="pagination pagination-lg">
                      <?php
                        // paginate result
                        // if(isset($_GET['uniq_id'])){
                          
                          for($i=0;$i<count($uniq_id_array);$i++){
                            $pag_uniq_id=$uniq_id_array[$i];
                            if(isset($_GET['uniq_id'])){
                              if($pag_uniq_id==$_GET['uniq_id']){
                                echo "<li class='active'><a href='{$this->thispage}?uniq_id=$pag_uniq_id'>".($i+1)."</a></li>";
                              }else{
                                echo "<li><a href='{$this->thispage}?uniq_id=$pag_uniq_id' style='background-color: black;'>".($i+1)."</a></li>";
                              }
                            }else{
                              echo "<li><a href='{$this->thispage}?uniq_id=$pag_uniq_id' style='background-color: black;'>".($i+1)."</a></li>";
                            }
                          }
                        // }
                        
                    ?>
                  </ul>
                  </div>
                
                  <?php
            }else{
              echo "None found for this category";
            }
        }

        public function stmt_acc($is_approved=''){
          if (isset($_GET['page'])) {
            # code...
            if (is_numeric($_GET['page'])) {
                $page = htmlspecialchars($_GET['page']);
            } else {
                $page = 1 ;
            }
          }else{
              $page = 1;
          }
          $limit=4;
          $start=($page-1)*$limit;
          if($start<0) $start=0;
          $paging = array('start' => $start, 'limit' => $limit);
          if($is_approved!=''){
            $result=json_decode($this->get_uniq_stmt_acc($paging,$is_approved),true);
          }else{
            $result=json_decode($this->get_uniq_stmt_acc($paging),true);
          }
          $count=$result['count'];
          $total_pages=$result['total_pages'];
          if($count>0){
            for($i=0;$i<$count;$i++){
              $uniq_id=$result['query'][$i]['id'];
              echo "<div class='row col-md-12 query_msg'>".$result['query'][$i]['query_msg']."</div>";
            ?>
            <div class='col-md-5 col-xs-offset-7' style="margin-top:15px;">
              <?php
                $this->approved=$result['query'][$i]['is_approved'];
                if($this->requested_by=='secretary'){
                  if($this->approved==0){
                    echo "<span class='btn btn-danger' style='cursor:default;'>unapproved</span>";
                  }
                  elseif($this->approved==1){
                    echo "<span class='btn btn-primary' style='cursor:default;'>approved</span>";
                  }
                }
                elseif($this->requested_by=='hod'){
                  if($this->approved==0){
                    echo "<input type='hidden' value='$uniq_id' name='uniq_id'/>";
                    echo "<input type='submit' value='approve' name='approve' class='btn btn-success'/>";
                  }
                  elseif($this->approved==1){
                    echo "<input type='hidden' value='$uniq_id' name='uniq_id'/>";
                    echo "<input type='submit' value='reverse approval' name='rev_approval' class='btn btn-success'/>";
                  }
                }
            }
              ?>
              </div>
            <?php
            echo '<ul class="pagination pagination-lg">';
              if($total_pages!=0){
                for ($i=1; $i <=$total_pages ; $i++) {
                  if(isset($_GET['uniq_id'])){
                    if($uniq_id==$_GET['uniq_id']){
                      echo "<li class='active'><a href='{$this->thispage}?page=$i'> $i </a></li>";
                    }else{
                      echo "<li><a href='{$this->thispage}?page=$i' style='background-color: black;'>$i</a></li>";
                    }
                  }else{
                    echo "<li><a href='{$this->thispage}?page=$i' style='background-color: black;'>$i</a></li>";
                  }
                }
              }
            echo '</ul>';
          }else{
            echo "None found for this category ";
          }
        }
    }
?>