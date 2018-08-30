<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<?php 
				session_start();
				include '../inc/dbcon.php';
				if (isset($_POST['uploadBtn'])) {

					$fileName = $_FILES['exam_result']['name'];
					$fileTempName = $_FILES['exam_result']['tmp_name'];

					if (empty($fileName)) {

						$_SESSION['error'] = "please choose a file first.";
						header('location:bulkregister.php');
						exit();
					}
					//find the extension of file.
					$fileExtension = pathinfo($fileName,PATHINFO_EXTENSION);
					//define allowed extension.
					$allowedExtension = array('csv');
					if (!in_array($fileExtension, $allowedExtension)) {
						
						$_SESSION['error'] = "Invalid file extension.";
						header('location:bulkregister.php');
						exit();
					}else{

						//upload exam result
						$handle = fopen($fileTempName, 'r'); //file in read mode.
						while (($mydata = fgetcsv($handle,1000,',')) !== FALSE) {
							
							$symbol_num = $mydata[0];
							$registration_num = $mydata[1];
							$student_name = $mydata[2];
							$college_name = $mydata[3];
							$email = $mydata[4];
							$batch = $mydata[5];

							$query = "INSERT INTO registration (symbol_num,registration_num,student_name,college_name,email,batch) VALUES ('$symbol_num','$registration_num','$student_name','$college_name','$email','$batch')";
							$run = mysqli_query($con,$query);
						}

						if (!$run) {

							die("error in uploaing file".mysql_error());
						}else{
							
							$_SESSION['success'] = "file uploaded successfully";
							header('location:upload_result.php');
							exit();
						}
					}
				}
			?>
	</div>
</body>
</html>