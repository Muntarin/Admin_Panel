<?php
require_once '../dbconfig.php';
$result = mysqli_query($con,"SELECT * FROM `students`");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print All Students</title>
    <style type="text/css">
        body{
            margin: 0;
        }
        .print-area{
            width: 755px;
            height: 1050px;
            margin: auto;
            box-sizing: border-box;
            page-break-after: always;
        }
        .header{
            text-align: center;
        }
        .header h3{
            margin: 0;
        }
        .data-info{

        }
        .data-info table{
            width: 100%;
            border-collapse: collapse;
        }
        .data-info th, .data-info td{
            border: 1px solid #555;
            padding: 4px;
            line-height: 1em;
        }
    </style>
</head>
<body onload="window.print()">
<?php
$sl = 1;
$page = 1;
$total = mysqli_num_rows($result);
$par_page = 25;
while ($row = mysqli_fetch_assoc($result)){
    if ($sl % $par_page ==1){
        echo page_header();
    }
    ?>
    <tr>
        <td><?= $sl;?></td>
        <td><?= $row['id']?></td>
        <td><?= $row['fname']?></td>
        <td><?= $row['lname']?></td>
        <td><?= $row['email']?></td>
        <td><?= $row['phone']?></td>
    </tr>
<?php
    if ($sl % $par_page == 0 || $total == $par_page){
        echo page_footer($page++);
    }
    $sl++;

} ?>
</body>
</html>

<?php
function page_header(){
    $data = '
<div class="print-area">
    <div class="header">
        <h3>Library Management System</h3>
        <h3>All Students Info</h3>
    </div>
    <div class="data-info">
    <table>
        <tr>
            <th>SI NO</th>
            <th>Student Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
        </tr>
        ';
    return $data;
}
function page_footer($page){
    $data = '   </table>
        <div class="page-info">Page: '.$page.'</div>
    </div>
</div>';
    return $data;
}

?>