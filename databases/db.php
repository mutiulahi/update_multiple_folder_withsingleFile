<?php
$link1 = mysqli_connect('localhost', 'root', '', 'db_modal');
$link2 = mysqli_connect('localhost', 'root', '', 'confirm');
$database = [$link1, $link2];
