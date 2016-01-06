<!-- BEGIN PAGE CONTAINER-->
<div class="page-content">
  <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
  <div id="portlet-config" class="modal hide">
    <div class="modal-header">
      <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
    </div>
    <div class="modal-body"> Widget settings form goes here </div>
  </div>
  <div class="clearfix"></div>
  <div class="content">
    <ul class="breadcrumb">
      <li>
        <p>YOU ARE HERE</p>
      </li>
      <li><a href="<?php echo base_url('absensi/attendance')?>" class="active"><?php echo ucwords(lang('attendance'))?></a> </li>
    </ul>
    <div class="page-title"> <i class="icon-custom-left" onclick="javascript:window.location='<?php echo site_url("dashboard");?>'"></i>
      <h3><span class="semi-bold"><?php echo ucwords(lang('attendance'))?></span></h3>
    </div>
    <div class="row-fluid">
      <div class="span12">
          <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
              <li class="active">
                <a href="#" onclick="loadAttendance()" role="tab" data-toggle="tab"><?php echo lang('list_attendance')?></a>
              </li>
              <li>
                <a href="#" onclick="loadOvertime()" role="tab" data-toggle="tab"><?php echo  ucwords(lang('overtime'))?></a>
              </li>
              <li>
                <a href="#" onclick="loadShift()" role="tab" data-toggle="tab"><?php echo ucwords(lang('shift_schedule'))?></a>
              </li>
            </ul>
            <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            <div class="tab-content">
              <div class="tab-pane active" id="content">
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">window.onload = function(){loadAttendance();};</script>