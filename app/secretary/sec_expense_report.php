<?php
  include 'init.php';
  include "auth_user.inc.php";
  $tag="exp_rep";
?>
<?php
  /*
    *
    *
    FORWARDING EXPENSE REPORT
    *
    *
  */
  if(isset($_POST['forward_expense'])){
    // get the secretary id
    $sec_id=$secretary->get_user_id();
    $item_array=$_POST['item'];
    $date_array=$_POST['date'];
    $description_array=$_POST['description'];
    $amount_array=$_POST['amount'];
    define('UNIQ_ID', $secretary->get_uniq_id('expense_report'));// constant id for a particular report
    $total_item=count($item_array);
    $j=0;
    $k=0;
    for($i=0;$i<count($amount_array);$i++){
      $amount=$amount_array[$i];
      $item=$item_array[$j];
      $date=$date_array[$k];
      $description=$description_array[$k];
      $data=array('uniq_id'=>UNIQ_ID,'item'=>$item,'amount'=>$amount,'date'=>$date,'description'=>$description);
      $res=json_decode($secretary->forward_expense_report($data,$sec_id),true);
      $j++;
      if(($i+1)%(count($item_array))==0){
        $k++;
      }//endif
      if(($i+1)%(count($item_array))==0){
        $j=0;
      }
    }//endfor
  }//endif

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
                  FORWARD EXPENSE REPORT TO H.O.D
                </div>
                <!-- Page Heading -->
                <div class="row col-md-12">
                    <div class="" id='tableDiv' style="height:500px;overflow:auto;" class="col-md-12">
                        <button  class="btn btn-primary pull-left expense-left-button" id="addRow"> Add more rows </button> <button  class="btn btn-primary pull-left expense-left-button" id="addCol">Add more columns </button>
                        <form class="form form-group" method="POST" action="sec_expense_report.php">
                        <input type="submit" name="forward_expense"  value="Forward" class="btn btn-success expense-left-button"/>
                        <div style="color:#003;font-size:10px;" class="col-xs-offset-4">drag table by the right to increase size</div>
                            <table id='table' class="col-md-11">
                                <thead>
                                    <tr class="tableRow">
                                        <th><input type="text" value="Date" readonly  class="form-control"></th>
                                        <th><input type="text" value="Description"  readonly class="form-control"></th>
                                        <th><input type="text" value="Seminar" name="item[]" class="form-control"></th>
                                        <th><input type="text" value="Electronics" name="item[]" class="form-control"></th>
                                        <th><input type="text" value="Travel" name="item[]" class="form-control"></th>
                                    </tr>
                                </thead>
                                <tbody id='tableBody'>
                                    <tr class="tableRow">
                                        <td><input type="date" name="date[]" class="form-control"  ></td>
                                        <td><input type="text" name="description[]"  class="form-control"></td>
                                        <td><input type="text" name="amount[]" class="form-control"></td>
                                        <td><input type="text" name="amount[]" class="form-control"></td>
                                        <td><input type="text" name="amount[]" class="form-control"></td>
                                    </tr>
                                    <tr class="tableRow">
                                        <td><input type="date" name="date[]" class="date form-control"  ></td>
                                        <td><input type="text" name="description[]"  class="form-control"></td>
                                        <td><input type="text" name="amount[]" class="form-control"></td>
                                        <td><input type="text" name="amount[]" class="form-control"></td>
                                        <td><input type="text" name="amount[]" class="form-control"></td>
                                    </tr>
                                    <tr class="tableRow">
                                        <td><input type="date" name="date[]" class="date form-control"  ></td>
                                        <td><input type="text" name="description[]"  class="form-control"></td>
                                        <td><input type="text" name="amount[]" class="form-control"></td>
                                        <td><input type="text" name="amount[]" class="form-control"></td>
                                        <td><input type="text" name="amount[]" class="form-control"></td>
                                    </tr>
                                    <tr class="tableRow">
                                        <td><input type="date" name="date[]" class="date form-control"  ></td>
                                        <td><input type="text" name="description[]"  class="form-control"></td>
                                        <td><input type="text" name="amount[]" class="form-control"></td>
                                        <td><input type="text" name="amount[]" class="form-control"></td>
                                        <td><input type="text" name="amount[]" class="form-control"></td>
                                    </tr>
                                    <tr class="tableRow">
                                            <td><input type="date" name="date[]" class="date form-control"  ></td>
                                            <td><input type="text" name="description[]"  class="form-control"></td>
                                            <td><input type="text" name="amount[]" class="form-control"></td>
                                            <td><input type="text" name="amount[]" class="form-control"></td>
                                            <td><input type="text" name="amount[]" class="form-control"></td>
                                        </tr>
                                        <tr class="tableRow">
                                            <td><input type="date" name="date[]" class="lastTD date form-control"  ></td>
                                            <td><input type="text" name="description[]"  class="form-control"></td>
                                            <td><input type="text" name="amount[]" class="form-control"></td>
                                            <td><input type="text" name="amount[]" class="form-control"></td>
                                            <td><input type="text" name="amount[]" class="form-control"></td>
                                        </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>

                </div><!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            
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
        $('#addRow').click(function (params) {
          table_rowsLength=document.getElementById('table').rows.length;
          lastRow=document.getElementById('table').rows[table_rowsLength-1];
          lastRow_allTd=lastRow.getElementsByTagName('td');
          lastRow_allTdLength=lastRow_allTd.length;
          //alert(lastRow_allTd.length);
          row_data="<tr>";
          for(i=0;i<lastRow_allTdLength;i++){
            if(i==0){
              row_data+="<td><input type='date' name='date[]' class='form-control'> </input></td>";
            }
            else if(i==1){
              row_data+="<td><input type='text' name='description[]' class='form-control'> </input></td>";
            }
            else {
              row_data+="<td><input type='text' name='amount[]' class='form-control'> </input></td>";
            }
          }
          row_data+="</tr>";
          // newTR=document.createElement(row_data);
          document.getElementById('tableBody').innerHTML+=row_data;
//             document.getElementById('tableBody').innerHTML+=
// '<tr class="tableRow"> <td><input type="text" name="date[]" class="date form-control"  onclick="dPick(this)"></td><td><input type="text" name="description[]"  class="form-control"></td><td><input type="text" name="amount[]" class="form-control"></td><td><input type="text" name="amount[]" class="form-control"></td><td><input type="text" name="amount[]" class="form-control"></td></tr>';
        })
        $('#addCol').click(function (params) {
            rows=document.getElementById('table').rows;
            rowLength=rows.length;
            for(i=0;i<rowLength;i++){
                if(i==0){
                    rows[i].innerHTML+='<th><input type="text" value="New Item" name="item[]" class="form-control"></th>';
                }
                else{
                    rows[i].innerHTML+='<td><input type="text" name="amount[]" class="form-control"></td>';
                }

            }
        })

    </script>

</body>
</html>
