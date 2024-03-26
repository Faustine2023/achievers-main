
<?php

  session_start();
  include "dbConn.php";

  $system_address=$system_email=$system_logo=$system_phone=$system_name="";

  $user_email=$_SESSION['mail'];
  $user_logo=$_SESSION['logo'];
  $user_phone=$_SESSION['phone'];

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

<?php include "inc/snippet.php"; ?>
<body>
<div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <?php include 'inc/topNav.php'; ?>

      <?php include 'inc/sideNav.php';?>
             


      <!-- Main Content -->
      <div class="main-content">

        <?php include 'inc/mainSection.php'; ?>

        <?php include 'inc/settings.php'; ?> 

      </div>


      <!-- footer section -->      
      <?php include 'inc/footer.php';?> 

    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


</html>
<?php } ?>