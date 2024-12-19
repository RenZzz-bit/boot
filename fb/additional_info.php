<head>
	
  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- SweetAlert2 -->
  <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="assets/plugins/dropzone/min/dropzone.min.css">
  <!-- DateTimePicker -->
  <link rel="stylesheet" href="assets/dist/css/jquery.datetimepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Switch Toggle -->
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="assets/plugins/ekko-lightbox/ekko-lightbox.css">
  <link rel="stylesheet" href="assets/plugins/bootstrap4-toggle/css/bootstrap4-toggle.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/images-grid.css">
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/dist/css/styles.css">
  <script src="assets/plugins/jquery/jquery.min.js"></script>

	<script src="assets/dist/js/images-grid.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">

<!-- Ekko Lightbox -->
<script src="assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
  
</head>
<?php 
if( isset($_SESSION['login_status'])){

	// if($_SESSION['login_status']== 2){
	// 	echo "<script> location.replace('index.php?page=setup_profile')</script>";
	// }
}
?>
<div class="col-lg-12">
	<div class="container py-2">
		<div class="col-md-12 d-flex h-100 w-100 align-items-center justify-content-center">
			<div class="card" style="width:50rem">
				<div class="card-header">
					<h5 class="card-title"><b>Additional Information</b></h5>
				</div>
				<div class="card-body">
					<div class="col-md-12">
					<form action="" id="additional-info">
						<input type="hidden" name="id" value="<?php echo $_SESSION['login_id'] ?>">
						<input type="hidden" name="status" value="2">
						<div class="row">
							<div class="form-group col-md-6">
								<label for="">Contact</label>
								<input type="text" name="contact" class="form-control form-control-sm" required="">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="">Address</label>
								<textarea id="" cols="30" rows="4" name="address" class="form-control"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="">Describe Yourself</label>
								<textarea id="" cols="30" rows="4" name="bio" class="form-control"></textarea>
							</div>
						</div>
					</form>
					</div>
				</div>
				<div class="card-footer">
					<div class="d-flex w-100 justify-content-end">
						<button class="btn btn btn-primary align-self-end" form="additional-info">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#additional-info').submit(function(e){
    e.preventDefault();  // Prevent default form submission behavior
    start_load();  // Start loading animation

    // Create a FormData object to handle the file upload and other form data
    var formData = new FormData(this);

    // Log the form data for debugging
    console.log("Form Data: ", formData);

    // Perform AJAX request
    $.ajax({
        url: "ajax.php?action=signup",  // Ensure this URL is correct for handling the signup
        method: "POST",
        data: formData,  // Send form data (including files)
        processData: false,  // Prevent jQuery from processing the data
        contentType: false,  // Let the browser set the content type (for multipart/form-data)
        success: function(resp){
            console.log("Response:", resp);  // Log the response for debugging
            if (resp == 1) {
                // Redirect after successful response
                location.href = 'setup_profile.php';  // Redirect to the setup profile page
            } else {
                // Handle any errors or other responses (optional)
                console.log('Error:', resp);
            }
            end_load();  // End loading animation
        },
        error: function(err) {
            console.log('AJAX Error:', err);  // Log any errors
            end_load();  // End loading animation
        }
    });
});

</script>