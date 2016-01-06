<!-- BEGIN HEADER -->
    <div class="header navbar navbar-inverse">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="navbar-inner">
        <!-- BEGIN NAVIGATION HEADER -->
        <div class="header-seperation">
          <!-- BEGIN MOBILE HEADER -->
          <ul class="nav pull-left notifcation-center visible-xs visible-sm">
            <li class="dropdown">
              <a href="#main-menu" data-webarch="toggle-left-side">
                <div class="iconset top-menu-toggle-white"></div>
              </a>
            </li>
          </ul>
          <!-- END MOBILE HEADER -->
          <!-- BEGIN LOGO -->
          <a href="#">
            <img src="<?php echo assets_url('assets/img/logo.png')?>" class="logo" alt="" data-src="<?php echo assets_url('assets/img/logo.png')?>" data-src-retina="<?php echo assets_url('assets/img/logo2x.png')?>" width="106" height="21" />
          </a>
          <!-- END LOGO -->
          <!-- BEGIN LOGO NAV BUTTONS -->
          <ul class="nav pull-right notifcation-center">
            <li class="dropdown hidden-xs hidden-sm">
              <a href="<?php echo base_url()?>" class="dropdown-toggle active" data-toggle="">
                <div class="iconset top-home"></div>
              </a>
            </li>
            <!--
            <li class="dropdown hidden-xs hidden-sm">
              <a href="email.html" class="dropdown-toggle">
                <div class="iconset top-messages"></div><span class="badge">2</span>
              </a>
            </li>
            -->
            <li class="dropdown visible-xs visible-sm">
              <a href="#" data-webarch="toggle-right-side">
                <div class="iconset top-chat-white "></div>
              </a>
            </li>
          </ul>
          <!-- END LOGO NAV BUTTONS -->
        </div>
        <!-- END NAVIGATION HEADER -->
        <!-- BEGIN CONTENT HEADER -->
        <div class="header-quick-nav">
          <!-- BEGIN HEADER LEFT SIDE SECTION -->
          <div class="pull-left">
            <!-- BEGIN SLIM NAVIGATION TOGGLE -->
            <ul class="nav quick-section">
              <li class="quicklinks">
                <a href="#" class="" id="layout-condensed-toggle">
                  <div class="iconset top-menu-toggle-dark"></div>
                </a>
              </li>
            </ul>
            <!-- END SLIM NAVIGATION TOGGLE -->
          </div>
          <!-- END HEADER LEFT SIDE SECTION -->
          <!-- BEGIN HEADER RIGHT SIDE SECTION -->
          <div class="pull-right">
            <div class="chat-toggler">
              <!-- BEGIN NOTIFICATION CENTER -->
              <a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom" data-content="" data-toggle="dropdown" data-original-title="Notifications">
                <div class="user-details">
                  <div class="username">
                    <span class="badge badge-important">3</span>&nbsp;<?php echo strtok($person_nm, " ")?><span class="bold"></span>
                  </div>
                </div>
                <div class="iconset top-down-arrow"></div>
              </a>
              <div id="notification-list" style="display:none">
                <div style="width:300px">
                  <!-- BEGIN NOTIFICATION MESSAGE -->
                  <div class="notification-messages info">
                    <div class="user-profile">
                      <img src="<?php echo assets_url('assets/img/profiles/d.jpg')?>" alt="" data-src="<?php echo assets_url('assets/img/profiles/d.jpg')?>" data-src-retina="<?php echo assets_url('assets/img/profiles/d2x.jpg')?>" width="35" height="35">
                    </div>
                    <div class="message-wrapper">
                      <div class="heading">Title of Notification</div>
                      <div class="description">Description...</div>
                      <div class="date pull-left">A min ago</div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <!-- END NOTIFICATION MESSAGE -->
                </div>
              </div>
              <!-- END NOTIFICATION CENTER -->
              <!-- BEGIN PROFILE PICTURE -->
              <div class="profile-pic">
                <img src="<?php echo assets_url('assets/img/profiles/avatar_small.jpg')?>" alt="" data-src="<?php echo assets_url('assets/img/profiles/avatar_small.jpg')?>" data-src-retina="<?php echo assets_url('assets/img/profiles/avatar_small2x.jpg')?>" width="35" height="35" />
              </div>
              <!-- END PROFILE PICTURE -->
            </div>
            <!-- BEGIN HEADER NAV BUTTONS -->
            <ul class="nav quick-section">
              <!-- BEGIN SETTINGS -->
              <li class="quicklinks">
                <a data-toggle="dropdown" class="dropdown-toggle pull-right" href="#" id="user-options">
                  <div class="iconset top-settings-dark"></div>
                </a>
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="user-options">
                  <li><a href="#">Normal Link</a></li>
                  <li><a href="#">Badge Link&nbsp;&nbsp;<span class="badge badge-important animated bounceIn">2</span></a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo base_url('login/logout')?>"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Log out</a></li>
                </ul>
              </li>
              <!-- END SETTINGS -->
              <li class="quicklinks"><span class="h-seperate"></span></li>
              </ul>
            <!-- END HEADER NAV BUTTONS -->
          </div>
          <!-- END HEADER RIGHT SIDE SECTION -->
        </div>
        <!-- END CONTENT HEADER -->
      </div>
      <!-- END TOP NAVIGATION BAR -->
    </div>
    <!-- END HEADER -->