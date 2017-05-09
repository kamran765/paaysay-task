<?php 
	require_once "vendor/autoload.php"; 
	$auth = new GoogleAuth();

    if ($auth->checkRedirectCode()) {
      header('location: index.php');
      exit();
    }
    if (isset($_REQUEST['logout'])) {
       session_unset();
    }
    if (isset($_POST['task'])) {
    	$task = $_POST['task'];
    	$auth->addTask($task);
    }
    if (isset($_GET['task']) && !empty($_GET['task'])) {
	  $task = $_GET['task'];
	  $auth->deleteTask($task);
	}	
	if (isset($_REQUEST['clearall'])) {
       $auth->deleteAllTasks();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>My Website Title</title>
	
	<!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" href=".ico">

	<!-- CSS Implementing Plugins -->
	<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/plugins/wow/css/animate.min.css">
	<link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css">
	
	<!-- CSS Customization -->
	<link rel="stylesheet" href="assets/css/custom.css">
	<link rel="stylesheet" href="assets/css/dashboard.css">
	<link rel="stylesheet" href="assets/css/loading.css">
</head>
<body>
	<?php 
		require_once "assets/includes/loading.php";
		if (!$auth->isLoggedIn()){
			$authUrl = $auth->getAuthUrl();
			// die($authUrl);
			require_once "assets/includes/login.php";
		}else{
			require_once "assets/includes/dashboard.php";
		}  
	?>
	<!-- CSS Implementing Plugins -->
	<script src="assets/plugins/jquery/jquery-3.1.1.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugins/wow/js/wow.min.js"></script>

	<!-- DataTables -->
	<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>		

	<!-- JS customization --> 
	<script src="assets/js/loading.js"></script>
	<script src="assets/js/dashboard.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
	  $(function () {
	    $("#example1").DataTable();
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
	    });
	  });
	</script>
</body>
</html>