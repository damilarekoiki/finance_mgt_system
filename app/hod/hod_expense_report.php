<?php
  include 'init.php';
  include "auth_user.inc.php";
  $tag="exp_rep";
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

        <!-- Navigation -->
        <?php
            include "side_nav.php";
        ?>

        <div id="page-wrapper" class="page hod_bdgt" style="min-height:500px">

            <div class="container-fluid">
                <div class="col-xs-offset-1" style="color:#003;font-size:20px;font-weight:bold">
                        ALL EXPENSE REPORTS
                </div>
                <!-- Page Heading -->

                <div class="row col-md-12">
                    <div class="dropdown col-md-4 col-xs-offset-4 row">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            SELECT CATEGORY <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right drop">
                            <li><a href="hod_expense_report.php?category=0">UNAPPROVED BUDGETS</a></li>
                            <li><a href="hod_expense_report.php?category=1">APPROVED BUDGETS</a></li>
                            <li><a href="hod_expense_report.php?category=all">ALL BUDGETS</a></li>
                        </ul>
                    </div>
                </div><!-- /.row -->

                <div class="col-md-7 doc-table">
                    <?php
                        // approve or reverse approval depending on the button clicked
                        $hod->approve_or_disapprove("expense_report",array('set_col'=>'is_approved','where_col'=>'uniq_id'));
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                        <?php
                                if(isset($_GET['category']) && $_GET['category'] != 'all' ){
                                    $_SESSION['category']=$_GET['category'];
                                }elseif(isset($_GET['category']) && $_GET['category'] == 'all' ){
                                    unset($_SESSION['category']);
                                }
                                if(isset($_SESSION['category'])){
                                    $documents->expense_reports($_SESSION['category']);
                                }else{
                                    $documents->expense_reports();
                                }
                            ?>
                    </form>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper  hod_bdgt-->



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
    </script>
    
</body>
</html>
