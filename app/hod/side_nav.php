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
                   <li id="hod_budget"  class="<?php if($tag=='budget')echo 'active';?>">
                       <a href="hod_budget.php?category=all" id=""><i class="fa fa-fw fa-save"></i> Budgets</a>
                   </li>
                   <li>

                   <li id="hod_budget"  class="<?php if($tag=='exp_rep')echo 'active';?>">
                       <a href="hod_expense_report.php?category=all" id=""><i class="fa fa-fw fa-send"></i> Expense Reports</a>
                   </li>
                   <li>
                   </li>

                   <li id="hod_budget"  class="<?php if($tag=='stmt_acc')echo 'active';?>">
                       <a href="hod_stmt_acc.php?category=all" id=""><i class="fa fa-fw fa-save"></i> Account Query</a>
                   </li>
                   <li>
                     <li>
                         <a href="#" id="settings"><i class="fa fa-fw fa-anchor"></i> Settings</a>
                     </li>
                     <li>
                         <a href="logout.php"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
                     </li>
                 </ul>

             </div>
            <!-- /.navbar-collapse -->
        </nav>