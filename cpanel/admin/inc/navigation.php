<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="/aayopayo/cpanel/admin/admindashboard.php"><i class="fa fa-fw fa-dashboard"></i>Admin Dashboard</a>
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
              <a href="/aayopayo/cpanel/admin/product/addproduct.php">Add Products</a>
            </li>
            <li>
              <a href="/aayopayo/cpanel/admin/product/viewproduct.php">View Products</a>
            </li>
             <li>
              <a href="/aayopayo/cpanel/admin/product/removeproduct.php">Removed Products</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="User">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <span class="nav-link-text">Users</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="/aayopayo/cpanel/admin/user/viewuser.php">View Users</a>
            </li>
            <li>
              <a href="/aayopayo/cpanel/admin/user/removeuser.php">Remove User</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Auction">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <span class="nav-link-text">Auction</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="/aayopayo/cpanel/admin/auction/auctiondetails.php">View Auction</a>
            </li><!-- 
            <li>
              <a href="/aayopayo/cpanel/admin/auction/auctionremoved.php">Removed Auction</a>
            </li> -->
            
          </ul>
        </li>

         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Contributor">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseContri" data-parent="#exampleAccordion">
            <span class="nav-link-text">Contributor</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseContri">
            <li>
              <a href="/aayopayo/cpanel/admin/contributor/viewcontributor.php">View Contributor Details</a>
            </li>
            <li>
              <a href="/aayopayo/cpanel/admin/contributor/addcontributor.php">Add Contributor</a>
            </li>
            <li>
              <a href="/aayopayo/cpanel/admin/contributor/removedcontributor.php">Removed Contributor</a>
            </li>
            
          </ul>
        </li>

           <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Ads">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseads" data-parent="#exampleAccordion">
            <span class="nav-link-text">Ad Section</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseads">
            <li>
              <a href="/aayopayo/cpanel/admin/ad/viewphotoads.php">View existing Photo Ad</a>
            </li>
            <li>
              <a href="/aayopayo/cpanel/admin/ad/viewvideoads.php">View existing Video Ad</a>
            </li>
            <li>
              <a href="/aayopayo/cpanel/admin/ad/addphotoads.php">Add New Photo Ad</a>
            </li>
            <li>
              <a href="/aayopayo/cpanel/admin/ad/addvideoads.php">Add New Video Ad</a>
            </li>
            <li>
              <a href="/aayopayo/cpanel/admin/ad/removedads.php">Removed Ad</a>
            </li>            
          </ul>
        </li>


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Banner">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseBanner" data-parent="#exampleAccordion">
            <span class="nav-link-text">Banner</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseBanner">
            <li>
              <a href="/aayopayo/cpanel/admin/banner/viewbanner.php">View Banner</a>
            </li>
            <li>
              <a href="/aayopayo/cpanel/admin/banner/addbanner.php">Add Banner</a>
            </li>
            <li>
              <a href="/aayopayo/cpanel/admin/banner/removedbanner.php">Removed Banner</a>
            </li>            
          </ul>
        </li>

           <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profile">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseProfi" data-parent="#exampleAccordion">
            <span class="nav-link-text">Profile</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseProfi">
            <li>
              <a href="/aayopayo/cpanel/admin/accountupdate.php">My Accounts</a>
            </li>
            <li>
              <a href="/aayopayo/cpanel/admin/changepassword.php">Update Password</a>
            </li>
            <li>
              <a href="/aayopayo/logout.php">Logout</a>
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

        <!-- Notification -->
        <?php include 'notificationnav.php'; ?>
         <li class="nav-item">
          <a class="nav-link" href="/aayopayo/logout.php">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
        <li class="nav-item">
          
        </li>
       
      </ul>
    </div>
  </nav>