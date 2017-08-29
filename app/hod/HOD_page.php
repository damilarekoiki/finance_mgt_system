<?php
  //include 'action/connect.php';
  //include 'action/auth_user.inc.php';
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
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="css/sec.css" type="text/css"/>
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
                   <li id="hod_budget"  class="active">
                       <a href="#" id=""><i class="fa fa-fw fa-save"></i> Budgets</a>
                   </li>
                   <li id="hod_report">
                       <a href="hod_expense_report.php" id=""><i class="fa fa-fw fa-save"></i> Expense Reports</a>
                   </li>
                   <li id="hod_query">
                       <a href="hod_stmt_acc.php" id=""><i class="fa fa-fw fa-save"></i> Account Query</a>
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
                <!-- Page Heading -->
                <div class="row">
                  <div class="col-xs-offset-1" style="color:#003;font-size:20px;font-weight:bold">
                         BUDGET DOCUMENTS
                    </div>
                    <div class="">
                        <form id='bgt_aprv_form'>
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
                        //   $id=$row->id;
                        //   $note=$row->note;
                        //   $date_sent=$row->date_sent;
                        //   $is_approved=$row->is_approved;
                        //   $complete_filename='documents/budget_hod/'.$file_name;
                        //   echo "<tbody>";
                        //   echo "<td class='col-md-3'> <a href='$complete_filename'>$file_name</a> </td>";
                        //   echo "<td class='col-md-3'> $note </td>";
                        //   echo "<td class='col-md-3'> $date_sent </td>";
                        //   if($is_approved==1) echo "<td class='col-md-3'> APPROVED </td>";
                        //   else echo "<td class='col-md-3'> <input type='checkbox' value='$id' name='approve_bdgt[]'/> CLICK TO APPROVE </td>";
                        //   echo "</tbody>";
                        // }
                        // echo "</table>";
                        // $query->free();
                        ?>
                        <input type="button" id='aprv_bdgt_btn' value="APPROVE SELECTED DOCUMENTS" class="btn btn-group" style="background:#003;color:white;"/>
                      </form>
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


</div>





	<script type="text/javascript" src="js/jquery.js"> </script>
    <script type="text/javascript" src="js/jquery-ui.js"> </script>
    <script type="text/javascript" src="js/bootstrap.min.js"> </script>
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

    <script>
		$('#form_hod_bdgt, #form_hod_query, #form_hod_rep').submit(function(e) {
      e.preventDefault();
            forwardDocument($(this));
        });

		function forwardDocument(form){
			if(form.attr('id')=='form_hod_bdgt') action='budget';
			else if(form.attr('id')=='form_hod_query') action='account_query';
			else if(form.attr('id')=='form_hod_rep') action='expense_report';

			$.ajax({
				type:'POST',
				url:"action/forward.php?action="+action,
				data:new FormData(form[0]),
				cache:false,
				processData:false,
				contentType:false,
				success: function(data){
					form.append(data);
				}
			});
		}
	</script>

  <script type="text/javascript">
    $('#aprv_bdgt_btn').click(function functionName() {
      alert('APPROVED');
    //   form=$('#bgt_aprv_form');
    //   id=form.attr('id');
    //   if(id=='bgt_aprv_form') action='budget';
    //   $.ajax({
    //     type:'POST',
    //     data:new FormData(form[0]),
    //     url:'action/approve.php?action='+action,
    //     cache:false,
		// 		processData:false,
		// 		contentType:false,
		// 		success: function(data){
		// 			form.append(data);
		// 		}
    //
    //   })
    //
    });
  </script>
</body>
</html>
