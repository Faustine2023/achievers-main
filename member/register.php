<?php 
    include "dbConn.php";
    $error=$passerror="";

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

    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['register-btn'])){
            $fname=$conn->real_escape_string($_POST['first_name']);
            $lname=$conn->real_escape_string($_POST['last_name']);
            $email=$conn->real_escape_string($_POST['email']);
            $phone=$conn->real_escape_string($_POST['phone']);
            $password=$conn->real_escape_string($_POST['password']);

            // Validate password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);

            if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
                $error='Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
            }
            else{

                // check email existance
                $qr=mysqli_query($conn,"select * from members where email='$email'");
                $rowcount=mysqli_num_rows($qr);

                if($rowcount>0){
                    echo "<script>alert('Menmber exists with the given email!');</script>";
                    echo "<script type='text/javascript'> document.location = 'register.php'; </script>";
                }
                else{
                    $newpassword=md5($password);
    
                    $squery=mysqli_query($conn,
                    "insert into members(firstname,lastname,email,phone,password)
                    values('$fname','$lname','$email','$phone','$newpassword')");
    
                    if($squery){
                        echo "<script>alert('Registration succesful. Wait for approving by admin team so as to log in..');</script>";
                        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
                    } 
                    else {
                        echo "<script>alert('Something went wrong. Please try again.');</script>";
                    }
                    

                }


            }
            
        }
    }


?>



<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register | Achievers</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">
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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Register</h4>
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="frist_name">First Name</label>
                      <input id="first_name" type="text" class="form-control" name="first_name" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">Last Name</label>
                      <input id="last_name" type="text" class="form-control" required name="last_name">
                    </div>
                    <div class="form-group col-6">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control" required name="email">
                      <div class="invalid-feedback">
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="email">Phone Number</label>
                      <input id="email" type="tel" required class="form-control" name="phone">
                      <div class="invalid-feedback">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" name="password" type="password" required class="form-control pwstrength" data-indicator="pwindicator"
                        name="password">
                        <div>
                        <p style="color: red; font-size:.8em;"><?php echo $error;?></p>
                      </div>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="register-btn" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
              <div class="mb-4 text-muted text-center">
                Already a Member? <a href="login.php">Login</a>
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
  <script src="assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/auth-register.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


</html>