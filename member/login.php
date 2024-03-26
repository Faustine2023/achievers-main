<?php 
    include "dbConn.php";

    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['log-in-btn'])){
            $email=$conn->real_escape_string($_POST['email']);
            $password=md5($conn->real_escape_string($_POST['password']));

            $return_query=mysqli_query($conn,"select * from members where email='$email' && password='$password'  ");

            $return=mysqli_fetch_array($return_query);

            if($return>0){
                session_start();
                $_SESSION['user_name']=$return['firstname']." ".$return['lastname'];
                $user_email=$return['email'];
                $user_phone=$return['phone'];
                $user_logo=$return['avatar'];
                $_SESSION['mail']=$user_email;
                $_SESSION['phone']=$user_phone;
                $_SESSION['logo']=$user_logo;
                $_SESSION['level']="Member";
                $_SESSION['fname']=$return['firstname'];
                $_SESSION['lname']=$return['lastname'];
                $_SESSION['user_bio']="Commited to change everyday";

                echo "<script type='text/javascript'> document.location = 'index.php?page=homepage'; </script>";

            }
            else{
                echo "<script>alert('Invalid Details..');</script>";          
            }
        }
    }

?>
<?php

session_start();
include "dbConn.php";


$system_address=$system_email=$system_logo=$system_phone=$system_name="";


$query="select * from system_info";
$res=mysqli_query($conn,$query);

$ret=mysqli_fetch_array($res);
  if($ret>0){
    $system_name=$ret['shortName'];
    $system_logo=$ret['logoURL'];
    $system_phone=$ret['phone'];
    $system_address=$ret['address'];
    $system_email=$ret['systemEmail'];
  }
  else{
  echo "<script>alert('Querying system info encountered a problem!');</script>";          
  }

?>


<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Log In | Achievers</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo  $system_logo ?>' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Member Login</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="#" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="forgot_password.php?q=forgotpwd" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="log-in-btn" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </div>
                  </button>
                  <div class="float-right">
                        <a href="http://localhost/achievers-main/?page=main_site" class="text-small">
                          Go to Main Website
                        </a>
                      </div>
                  <!-- <center>
                    <a style="margin-top: 2em; text-decoration:none; " href="http://localhost/achievers-main/">Back to main site</a>
                  </center> -->
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="register.php?action=register&&name=newuser">Create One</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


</html>