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
	<form action="file.php" method="post" enctype="multipart/form-data">

		<div class="container border p-3 mt-5">
			<div class="row justify-content-md-center">
				<span class="text-center mb-5 ">Please enter the correct location <br> if location is out of the current folder use <b>../ plus the location</b> </span>
				<div class="col-md-6">
					<div class="mb-3 form-group">
						<label for="exampleFormControlTextarea1" class="form-label">File to Change Location <span class="text-danger" >e.g book.com/file.php*andela.com/file.php*... <br> use<b> *</b> to seperate the locations</span></label>
						<textarea class="form-control" id="exampleFormControlTextarea1" name="location" placeholder="File to Change Location" rows="1"></textarea>
					</div>
					<div class="mb-3 form-group">
						<label for="exampleFormControlTextarea1" class="form-label">Folder to Change location <span class="text-danger" >e.g book.com*andela.com*...<br> use<b> *</b> to seperate the locations</span></label>
						<textarea class="form-control" id="exampleFormControlTextarea1" name="folder" placeholder="File to Change Location" rows="1"></textarea>
					</div>
					<div class="mb-3">
						<label for="formFile" class="form-label">Upload New File</label>
						<input class="form-control" name="file" type="file" id="formFile">
					</div>
					<button type="submit" class="btn btn-primary" name="update">Update</button>
				</div>
			</div>
		</div>
		<!-- <input type="text" name="location" id="" placeholder="file location">
		<input type="text" name="folder" id="" placeholder="folder location">
		<input type="file" name="file" id=""> -->

	</form>
</body>

</html>
<?php

if (isset($_POST['update'])) {
	$from = $_POST['location'];
	$targetDir = $_POST['folder'];

	$fileName = basename($_FILES["file"]["name"]);


	$arr = explode("*", $from);
	$folder = explode("*", $targetDir);
	$folderSize = sizeof($folder);
	// echo $folderSize;


	foreach ($arr as $path_to_file) {

		if (file_exists($path_to_file)) {
			unlink($path_to_file);
			echo 'The file ' . $path_to_file . ' successfully deleted<br>';

			for ($i = 1; $i < $folderSize; $i++) {
				$targetFilePath1 = $folder[0] . '/' . $fileName;
				$targetFilePath = $folder[$i] . '/' . $fileName;
				// $targetFilePath =
				// echo $targetFilePath . '<br>';
				move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath1);
				copy($targetFilePath1,  $folder[$i] . '/' . $fileName);
			}
		} else {
			echo '<span style="text-align:center;"> The file ' . $path_to_file . ' does not exist</span><br>';
		}
	}
}

// $path_to_file = 'vendor/composer/installed.php';
