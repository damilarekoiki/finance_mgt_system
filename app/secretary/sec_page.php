<?php
  // include 'app/init.php';
?>
<?php
  /*
    *
    *
    FORWARDING BUDGET
    *
    *
  */
  // get the secretary id
  // $sec_id=$secretary->get_user_id();
  // // get values for the revenue part of the budget
  // $revenue_category='revenue';
  // $title=$_POST['title'];
  // $revenue_caption=$_POST['revenue_caption'];
  // $revenue_item_array=$_POST['revenue_item'];
  // $revenue_amount_array=$_POST['revenue_amount'];
  // $revenue_length=max(count($revenue_item_array),count($revenue_amount_array));
  //
  // // get values for the expense part of the budget
  // $expense_category='expense';
  // $title=$_POST['title'];
  // $expense_caption=$_POST['expense_caption'];
  // $expense_item_array=$_POST['expense_item'];
  // $expense_amount_array=$_POST['expense_amount'];
  // $expense_length=max(count($expense_item_array),count($expense_amount_array));
  //
  // // forward revenue details of the budget
  // for($i=0;$i<$revenue_length;$i++){
  //   $revenue_item=$revenue_item_array[$i];
  //   $revenue_amount=$revenue_amount_array[$i];
  //   $revenue_data = array('item' => $revenue_item, 'amount' => $revenue_amount);
  //   $res=json_decode($secretary->forward_budget($title,$revenue_category,$revenue_caption,$revenue_data,$sec_id));
  // }
  //
  // // forward expense details of the budget
  // for($i=0;$i<$expense_length;$i++){
  //   $expense_item=$expense_item_array[$i];
  //   $expense_amount=$expense_amount_array[$i];
  //   $expense_data = array('item' => $expense_item, 'amount' => $expense_amount);
  //   $res=json_decode($secretary->forward_budget($title,$expense_category,$expense_caption,$expense_data,$sec_id));
  // }
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SECRETARY PAGE</title>
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

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background:#003">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">ADMIN -- computer science UI - FINACE MANAGEMENT SYSTEM</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav navbar-default" style="background:#003;">
              <li><a href="index.php">Home</a></li>
              <li><a href="HOD_page.php">H.O.D Login</a></li>
              <li><a href="#">About Us</a></li>
              <li class="last"><a href="#">Contact US</a></li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                 <ul class="nav navbar-nav side-nav">
                     <li class="active">
                         <a href="javascript:;" data-toggle="collapse" data-target="#budget_dd"><i class="fa fa-fw fa-bar-chart"></i> Budgets <i class="fa fa-fw fa-caret-down"></i></a>
                         <ul id="budget_dd" class="collapse">
                             <li>
                                 <a href="#" id="hod_budget">Forward budget to HOD</a>
                             </li>
                             <li>
                                 <a href="#" id="fac_budget">Forward budget to Faculty</a>
                             </li>
                         </ul>
                     </li>

                     <li>
                         <a href="javascript:;" data-toggle="collapse" data-target="#expr_dd"><i class="fa fa-fw fa-send"></i> Expense Reports <i class="fa fa-fw fa-caret-down"></i></a>
                         <ul id="expr_dd" class="collapse">
                             <li>
                                 <a href="sec_expense_report.php" id="hod_report">Forward report to HOD</a>
                             </li>
                             <li>
                                 <a href="#" id="fac_report">Forward report to Faculty</a>
                             </li>
                         </ul>
                     </li>

                     <li>
                         <a href="javascript:;" data-toggle="collapse" data-target="#stAcc_dd"><i class="fa fa-fw fa-database"></i> Account Query <i class="fa fa-fw fa-caret-down"></i></a>
                         <ul id="stAcc_dd" class="collapse">
                             <li>
                                 <a href="#" id="hod_query">Forward query to HOD</a>
                             </li>
                             <li>
                                 <a href="#" id="fac_query">Forward query to Faculty</a>
                             </li>
                             <li>
                                 <a href="#" id="pg_query">Forward query to PG</a>
                             </li>
                         </ul>
                     </li>

                     <li>
                         <a href="#" id="save"><i class="fa fa-fw fa-save"></i> Save and Store Documents</a>
                     </li>
                     <li>
                         <a href="#" id="settings"><i class="fa fa-fw fa-anchor"></i> Settings</a>
                     </li>
                     <li>
                         <a href="#"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
                     </li>
                 </ul>

             </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" class="page hod_bdgt" style="min-height:500px">

            <div class="container-fluid">
				<div class="col-xs-offset-1" style="color:#003;font-size:20px;font-weight:bold">
                	FORWARD BUDGET TO H.O.D
                </div>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-xs-offset-1 col-md-4" style="margin-top:70px;">
                      <form class="form-group" id="form_hod_bdgt" enctype="multipart/form-data">
                        <input type="file" name="hod_bdgt_doc" value="" class="form-control-static"/>
                        <input type="text" name="hod_bdgt_note" value="" class="form-control" placeholder="Enter Note"/><br/>
                        <input type="text" name="hod_bdgt_date" value="" class="form-control" placeholder="When was this document created" id="date_bdgt"/><br/>
                        <input type="submit" value="Send Document" id="send_hodBdgt" class="btn btn-group" style="background:#003;color:white"/>
                      </form>
                  	</div>
                    <div class="col-xs-offset-1 col-md-6">
                    	<div>SENT BUDGETS</div>
                        <?php
                        // $query=$db->query("SELECT * FROM budget ") or die($db->error);
                        // echo "<table class='table table-responsive'>";
                        // echo "<thead>";
                        // echo "<th> FILE </th>";
                        // echo "<th> NOTE </th>";
                        // echo "<th> DATE SENT </th>";
                        // echo "<th> STATUS </th>";
                        // echo "</thead>";
                        // while($row=$query->fetch_object()){
                        //   $file_name=$row->file_name;
                        //   $note=$row->note;
                        //   $date_sent=$row->date_sent;
                        //   $is_approved=$row->is_approved;
                        //   $complete_filename='documents/budget_hod/'.$file_name;
                        //   echo "<tbody>";
                        //   echo "<td class='col-md-3'> <a href='$complete_filename'>$file_name</a> </td>";
                        //   echo "<td class='col-md-3'> $note </td>";
                        //   echo "<td class='col-md-3'> $date_sent </td>";
                        //   if($is_approved==1) echo "<td class='col-md-3'> APPROVED </td>";
                        //   else echo "<td class='col-md-3'> NOT APPROVED </td>";
                        //   echo "</tbody>";
                        // }
                        // echo "</table>";
                        // $query->free();
                        ?>
                  	</div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper  hod_bdgt-->

        <div id="page-wrapper" class="page fac_bdgt" style="min-height:500px">

            <div class="container-fluid">
				<div class="col-xs-offset-1" style="color:#003;font-size:20px;font-weight:bold">
                	FORWARD BUDGET TO FACULTY FINANCE OFFICE
                </div>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-xs-offset-1 col-md-4" style="margin-top:70px;">
                      <form class="form-group">
                        <input type="file" name="" value="" class="form-control-static"/>
                        <input type="text" name="" value="" class="form-control" placeholder="Enter Note"/><br/>
                        <input type="button" value="Send Document" class="btn btn-group"; style="background:#003;color:white"/>
                      </form>
                  	</div>
                    <div class="col-xs-offset-2 col-md-5">
                  	</div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper  fac_bdgt-->





        <div id="page-wrapper" class="page hod_acc_quer" style="min-height:500px">

            <div class="container-fluid">
				<div class="col-xs-offset-1" style="color:#003;font-size:20px;font-weight:bold">
                	FORWARD ACCOUNT QUERY TO H.O.D
                </div>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-xs-offset-1 col-md-4" style="margin-top:70px;">

                  	</div>
                    <div class="col-xs-offset-1 col-md-6">
                    	<?php //fetch_sentDocument('account','documents/acc_query_hod/');
                      // $query=$db->query("SELECT * FROM account_query ") or die($db->error);
                      // echo "<table class='table table-responsive'>";
                      // echo "<thead>";
                      // echo "<th> FILE </th>";
                      // echo "<th> NOTE </th>";
                      // echo "<th> DATE SENT </th>";
                      // echo "<th> STATUS </th>";
                      // echo "</thead>";
                      // while($row=$query->fetch_object()){
                      //   $file_name=$row->file_name;
                      //   $note=$row->note;
                      //   $date_sent=$row->date_sent;
                      //   $is_approved=$row->is_approved;
                      //   $complete_filename='documents/acc_query_hod/'.$file_name;
                      //   echo "<tbody>";
                      //   echo "<td class='col-md-3'> <a href='$complete_filename'>$file_name</a> </td>";
                      //   echo "<td class='col-md-3'> $note </td>";
                      //   echo "<td class='col-md-3'> $date_sent </td>";
                      //   if($is_approved==1) echo "<td class='col-md-3'> APPROVED </td>";
                      //   else echo "<td class='col-md-3'> NOT APPROVED </td>";
                      //   echo "</tbody>";
                      // }
                      // echo "</table>";
                      // $query->free();
                      ?>
                  	</div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper  hod_acc_quer-->


        <div id="page-wrapper" class="page fac_acc_quer" style="min-height:500px">

            <div class="container-fluid">
				<div class="col-xs-offset-1" style="color:#003;font-size:20px;font-weight:bold">
                	FORWARD ACCOUNT QUERY TO FACULTY FINANCE OFFICE
                </div>
                <!-- Page Heading -->
                <div class="row">

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper  fac_acc_quer-->


        <div id="page-wrapper" class="page pg_acc_quer" style="min-height:500px">

            <div class="container-fluid">
				<div class="col-xs-offset-1" style="color:#003;font-size:20px;font-weight:bold">
                	FORWARD ACCOUNT QUERY TO P.G SCHOOL
                </div>
                <!-- Page Heading -->
                <div class="row">

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper  pg_acc_quer-->

</div>





	<script type="text/javascript" src="../../assets/js/jquery.js"> </script>
    <script type="text/javascript" src="../../assets/js/jquery-ui.js"> </script>
    <script type="text/javascript" src="../../assets/js/bootstrap.min.js"> </script>
    <script src="../../assets/js/plugins/morris/raphael.min.js"></script>
    <script src="../../assets/js/plugins/morris/morris.min.js"></script>
    <script src="../../assets/js/plugins/morris/morris-data.js"></script>
</body>
</html>
