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
    <form action="databaseUpdate.php" method="post" enctype="multipart/form-data">

        <div class="container border p-3 mt-5">
            <div class="row justify-content-md-center">

                <div class="col-md-6">
                    <h5 class="col-md-6">Adding Columns To Database</h5>
                    <hr>
                    <div class="mb-3 form-group">
                        <label for="exampleFormControlTextarea1" class="form-label">Name of table <span class="text-danger"> e.g cart </span></label>
                        <input class="form-control" type="text" placeholder="table name" name="table" id="">
                    </div>
                    <div class="mb-3 form-group">
                        <label for="exampleFormControlTextarea1" class="form-label">SQL syntax for new columns or column <b>please use '*' to seperate them</b> e.g
                            <pre style="font-family: 'Terminal';" class="text-danger">
    O_Bounce_id VARCHAR(30) NOT NULL*first_Name VARCHAR(30) NOT NULL</pre>
                        </label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="column" placeholder="write sql here" rows="1"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mb-4" name="update">Add Columns</button>
                </div>
            </div>
        </div>
        <hr>
        <div class="container border p-3 mt-5">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                <h5 class="col-md-6">Adding Tables To Database</h5>
                    <hr>
                    <div class="mb-3 form-group">
                        <label for="exampleFormControlTextarea1" class="form-label">SQL syntax for new tables or table <b>please use ';' to seperate them</b>  e.g <pre style="font-family: 'Terminal';" class="text-danger">
        TABLE_NAME(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        first_name VARCHAR(30) NOT NULL,
        last_name VARCHAR(30) NOT NULL ,
        paid VARCHAR(30) NOT NULL DEFAULT 'Sandnes',
        email VARCHAR(70) NOT NULL UNIQUE
    );
    ANOTHER_TABLE(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        first_name VARCHAR(30) NOT NULL,
        last_name VARCHAR(30) NOT NULL ,
        paid VARCHAR(30) NOT NULL DEFAULT 'Sandnes',
        email VARCHAR(70) NOT NULL UNIQUE
    )</pre></label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="tables" placeholder="write sql here" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mb-4" name="CreateTable">Add Tables</button>
                </div>
            </div>
        </div>
    </form>
</body>
<?php
// ALTER TABLE Customer MODIFY Address char(100)


if (isset($_POST['update'])) {
    include 'databases/db.php';

    $table = $_POST['table'];
    $column = $_POST['column'];

    $columnArray =  explode("*", $column);

    foreach ($database as $base) {
        foreach ($columnArray as $key) {
            $addCol = "ALTER TABLE $table ADD $key ";
            mysqli_query($base, $addCol);
        }
    }
}


if (isset($_POST['CreateTable'])) {
    include 'databases/db.php';
    
    $sql  = $_POST['tables'];
    $sqlArray =  explode(";", $sql);

    foreach ($database as $base) {
        foreach ($sqlArray as $key) {
            $keySQL = "CREATE TABLE $key";
            if (mysqli_query($base, $keySQL)) {

                echo "Table created successfully.";
        
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link1);
            }
        }
    }

    


   
}
