<?php
  include 'init.php';
  include "auth_user.inc.php";
  $tag="budget";
?>

<?php
    if(isset($_POST['forward_budget'])){
        define('UNIQ_ID', $documents->get_uniq_id('budget'));// constant id for a particular budgtet
        $sec_id=$secretary->get_user_id();

        
        $project_name=$_POST['project_name'];

        $revenue_item_array=$_POST['revenue_item'];
        $revenue_amount_array=$_POST['revenue_amount'];
        $e=count($revenue_amount_array);

        $expense_item_array=$_POST['expense_item'];
        $expense_amount_array=$_POST['expense_amount'];

        // first insert revenue information into database
        for($i=0;$i<count($revenue_amount_array);$i++){
            $revenue_item=$revenue_item_array[$i];
            $revenue_amount=$revenue_amount_array[$i];
            $category="revenue";

            $data=array("uniq_id"=>UNIQ_ID,"category"=>$category,'project_name'=>$project_name,'item'=>$revenue_item,'amount'=>$revenue_amount);
            $res=json_decode($secretary->forward_budget($data,$sec_id),true);
            $a=$res['status'];
        }

        for($i=0;$i<count($expense_amount_array);$i++){
            $revenue_item=$expense_item_array[$i];
            $revenue_amount=$expense_amount_array[$i];
            $category="expense";

            $data=array("uniq_id"=>UNIQ_ID,"category"=>$category,'project_name'=>$project_name,'item'=>$revenue_item,'amount'=>$revenue_amount);
            $res=json_decode($secretary->forward_budget($data,$sec_id),true);
            echo $res['status'];
        }


    }

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>HOD PAGE</title>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/jquery-ui.css"/>
      <!-- Bootstrap Core CSS -->
      <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">

      <!-- Custom CSS -->
      <link href="../../assets/css/sb-admin.css" rel="stylesheet">

      <!-- Morris Charts CSS -->
      <link href="../../assets/css/plugins/morris.css" rel="stylesheet">

      <!-- Custom Fonts -->
      <link href="../../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  	<link rel="stylesheet" href="../../assets/css/style.css" type="text/css"/>
</head>

<body>
	<div id="wrapper">

        <?php
            include("side_nav.php");
        ?>

        <div id="page-wrapper" class="" style="min-height:500px">

            <div class="container-fluid">
        <div class="col-xs-offset-1 col-md-11 row" style="color:#003;font-size:20px;font-weight:bold">
                  FORWARD BUDGET TO H.O.D
                </div>
                <!-- Page Heading -->
                <div class="row col-md-12">
                <div class="" id='tableDiv' style="height:500px;overflow:auto;" class="col-md-12">
                    <button  class="btn btn-primary pull-left expense-left-button" id="addCol">Add more columns </button>
                    <form class="form form-group" method="POST" action="sec_budget.php">
                        <input type="submit" name="forward_budget" value="Forward" class="btn btn-success expense-left-button pull-left"/>
                        <div style="font-size:13px"><span class="pull-left">This budget is for</span>
                        <input type="text" name="project_name" class="form-control" placeholder="DUMMY PROJECT" style="width:30%;border-top:none;border-right:none;border-left:none;font-size:15px"/>
                        </div>
                        <br/>
                        <div style="color:#003;font-size:10px;" class="col-xs-offset-4">drag table by the right to increase size</div>
                        <table id='table'>
                            <tbody id='tableBody'>
                                <tr align="center">
                                <th>  </th>
                                <th colspan="2"> REVENUE  </th>
                                </tr>
                                <tr class="tableRow">
                                    <th><input type="text" value="Source1" name="revenue_item[]" class="form-control"></th>
                                    <th><input type="text" value="Source2" name="revenue_item[]" class="form-control"></th>
                                    <th><input type="text" value="Source3" name="revenue_item[]" class="form-control"></th>
                                </tr>
                                <tr class="tableRow">
                                    <td><input type="text" name="revenue_amount[]" class="form-control"  ></td>
                                    <td><input type="text" name="revenue_amount[]"  class="form-control"></td>
                                    <td><input type="text" name="revenue_amount[]" class="form-control"></td>
                                </tr>



                                <tr align="center">
                                <th>  </th>
                                <th colspan="2"> EXPENSES  </th>
                                </tr>
                                <tr class="tableRow">
                                    <th><input type="text" value="item1" name="expense_item[]" class="form-control"></th>
                                    <th><input type="text" value="item2" name="expense_item[]" class="form-control"></th>
                                    <th><input type="text" value="item3" name="expense_item[]" class="form-control"></th>
                                </tr>
                                <tr class="tableRow">
                                    <td><input type="text" name="expense_amount[]" class="form-control"  ></td>
                                    <td><input type="text" name="expense_amount[]"  class="form-control"></td>
                                    <td><input type="text" name="expense_amount[]" class="form-control"></td>
                                </tr>

                            </tbody>

    
                        </table>
                    </form>


                </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            <div>

            </div>
        </div>
        <!-- /#page-wrapper  hod_exp_rep-->

      </div>





<script type="text/javascript" src="../../assets/js/jquery.js"> </script>
  <script type="text/javascript" src="../../assets/js/jquery-ui.js"> </script>
  <script type="text/javascript" src="../../assets/js/bootstrap.min.js"> </script>
  <script src="../../assets/js/plugins/morris/raphael.min.js"></script>
  <script src="../../assets/js/plugins/morris/morris.min.js"></script>
  <script src="../../assets/js/plugins/morris/morris-data.js"></script>
    <script>
        $('document').ready(function (params) {
            $('#table').resizable({
                animate:true,
                animateDuration:500,
                ghost:true,
                autoHide:false,
                handles:'e'
            });
        });
        $('#addCol').click(function (params) {
            rows=document.getElementById('table').rows;
            rowLength=rows.length;
            for(i=1;i<rowLength;i++){
                if(i==1){
                    rows[i].innerHTML+='<th><input type="text" value="New Source" name="revenue_item[]" class="form-control"></th>';
                }
                else if(i==2){
                    rows[i].innerHTML+='<td><input type="text" name="revenue_amount[]" class="form-control"></td>';
                }
                else if(i==4){
                    rows[i].innerHTML+='<th><input type="text" value="New Item" name="expense_item[]" class="form-control"></th>';
                }
                else if(i==5){
                    rows[i].innerHTML+='<td><input type="text" name="expense_amount[]" class="form-control"></td>';
                }

            }
        })

    </script>

</body>
</html>
