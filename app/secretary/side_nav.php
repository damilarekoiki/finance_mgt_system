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
                       <a href="sec_budget.php" id=""><i class="fa fa-fw fa-save"></i> Budgets</a>
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
                   <li id="hod_query">
                       <a href="sec_stmt_acc.php" id=""><i class="fa fa-fw fa-save"></i> Account Query</a>
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