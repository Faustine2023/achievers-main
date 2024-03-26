<?php 
  include "dbConn.php";

  session_start();

  if(isset($_SESSION['user_name'])){
    session_destroy();

  }


  $error="";

  if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['log-in-btn'])){
      $email=$conn->real_escape_string($_POST['email']);
      $password=$conn->real_escape_string($_POST['password']);

      // Validate password strength
      $uppercase = preg_match('@[A-Z]@', $password);
      $lowercase = preg_match('@[a-z]@', $password);
      $number    = preg_match('@[0-9]@', $password);
      $specialChars = preg_match('@[^\w]@', $password);

      if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
          $error='Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
      }else{
        $newpassword=md5($password);
        $sql =mysqli_query($conn,"SELECT * FROM members WHERE email='$email' ");
        $rowcount=mysqli_num_rows($sql);
        
        if($rowcount>0){

          $query=mysqli_query($conn,"update members set password='$newpassword' where email='$email' ");
          if($query){
            echo "<script>alert('Your Password was succesfully changed');</script>";
            session_destroy();
            echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
          }
        }
        else {
          echo "<script>alert('Email is invalid');</script>"; 
        }
            

      }
    }
  }

?>

<?php

  
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
  <title>Password Reset | Achievers</title>
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
                <h4>Forgot Password </h4>
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
                      <label for="password" class="control-label">New Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                    <div>
                        <p style="color: red; font-size:.8em;"><?php echo $error; ?></p>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <label class="custom-control-label" for="remember-me">Enter your email to reset your password</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="log-in-btn" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login Now
                    </button>
                  </div>
                </form>
              </div>
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