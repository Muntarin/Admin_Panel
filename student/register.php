<?php
require_once '../dbconfig.php';
session_start();
if (isset($_SESSION['student_login'])){
    header('location:index.php');
}

if (isset($_POST['student_register'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $roll = $_POST['roll'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $reg = $_POST['reg'];

    $input_errors = array();
    if (empty($fname)){
        $input_errors['fname'] = "First name field id required";
    }
    if (empty($lname)){
        $input_errors['lname'] = "Last name field id required";
    }

    if (empty($roll)){
        $input_errors['roll'] = "Roll field id required";
    }

    if (empty($email)){
        $input_errors['email'] = "Email field id required";
    }

    if (empty($username)){
        $input_errors['username'] = "Username field id required";
    }

    if (empty($password)){
        $input_errors['password'] = "Password field id required";
    }

    if (empty($phone)){
        $input_errors['phone'] = "Phone field id required";
    }

    if (empty($reg)){
        $input_errors['reg'] = "Registration No field id required";
    }

    if (count($input_errors)==0){
        $email_check=mysqli_query($con,"SELECT * FROM students WHERE email='$email'");
        $email_check_row = mysqli_num_rows($email_check);

        if ($email_check_row==0) {

            $username_check = mysqli_query($con, "SELECT * FROM students WHERE username='$username'");
            $username_check_row = mysqli_num_rows($username_check);

            if ($username_check_row == 0) {

            } else {
                $username_ex = "This username already exists";
            }
        }
            else {
                $email_ex = "This email already exists";
            }


        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $result=mysqli_query($con,"INSERT INTO `students`( `fname`, `lname`, `roll`, `email`, `username`,`password` ,`status`, `phone`,`reg`) VALUES ('$fname','$lname','$roll','$email','$username','$password_hash','0','$phone','$reg')");
        if ($result){
            $success = "Registration Successfully Done";
        }else{
            $error = "Something Wrong";
        }
    }


}

?>
<!doctype html>
<html lang="en" class="fixed accounts sign-in">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Student Registration</title>

    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/stylesheets/css/style.css">
</head>

<body>
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
            <h1 class="text-center">Student Registration</h1>
            <?php
            if (isset($success)){
                ?>
                <div class="alert alert-success" role="alert">
                    <?= $success ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
            }
            ?>
            <?php
            if (isset($error)){
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            ?>
            <?php
            if (isset($email_ex)){
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $email_ex ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            ?>
            <?php
            if (isset($username_ex)){
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $username_ex ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            ?>


        </div>
        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">
                    <form method="post"  action="<?= $_SERVER['PHP_SELF'] ?> ">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="First Name" name="fname" value="<?= isset($fname) ? $fname: '' ?>"/>
                                <i class="fa fa-user"></i>
                            </span>
                            <?php if (isset( $input_errors['fname'] )){
                                echo  '<span class="input-error">'.$input_errors['fname'] ;
                            } ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="Last Name" name="lname"  value="<?= isset($lname) ? $lname: '' ?>"/>
                                <i class="fa fa-user"></i>
                            </span>
                            <?php if (isset( $input_errors['lname'] )){
                                echo  '<span class="input-error">'.$input_errors['lname'] ;
                            } ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" placeholder="Email" name="email"  value="<?= isset($email) ? $email: '' ?>"/>
                                <i class="fa fa-envelope"></i>
                            </span>
                            <?php if (isset( $input_errors['email'] )){
                                echo  '<span class="input-error">'.$input_errors['email'] ;
                            } ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Username" name="username"  value="<?= isset($username) ? $username: '' ?>"/>
                                <i class="fa fa-envelope"></i>
                            </span>
                            <?php if (isset( $input_errors['username'] )){
                                echo  '<span class="input-error">'.$input_errors['username'] ;
                            } ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="password" class="form-control"  placeholder="Password" name="password"  "/>
                                <i class="fa fa-key"></i>
                            </span>
                            <?php if (isset( $input_errors['password'] )){
                                 echo  '<span class="input-error">'.$input_errors['password'] ;
                            } ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Roll No" name="roll" pattern="[0-9]{6}"  value="<?= isset($roll) ? $roll: '' ?>"/>
                                <i class="fa fa-"></i>
                            </span>
                            <?php if (isset( $input_errors['roll'] )){
                                echo  '<span class="input-error">'.$input_errors['roll'] ;
                            } ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Registration No" name="reg" value="<?= isset($reg) ? $reg:'' ?>"/>
                                <i class="fa fa-envelope"></i>
                            </span>
                            <?php if (isset( $input_errors['reg'] )){
                                echo  '<span class="input-error">'.$input_errors['reg'] ;
                            } ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" placeholder="01*********" name="phone"  value="<?= isset($phone) ? $phone: '' ?>"/>
                                <i class="fa fa-phone"></i>
                            </span>
                            <?php if (isset( $input_errors['phone'] )){
                                echo  '<span class="input-error">'.$input_errors['phone'] ;
                            } ?>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary btn-block" type="submit" name="student_register" value="Register"/>
                        </div>
                        <div class="form-group text-center">
                            Have an account?, <a href="sign-in.php">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="../assets/vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/nano-scroller/nano-scroller.js"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="../assets/javascripts/template-script.min.js"></script>
<script src="../assets/javascripts/template-init.min.js"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
</body>
</html>