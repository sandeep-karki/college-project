<?php 

include '../inc/session.php';
include '../inc/template_header.php';
include '../inc/navigation.php';
include 'regprocess.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Register student in bulk</title>
</head>
<body>
	<div class="container">
		<form action="upload_st_process.php" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>Upload to register student</legend>
			<?php 
			include '../inc/alert.php';
			?>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="file" name="exam_result" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="submit" value="upload" name="uploadBtn" class="btn btn-info">
					</div>
				</div>
			</div>
		</fieldset>
		</form>
	</div>

</body>
</html>

<?php 
include '../inc/template_footer.php';
?>