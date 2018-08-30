<?php 

//initializing variables
$batch = "";

	$errors = array(); //creating $errors as an array variable.

include '../inc/dbcon.php';
	if (isset($_POST['batch'])) {
		$batch = mysqli_real_escape_string($con, $_POST['batch']);
		//echo 'success';
		//ensure that the form field are filled properly(form validation)...
	if (!empty($batch)) {
			if (!preg_match("/^[0-9]{4}$/", $batch)) {
					array_push($errors, "invalid batch number");
				}
			}
			else{
				array_push($errors, "batch is required here");
			}
			//if there are no errors save to database...
	if (count($errors) == 0) {
			include '../inc/dbcon.php';

		$qry = "SELECT * FROM registration  WHERE batch= '$batch' ";
		$run = mysqli_query($con, $qry);
		if ($run == 'true') {
			
			echo 'success';
			}
			else
				echo 'error';
		
		}

	}
?>