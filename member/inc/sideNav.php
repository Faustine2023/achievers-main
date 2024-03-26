<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.php?page=homepage%33for=<?php echo $system_name; ?>/%current_user<?php echo $_SESSION['user_name']; ?>"> <img alt="image" src="<?php echo $system_logo; ?>" class="header-logo" /> <span
              class="logo-name"><?php echo $system_name; ?></span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">User Info</li>
            <li class="dropdown active">
              <a href="index.php?page=homepage%33for=<?php echo $system_name; ?>/%current_user<?php echo $_SESSION['user_name']; ?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="briefcase"></i><span>Loans</span></a>
              <ul class="dropdown-menu">
                  <li><a class="nav-link" name="all-loans" href="all_loans.php?page=view_all_loans for <?php echo $_SESSION['user_name']; ?>">All Loans</a></li>
                  <li><a class="nav-link" name="paid-loans" href="paid_loans.php?page=view_paid_loans for <?php echo $_SESSION['user_name']; ?>">Paid Loans</a></li>
                  <li><a class="nav-link" name="pending-loans" href="pending_loans.php?page=view_pending_loans for <?php echo $_SESSION['user_name']; ?>">Pending Loans</a></li>

              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="shopping-bag"></i><span>My Savings</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="savings.php">Savings Info</a></li>
              </ul>
            </li>

            <li class="menu-header">Reports</li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="layout"></i><span>Loan Reports</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="loan_reports.php">View/Print Reports</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="grid"></i><span>Savings Reports</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="savings_report.php">View/Print Reports</a></li>
              </ul>
            </li>
           
            <li class="menu-header"><?php echo $system_name ?></li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="user-check"></i><span>Contact Us</span></a>
              <ul class="dropdown-menu">
                <li><a href="contact.php">Contact Us</a></li>
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="anchor"></i><span>Other
                  Pages</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="posts.php">Posts</a></li>
              </ul>
            </li>

            <li class="menu-header">My Account </li>
            <li class="dropdown">
              <a href="profile.php" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="user"></i><span>Profile</span></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php?q=profile?page=viewprofile info for=<?php echo $_SESSION['user_name'] ?>">Profile</a></li>
                <li><a href="forgot_password.php?q=changepassword?page=password change by email for=<?php echo $_SESSION['user_name'] ?>">Change Password</a></li>
                <li><a href="logout.php?for=<?php echo $_SESSION['user_name'] ?>">Log Out</a></li>
              </ul>
            </li>
            
            
          </ul>
        </aside>
      </div>