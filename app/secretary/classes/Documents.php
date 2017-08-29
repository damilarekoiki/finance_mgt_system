<?php

    class Documents{
        private $secretary;
        function __construct($secretary){
          $this->secretary=$secretary;
        }
        
        public function budgets($is_approved=''){
            if(isset($is_approved)){
                $result=json_decode($this->secretary->get_all_budgets($is_approved),true);
            }
            else {
                $result=json_decode($this->secretary->get_all_budgets(),true);
            }
            
            $count=$result['count'];
            if($count>0){
                $uniq_id_array=$this->secretary->filter($result,'budget','uniq_id',$count);
                // paginate reports
                for($i=0;$i<count($uniq_id_array);$i++){
                $uniq_id=$uniq_id_array[$i];
                echo "<a href='sec_budget.php?uniq_id=$uniq_id'>".($i+1)."</a>&nbsp;";
                }
                if(isset($_GET['uniq_id'])){
                $uniq_id=$_GET['uniq_id'];
                }
                else{
                $uniq_id=$uniq_id_array[0];
                }
                $uniq_result=json_decode($this->secretary->get_uniq_budget($uniq_id),true);
                $uniq_count=$uniq_result['count'];
            ?>

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
                                }

                            ?>
                        </tr>
                        <tr class="tableRow">
                            <?php
                                for($i=0;$i<$uniq_count/2;$i++){
                                    $amount=$uniq_result['budget']['revenue'][$i]['amount'];
                                    echo "<td><input type='text' value='{$amount}' class='form-control'  ></td>";
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
            <?php
            }else echo "<div>Nothing found in this category</div>";
        }

        public function expense_reorts($is_approved=''){
            if(isset($is_approved)){
                $result=json_decode($this->secretary->get_all_expense_reports($is_approved),true);
            }
            else {
                $result=json_decode($this->secretary->get_all_expense_reports(),true);
            }
            $count=$result['count'];
            if($count>0){
                $uniq_id_array=$this->secretary->filter($result,'expense_report','uniq_id',$count);
                // paginate reports
                for($i=0;$i<count($uniq_id_array);$i++){
                $uniq_id=$uniq_id_array[$i];
                echo "<a href='sec_expense_report.php?uniq_id=$uniq_id'>".($i+1)."</a>&nbsp;";
                }
                if(isset($_GET['uniq_id'])){
                $uniq_id=$_GET['uniq_id'];
                }
                else{
                $uniq_id=$uniq_id_array[0];
                }
                $uniq_result=json_decode($this->secretary->get_uniq_expense_report($uniq_id),true);
                // var_dump($res);
                $uniq_exprep_count=$uniq_result['count'];
                $item_array=$this->secretary->filter($uniq_result,'expense_report','item',$uniq_exprep_count);
            ?>
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
                  <?php
            }
        }
    }
?>