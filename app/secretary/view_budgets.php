<?php
  include 'init.php';
  include "auth_user.inc.php";
  $tag="budget";
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
                  VIEW BUDGETS
            </div>
            <!-- Page Heading -->
            <div class="row col-md-12">
            <div class="dropdown col-md-4 col-xs-offset-4 row">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                    SELECT CATEGORY <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right drop">
                    <li><a href="view_budgets.php?category=0">UNAPPROVED BUDGETS</a></li>
                    <li><a href="view_budgets.php?category=1">APPROVED BUDGETS</a></li>
                    <li><a href="view_budgets.php?category=all">ALL BUDGETS</a></li>
                </ul>
            </div>
        </div><!-- /.row -->
            <!-- /.row -->

            <div class="col-md-7">
            <?php
                    if(isset($_GET['category']) && $_GET['category'] != 'all' ){
                        $_SESSION['category']=$_GET['category'];
                    }elseif(isset($_GET['category']) && $_GET['category'] == 'all' ){
                        unset($_SESSION['category']);
                    }
                    if(isset($_SESSION['category'])){
                        $documents->budgets($_SESSION['category']);
                    }else{
                        $documents->budgets();
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
  <script src="../../assets/js/plugins/morris/raphael.min.js"></script>
  <script src="../../assets/js/plugins/morris/morris.min.js"></script>
  <script src="../../assets/js/plugins/morris/morris-data.js"></script>

</body>
</html>
