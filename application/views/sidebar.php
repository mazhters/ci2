<div class="page-container row-fluid">
      <!-- BEGIN SIDEBAR -->
      <!-- BEGIN MENU -->
      <div class="page-sidebar" id="main-menu">
        <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
          <!-- BEGIN MINI-PROFILE -->
          <div class="user-info-wrapper">
            <div class="profile-wrapper">
              <img src="<?php echo assets_url('assets/img/profiles/avatar.jpg')?>" alt="" data-src="<?php echo assets_url('assets/img/profiles/avatar.jpg')?>" data-src-retina="<?php echo assets_url('assets/img/profiles/avatar2x.jpg')?>" width="69" height="69" />
            </div>
            <div class="user-info">
              <div class="greeting">Welcome</div>
              <div class="username">Administrator<span class="semi-bold"></span></div>
              <div class="status">Status
                <a href="#">
                  <div class="status-icon green"></div>Online</a>
              </div>
            </div>
          </div>
          <!-- END MINI-PROFILE -->
          <!-- BEGIN SIDEBAR MENU -->
          <ul>
            <!-- BEGIN SELECTED LINK -->
            <li class="start active">
              <a href="<?php echo base_url()?>">
                <i class="icon-custom-home"></i>
                <span class="title">Dashboard</span>
                <span class="selected"></span>
              </a>
            </li>
            <li class="">
              <a href="<?php echo base_url('attendance')?>">
                <i class="fa fa-sign-in"></i>
                <span class="title">Attendance</span>
                <!--<span class="arrow"></span>-->
              </a>
              <!--
              <ul class="sub-menu">
                <li class="start active"><a href="<?php echo base_url('absensi/attendance')?>">Attendance</a></li>
                <li><a href="<?php echo base_url('absensi/overtime')?>">Overtime</a></li>
                <li><a href="<?php echo base_url('absensi/overtime_analysis')?>">Overtime Analysis</a></li>
                <li><a href="<?php echo base_url('absensi/shift_schedule')?>">Shift Schedule</a></li>
                <li><a href="<?php echo base_url('absensi/employee_finger')?>">Employee Finger</a></li>
              </ul>
              -->
            </li>
             <li class="">
              <a href="javascript:;">
                <i class="fa fa-usd"></i>
                <span class="title">Payroll</span>
                <span class="arrow"></span>
              </a>
              <ul class="sub-menu">
                <li><a href="<?php echo base_url('payroll/payroll_component')?>">Component</a></li>
                <li><a href="<?php echo base_url('payroll/payroll_group')?>">Group</a></li>
              </ul>
            </li>
            <!-- END SELECTED LINK -->
          </ul>
          <!-- END SIDEBAR MENU -->
          <div class="clearfix"></div>
          <!-- END SIDEBAR WIDGETS -->
        </div>
      </div>
      <!-- BEGIN SCROLL UP HOVER -->
      <a href="#" class="scrollup">Scroll</a>
      <!-- END SCROLL UP HOVER -->
      <!-- END MENU -->
      <!-- END SIDEBAR -->