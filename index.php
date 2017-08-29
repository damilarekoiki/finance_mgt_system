<!doctype html>
<html>
  <head>
  <meta charset="utf-8">
  <title>Untitled Document</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
  <link rel="stylesheet" href="assets/css/index.css" type="text/css"/>
  <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css"/>
  <link rel="stylesheet" href="assets/css/owl.theme.css" type="text/css"/>
  </head>

  <body>
  <div id="hodContainer">
  </div>
  <div id='hodDiv'>
        <span class="" style="font-color:#238;font-weight:bold;margin-left:30%;color:white">Login As H.O.D</span>
        <form class="form form-group" id='hodForm'>
          <input type="text" name="hod_user" id="hod_user" value="" class="form-control" placeholder="Enter Username"/>
          <input type="password" name="hod_pass" id="hod_pass" value=""  class="form-control" placeholder="Enter Password"/>
          <input type="button" value="Submit" class="btn btn-group" style="height:auto" id="hod_login"/>
        </form>
     </div>

      <div id="secContainer">
      </div>
      <div id='secDiv'>
            <span class="" style="font-color:#238;font-weight:bold;margin-left:30%;color:white">Login As Secretary</span>
            <form class="" action="" method=" " id='secForm'>
              <input type="text" name="sec_user" id='sec_user' value="" class="form-control" placeholder="Enter Username"/>
              <input type="password" name="sec_pass" id='sec_pass' value=""  class="form-control" placeholder="Enter Password"/>
              <input type="button" value="Submit" class="btn btn-group" style="height:auto" id="sec_login"/>
            </form>
      </div>

    <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="background:#003;z-index:0;">
    	<div class="container-fluid">
    		<a href="index.php" class="navbar-brand"> computer science UI - FINACE MANAGEMENT SYSTEM </a>
        	<div class="navbar-header">
            	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-menu-navbar-collapse-1">
                    <span class="sr-only"> Toggle </span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
            	</button>
          	</div>

          	<div class="collapse navbar-collapse navbar-right" id="bs-menu-navbar-collapse-1">
              <ul class="nav navbar-nav">
                  <li><a href="index.php">Home</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Login <b class="claret"></b></a>
                    <ul class="dropdown-menu">
                      <li id='hodLink'>H.O.D Login</li>
                      <li class="divider"></li>
                      <li id='secLink'>Secretary Login</li>
                    </ul>
                  </li>
                  <li><a href="#">About Us</a></li>
                  <li class="last"><a href="#">Contact US</a></li>
              </ul>
         	</div>
        </div> <!--end container-->
      </nav><!-- end header -->

      <div class="page-header owl-carousel" id="banner" style="margin-top:70px">
        <div> <img src="assets/images/image_1.jpg" class="img-responsive"/>  </div>
        <div> <img src="assets/images/image_2.jpg" class="img-responsive"/>  </div>
        <div> <img src="assets/images/image_3.jpg" class="img-responsive"/>  </div>
        <div> <img src="assets/images/image_4.jpg" class="img-responsive"/>  </div>
        <div> <img src="assets/images/image_12.jpg" class="img-responsive"/>  </div>
        <div> <img src="assets/images/image_5.jpg" class="img-responsive"/>  </div>
        <div> <img src="assets/images/image_6.jpg" class="img-responsive"/>  </div>
        <div> <img src="assets/images/image_7.jpg" class="img-responsive"/>  </div>
        <div> <img src="assets/images/image_8.jpg" class="img-responsive"/>  </div>
        <div> <img src="assets/images/image_9.jpg" class="img-responsive"/>  </div>
        <div> <img src="assets/images/image_10.jpg" class="img-responsive"/>  </div>
        <div> <img src="assets/images/image_11.jpg" class="img-responsive"/>  </div>
      </div>

      <div class="jumbotron" style="height:250px;">
        <div class="container">
            <img src="assets/images/jumbotron_img.jpg" height="200px" class="pull-left"/>
            <h2 style="margin:5px;font-weight:bold"> CSC-UI FINANCE MANAGEMENT SYSTEM</h2>
            <p style="margin:5px;">
            This platform is to help the department manage their finances.
            This platform provides modules that handle budgetting, expense report, and statement of account query.
            <p>If you are an admin click on the menu in the menu bar and login as an admin</p>
            </p>
            <p> <a class="btn btn-primary btn-lg" role="button"> Learn More </a></p>
        </div>
    </div>

	<script type="text/javascript" src="assets/js/jquery-3.2.1.js"> </script>
    <script type="text/javascript" src="assets/js/jquery-ui.js"> </script>
    <script type="text/javascript" src="assets/js/index.js"> </script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"> </script>
    <script src="assets/js/owl.carousel.js" type="text/javascript"> </script>
    <script>
		$(document).ready(function(e) {
            $("#banner").owlCarousel({
			  navigation : true, // Show next and prev buttons
			  slideSpeed : 300,
			  paginationSpeed : 800,
			  autoPlay:true
			});
        });

		$('#hod_login').click(function(e) {
      form=$('#hodForm');

      user=$("#hod_user").val();
      pass=$("#hod_pass").val();
      data={
        'hod_user':user,
        'hod_pass':pass
      };
			$.ajax({
        type:'POST',
				url:'app/hod/login.php',
				data:data,
        dataType:'json',
        statusCode:{
          404:function(){
            alert("page not found");
          }
        },
        beforeSend: function(){
					$('#hodDiv .loader').fadeOut(0);
					$('#hodDiv').append("<img src='images/load.gif' height='20' width='20' class='loader img-responsive'/>");
				},
				complete: function(){
					$('#hodDiv .loader').fadeOut(0);
				},
    }).done(function(data) {
      if(data['status']==1){
        alert(data['message']);
        window.location='app/hod/HOD_page.php';
      }
        else alert(data['message']);

    });
  });

		$('#sec_login').click(function(e) {
            form=$('#secForm');
            user=$("#sec_user").val();
            pass=$("#sec_pass").val();
            data={
              'sec_user':user,
              'sec_pass':pass

            }
            //data=form.serialize()+data;

			$.ajax({
        type:'POST',
				url:'app/secretary/login.php',
				data:data,
        dataType:'json',
        //     cache: false,
        //     processData:false,
        statusCode:{
          404:function(){
            alert("page not found");
          }
        },
				beforeSend: function(){
					$('#secDiv .loader').fadeOut(0);
					$('#secDiv').append("<img src='images/load.gif' height='20' width='20' class='loader img-responsive'/>");
				},
				complete: function(){
					$('#secDiv .loader').fadeOut(0);

				}
    }).done(function(data) {
      if(data['status']==1){
        alert(data['message']);
        window.location='app/secretary/sec_budget.php';
      }
      else{
        alert(data['message']);
      }

    }) ;
        });
	</script>
</body>
</html>
