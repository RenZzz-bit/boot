<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');

?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link rel="stylesheet" type="text/css" href="assets/dist/css/hp.css">
    <!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap ICON -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
   
  <title>Login | Kaagapay</title>
 	

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    position: absolute;
	    top:0;
	    left: 0
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%) !important;
		display: flex;
	}
	.navbar  {
		background-image: url('assets/uploads/bg1.png');
        }


</style>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary"> <!-- Added bg-primary for navbar background color -->
    <div class="container-fluid">
      <!-- Title on the left side -->
      <a class="navbar-brand text-white" href="#">
        <h3 class="mb-0">K A A G A P A Y</h3> <!-- Title placed here -->
      </a>
      
      <!-- Logo section (if needed) 
      <a class="navbar-brand text-white" href="#">
        <img src="assets/uploads/logohp.png" alt="Logo" style="max-width: 40px;">  Example logo 
      </a> -->
      
      <!-- Navbar links -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../about.html">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../hotline.html">Hotlines</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="../index.php#news">News</a>
        </li>
        <!-- Optional login links -->
        <!-- <li class="nav-item">
          <a class="nav-link text-white" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="adminlogin.php">Admin</a>
        </li> -->
      </ul>
    </div>
  </nav>
</body>



<main id="main" class="d-flex justify-content-center align-items-center vh-100" style="background-image: url('assets/uploads/bgg.png'); background-size: cover; background-position: center;">
  <div id="login-center" class="row justify-content-center align-self-center w-50">
    <div class="card col-sm-7">
      <div class="card-body">
        <!-- Logo Section -->
        <div class="text-center mb-4">
          <img src="assets/uploads/logohp.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
        </div>
        <!-- Login Form -->
        <form id="login-form">
          <div class="form-group">
            <input type="text" id="email" name="email" class="form-control" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
          </div>
          <center>
            <button class="btn btn-block btn-wave" style="background-color: #FF5733; color: white;">Login</button>
          </center>
          <hr>
          <center>
            <button class="btn btn-block btn-wave custom-bg-color" type="button" id="new_account" style="background-color: #cb4f35; color: white;">Create New Account</button>
          </center>
        </form>
      </div>
    </div>
  </div>
</main>



  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
         <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><b>&times;</b></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
</body>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- PAGE assets/plugins -->
<!-- jQuery Mapael -->
<script src="assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="assets/plugins/raphael/raphael.min.js"></script>
<script src="assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard2.js"></script>
<!-- DataTables  & Plugins -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
	 window.start_load = function(){
	    $('body').prepend('<div id="preloader2"></div>')
	  }
	  window.end_load = function(){
	    $('#preloader2').fadeOut('fast', function() {
	        $(this).remove();
	      })
	  }
	 window.viewer_modal = function($src = ''){
	    start_load()
	    var t = $src.split('.')
	    t = t[1]
	    if(t =='mp4'){
	      var view = $("<video src='"+$src+"' controls autoplay></video>")
	    }else{
	      var view = $("<img src='"+$src+"' />")
	    }
	    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
	    $('#viewer_modal .modal-content').append(view)
	    $('#viewer_modal').modal({
	            show:true,
	            backdrop:'static',
	            keyboard:false,
	            focus:true
	          })
	          end_load()  

	}
	  window.uni_modal = function($title = '' , $url='',$size=""){
	      start_load()
	      $.ajax({
	          url:$url,
	          error:err=>{
	              console.log()
	              alert("An error occured")
	          },
	          success:function(resp){
	              if(resp){
	                  $('#uni_modal .modal-title').html($title)
	                  $('#uni_modal .modal-body').html(resp)
	                  if($size != ''){
	                      $('#uni_modal .modal-dialog').addClass($size)
	                  }else{
	                      $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
	                  }
	                  $('#uni_modal').modal({
	                    show:true,
	                    backdrop:'static',
	                    keyboard:false,
	                    focus:true
	                  })
	                  end_load()
	              }
	          }
	      })
	  }
	  window._conf = function($msg='',$func='',$params = []){
	     $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
	     $('#confirm_modal .modal-body').html($msg)
	     $('#confirm_modal').modal('show')
	  }
	   window.alert_toast= function($msg = 'TEST',$bg = 'success' ,$pos=''){
	   	 var Toast = Swal.mixin({
	      toast: true,
	      position: $pos || 'top-end',
	      showConfirmButton: false,
	      timer: 5000
	    });
	      Toast.fire({
	        icon: $bg,
	        title: $msg
	      })
	  }
	$('#new_account').click(function(){
		uni_modal("<h4>Sign Up</h4><span><h6 class='text-muted'>It’s quick and easy.</h6></span>","signup.php")
	})
  
	
  $('#login-form').submit(function(e) { 
    e.preventDefault();
    start_load();  // Start loading animation

    if($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();

    $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        error: function(err) {
            console.log(err);
            end_load();  // End loading animation
        },
        success: function(resp) {
            end_load();  // End loading animation
            if (resp == 1) {
                location.href = 'additional_info.php';  // Redirect if login is successful
            } else if (resp == 2) {
                $('#login-form').prepend('<div class="alert alert-danger">Your account is not verified. Please check your email.</div>');
            } else if (resp == 3) {
                $('#login-form').prepend('<div class="alert alert-danger">Incorrect password. Please try again.</div>');
            } else if (resp == 4) {
                $('#login-form').prepend('<div class="alert alert-danger">Email not found. Please check your email.</div>');
            } else {
                $('#login-form').prepend('<div class="alert alert-danger">An error occurred. Please try again later.</div>');
            }
        }
    });
});



	$('.number').on('input keyup keypress',function(){
        var val = $(this).val()
        val = val.replace(/[^0-9 \,]/, '');
        val = val.toLocaleString('en-US')
        $(this).val(val)
    })
</script>	
</html>