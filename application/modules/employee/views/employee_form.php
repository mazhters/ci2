<style>
.form-label{width:100px;}
</style>
<div class="grid simple transparent">
	<div class="grid-title">
		<h4>Edit <span class="semi-bold">Employee</span></h4></a>
	</div>
</div>

<form id="form_edit_emp" action="employee/update" method="post" enctype="multipart/form-data">
<div class="row">
  <div class="col-md-6">
    <div class="grid simple">
      <div class="grid-body no-border">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
							<label class="form-label">Name</label>
							<?php
								echo form_hidden("id", $val['person_id']);
								$nm_f = "person_nm";
								echo form_input($nm_f, isset($val[$nm_f]) ? $val[$nm_f] : "", "id='".$nm_f."' class='span5 required'");
								echo form_hidden($nm_f."_temp", isset($val[$nm_f]) ? $val[$nm_f] : "");
							?>
						</div>
						
						<div class="form-group">
							<label class="form-label">NIK</label>
							<?php 
								$nm_f = "ext_id";
								echo form_input($nm_f, isset($val[$nm_f]) ? $val[$nm_f] : "", "id='".$nm_f."' class='span5'");
								echo form_hidden($nm_f."_temp", isset($val[$nm_f]) ? $val[$nm_f] : "");
							?>
						</div>
						
						<div class="form-group">
              <label class="form-label">Group</label>
              <?php
	              $nm_f = "employee_grup";
	              echo form_dropdown($nm_f, $opt_emp_grup, isset($val[$nm_f]) ? $val[$nm_f] : 0, "id='".$nm_f."' class='span2'");
              ?>
            </div>
            
            <div class="form-group">
              <label class="form-label">Group Active</label>
              <div id="datepicker_start" class="input-append date success no-padding">
              	<input type="text" class="tgl form-control" value="<?php echo $val['employee_grup_active'];?>" name="employee_grup_active">
                <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="grid simple">
      <div class="grid-body no-border">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
							<label class="form-label">Gender</label>
							<?php 
								$nm_f = "adm_gender_cd";
								if(isset($val[$nm_f]))
								{
									$chk_1 = $val[$nm_f] == "m" ? TRUE : FALSE;
									$chk_2 = $val[$nm_f] == "f" ? TRUE : FALSE;
								}
								else {$chk_1=TRUE;$chk_2=FALSE;}
								
								echo form_radio($nm_f, 'm', $chk_1)." Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								echo form_radio($nm_f, 'f', $chk_2)." Female";
							?>
						</div>
						
						<div class="form-group">
							<label class="form-label">Place of Birth</label>
							<?php 
								$nm_f = "birthplace";
								echo form_input($nm_f, isset($val[$nm_f]) ? $val[$nm_f] : "", "id='".$nm_f."' class='span5'");
								echo form_hidden($nm_f."_temp", isset($val[$nm_f]) ? $val[$nm_f] : "");
							?>
						</div>
						
						<div class="form-group">
							<label class="form-label">Date of Birth</label>
							<?php 
								$nm_f = "birth_dttm";
								echo form_input($nm_f, isset($val[$nm_f]) ? substr($val[$nm_f],0,10) : "", "id='".$nm_f."' class='span3 required'");
								echo form_hidden($nm_f."_temp", isset($val[$nm_f]) ? substr($val[$nm_f],0,10) : "");
							?>
						</div>
						
						<div class="form-group">
							<label class="form-label">Email</label>
							<?php 
								$nm_f = "email";
								echo form_input($nm_f, isset($val[$nm_f]) ? str_replace(" ","",$val[$nm_f]) : "", "id='".$nm_f."' class='span5 email'");
								echo form_hidden($nm_f."_temp", isset($val[$nm_f]) ? str_replace(" ","",$val[$nm_f]) : "");
							?>
						</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="clearfix_button pull-right">
		<button type="submit" class="btn btn-success btn-submit-emp">&nbsp;Submit</button>
		<button type="submit" class="btn btn-cancel-emp">&nbsp;Cancel</button>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
	</div>
</div>
</form>

<script src="<?php echo assets_url('modules/js/employee.js')?>"></script>