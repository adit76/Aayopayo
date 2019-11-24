<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php"><i class="fa fa-fw fa-dashboard"></i>Contributor Dashboard</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Products">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <span class="nav-link-text">Products</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="/khel/contributor/product/addproduct.php">Add Products</a>
            </li>
            <li>
              <a href="/khel/contributor/product/viewproduct.php">View Products</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Products">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#productss" data-parent="#exampleAccordion">
            <span class="nav-link-text">Auction</span>
          </a>
          <ul class="sidenav-second-level collapse" id="productss">
            <li>
              <a href="/khel/contributor/auction/auctiondetails.php">Auction Details</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profile">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProfi" data-parent="#exampleAccordion">
            <span class="nav-link-text">Profile</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseProfi">
            <li>
              <a href="/khel/contributor/accountupdate.php">My Accounts</a>
            </li>
            <li>
              <a href="/khel/contributor/changepassword.php">Update Password</a>
            </li>
            <li>
              <a href="/khel/logout.php">Logout</a>
            </li>

          </ul>
        </li>
      </ul>
      
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>

      <!-- end of side nav -->


      <!-- message box and notifications -->
      <!-- message box -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i><span>Messages</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Hello Wolrd</strong>
              <div class="dropdown-message small">ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua..</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Ribesh Basnet</strong>
              <div class="dropdown-message small">ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Smile</strong>
              <div class="dropdown-message small">ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div>
        </li>
        <!-- end of message box -->

        <!-- Notification -->
        <li class="nav-item dropdown" style="margin-right: 50px;">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i><span>Notification's</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Notification:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text">
                <strong>Password Update</strong>
              </span>
              <div class="dropdown-message small">ipsum dolor sit amet,</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text">
                <strong>Product Update</strong>
              </span>
              <div class="dropdown-message small">ipsum dolor sit amet,</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text">
                <strong>Accounts Update</strong>
              </span>

              <div class="dropdown-message small">This is an automated server response message.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all notifications</a>
          </div>
        </li>
         <li class="nav-item">
          <a href="/khel/logout.php" style="underline: none;">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
        <li class="nav-item">

        </li>

      </ul>
    </div>
  </nav>
