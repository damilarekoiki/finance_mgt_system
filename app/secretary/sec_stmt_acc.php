<?php
  include 'init.php';
?>

<?php
    if(isset($_POST['forward_budget'])){
        define('UNIQ_ID', $secretary->get_uniq_id('budget'));// constant id for a particular budgtet
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
  	<link rel="stylesheet" href="../../assets/css/sec.css" type="text/css"/>
</head>

<body>
	<div id="wrapper">

        <?php
            include("side_nav.php");
        ?>

        <div id="page-wrapper" class="" style="min-height:500px">

            <div class="container-fluid">
            <div class="col-xs-offset-1 col-md-11 row" style="color:#003;font-size:20px;font-weight:bold">
                FORWARD STATEMENT OF ACCOUNT TO H.O.D
                <form action="sec_stmt_acc.php" method="POST">
                    <textarea name="stmt_acc" id="stmtAcc" cols="30" rows="10">
                    
                    </textarea>
                </form>
            </div>

                

                <div class="col-md-12">
                    <!-- fetch statem acc -->
                </div>

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
  <script type="text/javascript" src="../../assets/js/ckeditor/ckeditor.js"> </script>
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

    <script>
    CKEDITOR.replace('stmt_acc');
    // $( 'textarea.editor' ).ckeditor();
    // </script>

</body>
</html>

