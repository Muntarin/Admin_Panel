<?php
require_once '../dbconfig.php';


if (isset($_GET['bookdelete'])){

    $id = base64_decode($_GET['bookdelete']);
    mysqli_query($con,"DELETE FROM books WHERE id='$id'");
    header('location:manage-book.php');

}
?>