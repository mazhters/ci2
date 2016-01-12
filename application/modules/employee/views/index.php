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
      <li><a href="<?php echo base_url('employee')?>" class="active"><?php echo ucwords(lang('employee'))?></a> </li>
    </ul>
    <!--<div class="page-title"> <i class="icon-custom-left" onclick="javascript:window.location='<?php echo site_url("dashboard");?>'"></i>
      <h3><span class="semi-bold"><?php echo ucwords(lang('employee'))?></span></h3>
    </div>-->
    <div class="row-fluid">
      <div class="span12">
          <div class="col-md-12">
            <div class="tab-content">
              <div class="tab-pane active" id="content">
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">window.onload = function(){loadEmp();};</script>