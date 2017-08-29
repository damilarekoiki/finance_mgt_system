<?php
  include 'init.php';
?>

<?php
    if(isset($_POST['forward_stmt_acc'])){
        $secretary_id=$secretary->get_user_id();
        $query_msg=$_POST['query_msg'];
        echo "<script> alert('1') </script>";
        json_decode($secretary->forward_stmt_of_acc_query($query_msg,$secretary_id),true);
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
            <div style="color:#003;font-size:20px;font-weight:bold">
                <div class="col-xs-offset-1">FORWARD STATEMENT OF ACCOUNT TO H.O.D</div>
                <div style="font-size:15px;color:#025" class="alert alert-danger"><span class="col-xs-offset-1">Some features are not supported</span></div>
            </div>
            <div>
            
                <form action="sec_stmt_acc.php" method="POST">
                    <textarea name="query_msg" id="stmtAcc" cols="30" rows="10">
                    
                    </textarea>
                    <br/>
                    <input type="submit" value="Forward" name="forward_stmt_acc" class="btn btn-success"/>
                </form>
            </div>

                

                <div class="col-md-12">
                    <!-- fetch statem acc -->
                    <?php
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

                        $result=json_decode($secretary->get_uniq_stmt_acc($paging,0),true);
                        // var_dump($result);
                        // $json_response=json_decode($response,true);
                        $count=$result['count'];
                        $total_pages=$result['total_pages'];
                        
                        for($i=0;$i<$count;$i++){
                            echo $result['query'][$i]['query_msg']."<br/>";
                        }
                        if($total_pages!=0){
                            for ($i=1; $i <=$total_pages ; $i++) {
                            echo "<a href='index.php?page=$i'> $i </a> &nbsp;";
                            }
                        }
                    ?>

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
    CKEDITOR.replace('query_msg');
    // $( 'textarea.editor' ).ckeditor();
    // </script>

</body>
</html>

