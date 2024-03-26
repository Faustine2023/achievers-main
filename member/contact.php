<?php session_start();
      include "dbConn.php";

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

<?php
  //Validating Session
  if(strlen($_SESSION['user_name'])==0)
    { 
  header('location:login.php');
  }
  else{ ?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo  $system_name; ?> | Contact Page</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
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
          <div class="col-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1">
            <div class="login-brand">
           <img style="width: 2em;height:2em;margin-right:.4em;" src=" <?php echo  $system_logo ?>" alt=""><span><?php echo  $system_name ?></span>
            </div>
            <div class="card card-primary">
              <div class="row m-0">
                <div class="col-12 col-md-12 col-lg-5 p-0">
                  <div class="card-header text-center">
                    <h4>Contact Us</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST">
                      <div class="form-group floating-addon">
                       
                      <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" placeholder="Type your message" data-height="150"></textarea>
                      </div>
                      <div class="form-group text-right">
                        <button name="contct-btn" type="submit" class="btn btn-round btn-lg btn-primary">
                          Send Message
                        </button>
                      </div>
                      <div class="simple-footer">
                            Copyright &copy; <?php echo  $system_name ?> 2024
                      </div>
                    </form>
                  </div>
                </div>
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
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyB55Np3_WsZwUQ9NS7DP-HnneleZLYZDNw&amp;sensor=true"></script>
  <script src="assets/bundles/gmaps.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/contact.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>


</body>

</html>
<?php } ?>