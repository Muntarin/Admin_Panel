<?php

require_once '../dbconfig.php';
$id = base64_decode($_GET['id']);
mysqli_query($con,"UPDATE students SET status = '0' WHERE id ='$id'");
header('location:students.php');
?>


