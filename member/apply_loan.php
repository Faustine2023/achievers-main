<?php

session_start();
include "dbConn.php";


$system_address = $system_email = $system_logo = $system_phone = $system_name = "";

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

?>

<?php
//Validating Session
if (strlen($_SESSION['user_name']) == 0) {
    header('location:login.php');
} else { ?>

    <!DOCTYPE html>
    <html lang="en">



    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title><?php echo  $system_name; ?> | <?php echo $_SESSION['user_name']; ?> Loan Application</title>
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
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>

                <?php include 'inc/topNav.php'; ?>

                <?php include 'inc/sideNav.php'; ?>

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-body">


                            <div class="row">
                                <div class="col-xl-8 col-md-12 col-lg-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Loan Application</h4>
                                        </div>
                                        <div class="card-body">
                                            <form id="wizard_with_validation" method="POST">
                                                <h3>Limit</h3>
                                                <fieldset>
                                                    <div class="card card-primary">
                                                        <div class="card-header">
                                                            <h4>Qualification limit</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <b>Hello! <?php echo $_SESSION['user_name']; ?> <br>
                                                                <p>
                                                            </b>


                                                            <?php
                                                            $query = mysqli_query($conn, "select * from loans where defaulter_email='$user_email' and status='Pending' ");
                                                            $qr = mysqli_num_rows($query);
                                                            if ($qr > 0) {
                                                                echo '<p>You do not qualify for a loan You Have a pending loan!! <br> <a href="pending_loans.php?id=98765?=pendingloans">Go to Pending Loans</a> </b> </p>
                                                                ';
                                                            } else {
                                                                // SQL query to calculate the total savings for the specified email
                                                                $sql = "SELECT SUM(saveAmmount) AS totalSavings FROM savings WHERE email ='$user_email' ";

                                                                $result = mysqli_query($conn, $sql);

                                                                if ($result->num_rows > 0) {
                                                                    $row = $result->fetch_assoc();
                                                                    $totalSavings = $row['totalSavings'];
                                                                } else {
                                                                    $totalSavings = 0;
                                                                }


                                                                $loan = mysqli_query($conn, "select * from loans where defaulter_email='$user_email' and status='Paid' ");
                                                                $qrr = mysqli_num_rows($loan);
                                                                $timestamp = time();
                                                                $currentDate = gmdate('Y-m-d', $timestamp);
                                                                $loanCount = 0;

                                                                if ($qrr > 0) {
                                                                    $count = 1;

                                                                    while ($resu = mysqli_fetch_array($loan)) {
                                                                        $loanCount += $resu['loanAmmount'];
                                                            ?>

                                                            <?php $count++;
                                                                    }
                                                                }

                                                                $loanLimit = (1.2 * $totalSavings) + (0.02 * $loanCount);

                                                                if($loanLimit>1){
                                                                    echo '
                                                                            <p>You qualify for a loan of upto <b> Ksh.' . $loanLimit . ' </b> </p>
    
                                                                        ';

                                                                }
                                                                else{
                                                                    echo '
                                                                            <p>You currently do not qualify for a loan. Save more and participate in contributions to grow your limit.</b> </p>
    
                                                                        ';

                                                                }

                                                            }

                                                            ?>






                                                            Once you have a limit, you can apply for a loan from Ksh. 1,000 and the payback period is as stated: <br>
                                                            <br>
                                                            <table class="table table-striped table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Ammount (Ksh.)</th>
                                                                        <th>PayBack Period</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1,000 - 5,000</td>
                                                                        <td>1 Month</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>5,001 - 10,000</td>
                                                                        <td>2 Months</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Above 10,000</td>
                                                                        <td>3 Months</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <b><i>The limit is automatically calculated and generated by the system after querying your loan and savings
                                                                    information.</i></b>
                                                            </p>

                                                        </div>
                                                    </div>

                                                </fieldset>
                                                <h3>Application</h3>
                                                <fieldset>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <label class="form-label">First Name*</label>
                                                            <input type="text" name="name" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <label class="form-label">Last Name*</label>
                                                            <input type="text" name="surname" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <label class="form-label">Email*</label>
                                                            <input type="email" name="email" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <label class="form-label">Address*</label>
                                                            <textarea name="address" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <label class="form-label">Age*</label>
                                                            <input min="18" type="number" name="age" class="form-control" required>
                                                        </div>
                                                        <div class="help-info">The warning step will show up if age is less than 18</div>
                                                    </div>
                                                </fieldset>
                                                <h3>Terms &amp; Conditions</h3>
                                                <fieldset>
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4>Show/Hide</h4>
                                                            <div class="card-header-action">
                                                                <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="collapse show" id="mycard-collapse">
                                                            <div class="card-body">
                                                                <p>
                                                                <ol>
                                                                    <li>Loans are only payable to the treasurer or the chairman. <i>Paying off loans to members or other stakeholders will not be accounted for! </i></li>
                                                                    <li>Once you exceed the payback period, loan rates will change as specified by the system.</li>
                                                                    <li>Ensure that the loan information is well updated in the system by the administrators to ensure transparency.</li>
                                                                    <li>Breach of <b><em>terms of conduct</em></b> wii lead to loan disqualification or even impeachment from the group.</li>
                                                                </ol>
                                                                </p>
                                                            </div>
                                                            <div class="card-footer">
                                                                <?php echo  $system_name; ?> T $ C
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                                                    <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                                                </fieldset>
                                            </form>
                                        </div>



                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-12 col-lg-4">
                                    <div class="card l-bg-orange">
                                        <div class="card-header">
                                            <h5>Loans Analytics</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-white">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-10">
                                                        <?php
                                                        $loan = mysqli_query($conn, "select * from loans where defaulter_email='$user_email' and status='Paid' ");
                                                        $qrr = mysqli_num_rows($loan);
                                                        $timestamp = time();
                                                        $currentDate = gmdate('Y-m-d', $timestamp);

                                                        if ($qrr > 0) {
                                                            $count = 1;
                                                            $loanCount = 0;

                                                            while ($resu = mysqli_fetch_array($loan)) {
                                                                $loanCount += $resu['loanAmmount'];
                                                        ?>



                                                        <?php $count++;
                                                            }




                                                            echo '
                                                          <h6 class="mb-0 font-26">Ksh ' . $loanCount . '</h6>
                                                          <p class="mb-2">Your total Loans Paid as on date<br> ' . $currentDate . '</p>
                                                         
                                                          ';
                                                        } else {
                                                            echo '
                                                        <h6 class="mb-0 font-26">Ksh. 0</h6>
                                                        <p class="mb-2">Your total Loans Paid as on date ' . $currentDate . '</p>

                                                        
                                                        ';
                                                        }
                                                        ?>





                                                    </div>
                                                    <div class="col-md-6 col-lg-7">
                                                        <div class="sparkline-bar p-t-50"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card l-bg-cyan">
                                        <div class="card-header">
                                            <h5>Savings Analytics</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-white">
                                                <div class="row">
                                                    <h4 class="mb-0 font-26">Ksh.
                                                        <?php

                                                        $Savings=0;
                                                        // SQL query to calculate the total savings for the specified email
                                                        $sql = "SELECT SUM(saveAmmount) AS totalSavings FROM savings WHERE email ='$user_email' ";

                                                        $result = mysqli_query($conn, $sql);

                                                        if(!$result){
                                                            $totalSavings=0;
                                                        }
                                                        else{
                                                            
                                                        if ($result->num_rows > 0) {
                                                            $row = $result->fetch_assoc();
                                                            $totalSavings = $row['totalSavings'];
                                                            $Savings=$totalSavings;

                                                            } else {
                                                                $totalSavings=0;
                                                            }
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

                                                    </h4>
                                                    <p class="mb-0">Your total Savings as on date <?php $timestamp = time();
                                                        $currentDate = gmdate('Y-m-d', $timestamp);
                                                        echo $currentDate; ?> </p>

                                                </div>
                                                <div class="col-md-6 col-lg-7">
                                                    <div class="sparkline-line-chart2 p-t-50"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card l-bg-cyan">
                                        <div class="card-header">
                                            <h5>Contributions Analytics</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="text-white">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-10">
                                                        <h4 class="mb-0 font-26">Ksh. 3,000</h4>
                                                        <p class="mb-2">Average accustomed contibutions Per Month</p>

                                                    </div>
                                                    <div class="col-md-6 col-lg-7">
                                                        <div class="sparkline-line-chart2 p-t-50"></div>
                                                    </div>
                                                </div>
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
        <script src="assets/bundles/izitoast/js/iziToast.min.js"></script>
        <!-- Page Specific JS File -->
        <script src="assets/js/page/toastr.js"></script>
        <script src="assets/bundles/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="assets/bundles/datatables/datatables.min.js"></script>
        <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
        <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
        <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
        <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
        <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
        <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
        <script src="assets/js/page/datatables.js"></script>
        <!-- JS Libraies -->
        <script src="assets/bundles/jquery-steps/jquery.steps.min.js"></script>
        <!-- Page Specific JS File -->
        <script src="assets/js/page/form-wizard.js"></script>
        <!-- Template JS File -->
        <script src="assets/js/scripts.js"></script>
        <!-- Custom JS File -->
        <script src="assets/js/custom.js"></script>
    </body>


    <!-- form-wizard.html  21 Nov 2019 03:55:20 GMT -->

    </html>

<?php } ?>