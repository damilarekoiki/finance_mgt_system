<div id="page-wrapper" class="page hod_acc_quer" style="min-height:500px">

    <div class="container-fluid">
<div class="col-xs-offset-1" style="color:#003;font-size:20px;font-weight:bold">
          ACCOUNT QUERY DOCUMENTS
        </div>
        <!-- Page Heading -->
        <div class="row">
            <div class="">
              <?php //fetch_sentDocument('account','documents/acc_query_hod/');
              $query=$db->query("SELECT * FROM account_query ") or die($db->error);
              echo "<table class='table table-responsive'>";
              echo "<thead>";
              echo "<th> FILE </th>";
              echo "<th> NOTE </th>";
              echo "<th> DATE SENT </th>";
              echo "<th> STATUS </th>";
              echo "</thead>";
              while($row=$query->fetch_object()){
                $file_name=$row->file_name;
                $note=$row->note;
                $date_sent=$row->date_sent;
                $is_approved=$row->is_approved;
                $complete_filename='documents/acc_query_hod/'.$file_name;
                echo "<tbody>";
                echo "<td class='col-md-3'> <a href='$complete_filename'>$file_name</a> </td>";
                echo "<td class='col-md-3'> $note </td>";
                echo "<td class='col-md-3'> $date_sent </td>";
                if($is_approved==1) echo "<td class='col-md-3'> APPROVED </td>";
                else echo "<td class='col-md-3'> <input type='checkbox' name='approve'/> CLICK TO APPROVE  </td>";
                echo "</tbody>";
              }
              echo "</table>";
              $query->free();
              ?>
              <input type="button" value="APPROVE SELECTED DOCUMENTS" class="btn btn-group" style="background:#003;color:white;"/>
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
            <div class="col-xs-offset-1 col-md-4" style="margin-top:70px;">
              <form class="form-group" action="index.html" method="post">
                <input type="file" name="" value="" class="form-control-static"/>
                <input type="text" name="" value="" class="form-control" placeholder="Enter Note"/><br/>
                <input type="button" value="Send Document" class="btn btn-group"; style="background:#003;color:white"/>
              </form>
            </div>
            <div class="col-xs-offset-2 col-md-5">
              <pre>
                  SENT BUDGETS
                  q
                    q
                    q
                    q
                    q

                </pre>
            </div>
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
            <div class="col-xs-offset-1 col-md-4" style="margin-top:70px;">
              <form class="form-group" action="index.html" method="post">
                <input type="file" name="" value="" class="form-control-static"/>
                <input type="text" name="" value="" class="form-control" placeholder="Enter Note"/><br/>
                <input type="button" value="Send Document" class="btn btn-group"; style="background:#003;color:white"/>
              </form>
            </div>
            <div class="col-xs-offset-2 col-md-5">
              <pre>
                  SENT BUDGETS
                  q
                    q
                    q
                    q
                    q

                </pre>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper  pg_acc_quer-->
