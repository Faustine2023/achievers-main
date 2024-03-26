<?php include "dbConn.php" ?>

<?php
session_start();


$user_email = $_SESSION['mail'];
$user_logo = $_SESSION['logo'];
$user_phone = $_SESSION['phone'];

$query = "select * from system_info";
$res = mysqli_query($conn, $query);

$ret = mysqli_fetch_array($res);
if ($ret > 0) {
  $system_name = $ret['shortName'];
  $system_logo = $ret['logoURL'];
  $system_phone = $ret['phone'];
  $system_address = $ret['address'];
  $system_email = $ret['systemEmail'];
} else {
  echo "<script>alert('Querying system info encountered a problem!');</script>";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
  // Check if the form is submitted
  if (isset($_POST['changeavatar'])) {
    if (!isset($_FILES['image']['tmp_name'])) {
        echo "<script>alert('Sorry, there was an error uploading your file...');</script>";
        echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
    } else {
        $file = $_FILES['image']['tmp_name'];
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $image_name = addslashes($_FILES['image']['name']);

        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/avatars" . $_FILES["image"]["name"]);

        $location = "uploads/avatars" . $_FILES["image"]["name"];

        // Insert file information into the database
        $query = mysqli_query($conn, "UPDATE `members` set avatar=' $image_name' where  email='$currentEmail' ");

        if ($query) {
            echo "<script>alert('Profile photo updated successfully...');</script>";
            echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
        } else {
            echo "<script>alert('Sorry, there was an error updating your picture...');</script>";
        }
        exit();
    }

  }



  if (isset($_POST['changeprofile'])) {

    $fnameChanged = $conn->real_escape_string($_POST['changefname']);
    $lnameChanged = $conn->real_escape_string($_POST['changelname']);
    $emailChanged = $conn->real_escape_string($_POST['changeEmail']);
    $phoneChanged = $conn->real_escape_string($_POST['changephone']);
    $userbio = $conn->real_escape_string($_POST['changebio']);
    $name = $fnameChanged . " " . $lnameChaged;


    $currentEmail = $_SESSION['mail'];

    $query = mysqli_query($conn, "update members set firstname='$fnameChanged',lastname='$lnameChanged',email='$emailChanged',phone='$phoneChanged' where  email='$currentEmail' ");

    if ($query) {
      $_SESSION['mail'] = $emailChanged;
      $_SESSION['user_name'] = $name;
      $_SESSION['phone'] = $phoneChanged;
      $_SESSION['user_bio'] = $userbio;

      echo "<script>alert('Profile details updated successfully...');</script>";
      echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
    } else {
      echo "<script>alert('Failed to update profile details...');</script>";
      echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
    }
  }
}




?>

<?php
  //Validating Session
  if(strlen($_SESSION['user_name'])==0)
    { 
  header('location:login.php');
  }
  else{ ?>

<?php include 'inc/snippet.php'; ?>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>


      <?php include 'inc/topNav.php'; ?>

      <?php include 'inc/sideNav.php'; ?>



      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      <img alt="image" src="<?php echo $_SESSION['logo']; ?>" class="rounded-circle author-box-picture">
                      <div class="clearfix"></div>
                      <div class="author-box-name">
                        <a href="#"><?php echo $_SESSION['user_name']; ?></a>
                      </div>
                      <div class="author-box-job"><?php echo $_SESSION['level']; ?></div>
                    </div>
                    <div class="text-center">
                      <div class="author-box-description">
                        <p>
                          <?php echo $_SESSION['user_bio']; ?>
                        </p>
                      </div>
                      <div class="w-100 d-sm-none"></div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab" aria-selected="true">About</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Setting</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#change_avatar" role="tab" aria-selected="false">Change avatar</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="change_avatar" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Change profile pic</label>
                            <input required type="file" class="form-control" name="file" placeholder="">
                            <div class="err"></div>
                          </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary"><a style="color: white; text-decoration: none" name="changeavatar" href="">Change Profile</a></button>
                        </div>
                      </div>

                      <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="row">
                          <div class="col-md-3 col-6 b-r">
                            <strong>Full Name</strong>
                            <br>
                            <p class="text-muted"><?php echo $_SESSION['user_name']; ?></p>
                          </div>
                          <div class="col-md-3 col-6 b-r">
                            <strong>Mobile</strong>
                            <br>
                            <p class="text-muted"><?php echo $_SESSION['phone']; ?> </p>
                          </div>
                          <div class="col-md-3 col-6 b-r">
                            <strong>Email</strong>
                            <br>
                            <p class="text-muted"><?php echo $_SESSION['mail']; ?> </p>
                          </div>
                        </div>

                      </div>
                      <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">


                        <form method="post" class="needs-validation" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                          <div class="card-header">
                            <h4>Edit Profile</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group col-md-6 col-12">
                                <label>First Name</label>
                                <input required type="text" class="form-control" name="changefname" placeholder="<?php echo $_SESSION['fname']; ?> ">
                                <div class="invalid-feedback">
                                  Please fill in the first name
                                </div>
                              </div>
                              <div class="form-group col-md-6 col-12">
                                <label>Last Name</label>
                                <input required type="text" class="form-control" name="changelname" placeholder="<?php echo $_SESSION['lname']; ?>">
                                <div class="invalid-feedback">
                                  Please fill in the last name
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-7 col-12">
                                <label>Email</label>
                                <input required type="email" class="form-control" name="changeEmail" placeholder="<?php echo $_SESSION['mail']; ?>">
                                <div class="invalid-feedback">
                                  Please fill in the email
                                </div>
                              </div>
                              <div class="form-group col-md-5 col-12">
                                <label>Phone</label>
                                <input required type="tel" class="form-control" name="changephone" placeholder="<?php echo $_SESSION['phone']; ?>">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-12">
                                <label>Bio</label>
                                <textarea required name="changebio" class="form-control summernote-simple">
                                  <?php echo $_SESSION['user_bio']; ?>
                                </textarea>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer text-right">
                            <button name="changeprofile" type="submit" class="btn btn-primary">Save Changes</button>
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


        <?php include 'inc/settings.php'; ?>


      </div>

      <!-- footer section -->
      <?php include 'inc/footer.php'; ?>


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

<?php } ?>