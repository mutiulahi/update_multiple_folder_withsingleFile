<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<title>Update multiple folder</title>
</head>

<body>
	<form action="updateFiles.php" method="post" enctype="multipart/form-data">

		<div class="container border p-3 mt-5">
			<div class="row justify-content-md-center">
				<div class="col-md-6">
					<div class="mb-3 form-group">
						<label for="exampleFormControlTextarea1" class="form-label">Enter path to the file <span class="text-danger"> e.g admin/css</span></label>
						<textarea class="form-control" id="exampleFormControlTextarea1" name="location" placeholder="File to Change Location" rows="1"></textarea>
					</div>
					<div class="mb-3">
						<label for="formFile" class="form-label">Upload New File</label>
						<input class="form-control" name="file[]" type="file" id="formFile" multiple="multiple">
					</div>
					<button type="submit" class="btn btn-primary mb-4" name="update">Update</button>
				</div>
			</div>
			<?php

			if (isset($_POST['update'])) {
				// $fileName = basename($_FILES["file"]["name"]);
				$location = $_POST['location'];

				$directories = glob('../*', GLOB_ONLYDIR);

				$P = $_FILES['file']['name'];
				// echo sizeof($P);
				// $INFILE = implode($p);


				for ($i = 0; $i < sizeof($directories); $i++) {
					// echo ($i) . '<br>';

					for ($f = 0; $f < sizeof($P); $f++) {
						// echo $directories[$i].'/'.$location.'/'.$_FILES['file']['name'][$f].'<br>';
						if (file_exists($directories[$i] . '/' . $location . '/' . $_FILES['file']['name'][$f])) {

							// unlink($directories[$i].'/'.$location.'/'.$_FILES['file']['name'][$f]);

							move_uploaded_file($_FILES['file']['tmp_name'][$f], $directories[0] . '/' . $location . '/' . $_FILES['file']['name'][$f]);
							copy($directories[0] . '/' . $location . '/' . $_FILES['file']['name'][$f], $directories[$i] . '/' . $location . '/' . $_FILES['file']['name'][$f]);
							
							echo '<div class="alert alert-success alert-dismissible fade show col-md-6 justify-content-md-center" style="margin-left:25%;" role="alert">
							<strong>'.$_FILES['file']['name'][$f].' Exist in '.$directories[$i] . '/' . $location.'</strong> And has been updated.
							
						  </div>';
						} else {
							move_uploaded_file($_FILES['file']['tmp_name'][$f], $directories[0] . '/' . $location . '/' . $_FILES['file']['name'][$f]);
							copy($directories[0] . '/' . $location . '/' . $_FILES['file']['name'][$f], $directories[$i] . '/' . $location . '/' . $_FILES['file']['name'][$f]);
							echo '<div class="alert alert-warning alert-dismissible fade show col-md-6 justify-content-md-center" style="margin-left:25%;" role="alert">
							<strong>'.$_FILES['file']['name'][$f].' do not exist in '.$directories[$i] . '/' . $location.'</strong> And has been updated.
							
						  </div>';
	
						}
					}
				}
			}
			?>

		</div>

	</form>
</body>

</html>