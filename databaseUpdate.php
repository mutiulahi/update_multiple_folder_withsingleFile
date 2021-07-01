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
    <form action="index.php" method="post" enctype="multipart/form-data">

        <div class="container border p-3 mt-5">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="mb-3 form-group">
                        <label for="exampleFormControlTextarea1" class="form-label">Name of table <span class="text-danger"> e.g cart </span></label>
                        <input class="form-control" type="text" placeholder="table name" name="table" id="">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="exampleFormControlTextarea1" class="form-label">SQL syntax for new tables or table <b>please use '*' to seperate them</b> e.g <pre style="font-family: 'Terminal';" class="text-danger"> 
    O_Bounce_id VARCHAR(30) NOT NULL*first_Name VARCHAR(30) NOT NULL</pre></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="column" placeholder="File to Change Location" rows="1"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mb-4" name="update">Update</button>
                </div>
            </div>
        </div>
        <!-- <hr><div class="container border p-3 mt-5">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="mb-3 form-group">
                        <label for="exampleFormControlTextarea1" class="form-label">Name of new column <span class="text-danger"> e.g id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        first_name VARCHAR(30) NOT NULL,
        last_name VARCHAR(30) NOT NULL ,
        paid VARCHAR(30) NOT NULL DEFAULT 'Sandnes',</span></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="column" placeholder="File to Change Location" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mb-4" name="CreateTable">Update</button>
                </div>
            </div>
        </div> -->
    </form>
</body>
<?php
// ALTER TABLE Customer MODIFY Address char(100)
include 'databases/db.php';

if (isset($_POST['update'])) {
    $database = [$link1, $link2];

    $table = $_POST['table'];
    $column = $_POST['column'];
    $columnArray =  explode("*",$column);
    
    foreach ($database as $base) {
        foreach ($columnArray as $key ) {
            // echo $key;
            $addCol = "ALTER TABLE $table ADD $key ";
            mysqli_query($base, $addCol);
        }
        
    }
}

if (isset($_POST['CreateTable'])) {

    $sql = "CREATE TABLE persons(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        first_name VARCHAR(30) NOT NULL,
        last_name VARCHAR(30) NOT NULL ,
        paid VARCHAR(30) NOT NULL DEFAULT 'Sandnes',
        email VARCHAR(70) NOT NULL UNIQUE
    )";
    if(mysqli_query($link1, $sql)){
        echo "Table created successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
}


// $select_table = "show tables";
// $result = mysqli_query($link, $select_table); // run the query and assign the result to $result
// while ($table = mysqli_fetch_array($result)) { // go through each row that was returned in $result
//     echo ('<b>' . $table[0] . "</b><BR>");
//     $select_col =  "SHOW COLUMNS FROM $table[0]";
//     $result_col = mysqli_query($link, $select_col);
//     while ($col = mysqli_fetch_array($result_col)) {
//         echo ($col[0] . "<br>");
//         $colAdd = "ALTER TABLE $table[0] ADD okMe VARCHAR(50) NOT NULL";
//         $addCol =  mysqli_query($link, $colAdd);
//     }
// }
