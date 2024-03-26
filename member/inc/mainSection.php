<section class="section">
  <div class="row ">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">My Loans</h5>
                  <h2 class="mb-3 font-18">
                    <?php
                    $loan = mysqli_query($conn, "select * from loans where defaulter_email='$user_email' ");
                    $qrr = mysqli_num_rows($loan);

                    if ($qrr > 0) {
                      echo $qrr;
                    } else {
                      echo 0;
                    }
                    ?>

                    Total Loan History
                  </h2>
                  <p class="mb-0"><span class="col-green">
                      <a name="all-loans" href="all_loans.php?page=view_all_loans for <?php echo $_SESSION['user_name']; ?>">View
                        Loans</a>

                    </span></p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="assets/img/banner/1.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15"> My Savings</h5>
                  <h2 class="mb-3 font-18"> KSH
                    <?php
                    // SQL query to calculate the total savings for the specified email
                    $sql = "SELECT SUM(saveAmmount) AS totalSavings FROM savings WHERE email ='$user_email' ";

                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                      $row = $result->fetch_assoc();
                      $totalSavings = $row['totalSavings'];

                    } else {
                      echo '0';
                    }

                    ?>
                    <?php 
                      if($totalSavings>1){
                          echo $totalSavings;
                      }
                      else{
                          echo '0';
                      }
                  ?>
                  </h2>
                  <p class="mb-0"><span class="col-orange"><a href="savings.php">View Savings</a></span></p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="assets/img/banner/2.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Reports</h5>
                  <h2 class="mb-3 font-18">Your Analytics</h2>
                  <p class="mb-0"><span class="col-green"><a href="loan_report.php">Loans Reports</a><br><a href="savings_report.php">Savings Reports</a></span></p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="assets/img/banner/3.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-md-6 col-lg-12 col-xl-6">
      <!-- Notifications -->
      <div style="max-height: 25em; overflow-y:scroll; " class="card">
        <div class="card-header">
          <h4>Notifications</h4>
          <form class="card-header-form">
            <input type="text" name="search" class="form-control" placeholder="Search">
          </form>
        </div>
        <div class="card-body">
          <div class="support-ticket media pb-1 mb-3">

            <div class="media-body ml-3">
              <?php $query = mysqli_query($conn, "select * from reports where email='$user_email' and status=0 ");
              $count = 1;

              if($query->num_rows < 1) {
                echo '
                <p class="my-1">
                  No Notifications!
                </p>
                ';
              
              }
              while ($resu = mysqli_fetch_array($query)) {
              ?>

                <p class="my-1">
                  <?php echo $resu['message'] ?>
                </p>
                <small class="text-muted">Date: <span class="font-weight-bold font-13">
                    <?php echo $resu['date'] ?>
                  </span>
                  &nbsp;&nbsp; </small>
                <hr>

              <?php $count++;
              } ?>


            </div>
          </div>
        </div>
      </div>
      <!-- Notifications-->
    </div>


    <div class="col-md-6 col-lg-12 col-xl-6">


      <!--Messages -->
      <div  style="max-height: 25em; overflow-y:scroll; " class="card">
        <div class="card-header">
          <h4>Messages</h4>
          <form class="card-header-form">
            <input type="text" name="search" class="form-control" placeholder="Search">
          </form>
        </div>
        <div class="card-body">
          <div class="support-ticket media pb-1 mb-3">

            <div class="media-body ml-3">

              <?php $query = mysqli_query($conn, "select * from notifications where email='$user_email' and status=0 ");
              $count = 1;

              if($query->num_rows < 1) {
                echo '
                <p class="my-1">
                  No Messages!
                </p>
                ';
              
              }
              while ($resu = mysqli_fetch_array($query)) {
              ?>

                <p class="my-1">
                  <?php echo $resu['message'] ?>
                </p>
                <small class="text-muted">Date: <span class="font-weight-bold font-13">
                    <?php echo $resu['date'] ?>
                  </span>
                  &nbsp;&nbsp; </small>
                <hr>

              <?php $count++;
              } ?>


            </div>
          </div>
        </div>
      </div>
      <!-- messages-->



    </div>
        

  </div>
  


</section>