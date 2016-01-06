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
        <li><a href="<?php echo base_url('absensi/kehadiran')?>">Kehadiran</a> </li>
        <li><a href="<?php echo base_url($this->uri->uri_string())?>" class="active">Ubah</a> </li>
      </ul>
      <div class="page-title"> <i class="icon-custom-left" onclick="javascript:window.location='<?php echo site_url("dashboard");?>'"></i>
        <h3><span class="semi-bold">Ubah Kehadiran</span></h3>
      </div>
      	<div class="row-fluid">
        	<div class="span12">
          		<div class="grid simple ">
            		<div class="grid-body ">

            			<div class="row">
				            <div class="col-md-6">
				              <div class="grid simple">
				                <div class="grid-title no-border">
				                  <h4><span class="semi-bold">Kehadiran</span></h4>
				                </div>
				                <div class="grid-body no-border">
				                  <div class="row">
				                    <div class="col-md-12 col-sm-12 col-xs-12">
				                      <div class="form-group">
				                        <label class="form-label">Nama Karyawan</label>
				                        <select class="select2" style="width:100%">
		                                    <option value="0">-- Pilih Karyawan --</option>
		                                    <option value="0">Tes</option>
		                                    <option value="0">Tes 2</option>
		                                </select>
				                      </div>
				                      <div class="form-group">
				                        <label class="form-label">Tanggal</label>
				                        <div class="row">
				                        	<div class="col-md-12">
						                        <div id="datepicker_start" class="input-append date success no-padding">
			                                      <input type="text" class="form-control" name="start_cuti" required>
			                                      <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> 
			                                    </div>
			                                </div>
		                                </div>
				                      </div>
				                      <div class="form-group">
				                        <label class="form-label">Absensi</label>
				                        <div class="row">
						                    <div class="col-md-12">
						                      <div class="radio">
						                      	<?php for($i=0;$i<14;$i++):?>
						                        <input id="<?php echo $absensi[$i]?>" type="radio" name="absen" value="<?php echo $absensi[$i]?>" checked="checked">
						                        <label for="<?php echo $absensi[$i]?>"><?php echo $absensi[$i]?></label>
						                    	<?php endfor?>
						                      </div>
						                    </div>
						                </div>
				                      </div>
				                      <div class="form-group">
			                      		<div class="row">
					                    	<div class="col-md-12">
					                        	<label class="form-label">Scan Masuk</label>
							                    <div class="input-group transparent clockpicker col-md-5">
							                      <input type="text" class="form-control" placeholder="Pick a time">
							                      <span class="input-group-addon ">
							                       <i class="fa fa-clock-o"></i>
							                      </span>
							                    </div>
					                        	<label class="form-label">Scan Pulang</label>
							                    <div class="input-group transparent clockpicker col-md-5">
							                      <input type="text" class="form-control" placeholder="Pick a time">
							                      <span class="input-group-addon ">
							                       <i class="fa fa-clock-o"></i>
							                      </span>
							                    </div>
					                    	</div>
					                    </div>
				                      </div>
				                      <div class="form-group">
			                      		<div class="row">
					                    	<div class="col-md-12">
					                        	<label class="form-label">Pulang Cepat</label>
							                    <div class="input-group transparent clockpicker col-md-5">
							                      <input type="text" class="form-control" placeholder="Pick a time">
							                      <span class="input-group-addon ">
							                       <i class="fa fa-clock-o"></i>
							                      </span>
							                    </div>
					                    	</div>
					                    </div>
				                      </div>
				                    </div>
				                  </div>
				                </div>
				              </div>
				            </div>

				            <div class="col-md-6">
				              <div class="grid simple">
				                <div class="grid-title no-border">
				                  <h4><span class="semi-bold">Overtime</span></h4>
				                </div>
				                <div class="grid-body no-border">
				                  <div class="row">
				                    <div class="col-md-12 col-sm-12 col-xs-12">
				                      <div class="form-group">
				                        <label class="form-label">OT Incidental</label>
				                        <select class="select2" style="width:100%">
		                                    <option value="0">-- Pilih OT Incidental --</option>
		                                    <option value="0">Tes</option>
		                                    <option value="0">Tes 2</option>
		                                </select>
				                      </div>
				                      <div class="form-group">
				                        <label class="form-label">Acc OT Incidental</label>
				                        <div class="controls">
				                          <input type="password" class="form-control">
				                        </div>
				                      </div>
				                      <div class="form-group">
				                        <label class="form-label">OT Kelebihan Jam</label>
				                        <select class="select2" style="width:100%">
		                                    <option value="0">-- Pilih OT Kelebihan Jam --</option>
		                                    <option value="0">Tes</option>
		                                    <option value="0">Tes 2</option>
		                                </select>
				                      </div>
				                      <div class="form-group">
				                        <label class="form-label">Acc OT Kelebihan Jam</label>
				                        <div class="controls">
				                          <input type="text" placeholder="0" class="form-control">
				                        </div>
				                      </div>
				                      <div class="form-group">
				                        <label class="form-label">Tunjangan Hari Kerja</label>
				                        <select class="select2" style="width:100%">
		                                    <option value="0">-- Pilih Tunjangan Hari Kerja --</option>
		                                    <option value="0">Tes</option>
		                                    <option value="0">Tes 2</option>
		                                </select>
				                      </div>
				                      <div class="form-group">
				                        <label class="form-label">Acc Tunjangan Hari Kerja</label>
				                        <div class="controls">
				                          <input type="text" placeholder="0" class="form-control">
				                        </div>
				                      </div>
				                      <div class="form-group">
				                        <label class="form-label">Alasan Overtime</label>
				                        <select class="select2" style="width:100%">
		                                    <option value="0">-- Pilih Alasan Overtime --</option>
		                                    <option value="0">Tes</option>
		                                    <option value="0">Tes 2</option>
		                                </select>
				                      </div>
				                      <div class="form-group">
				                        <label class="form-label">Keterangan</label>
				                        <textarea class="form-control"></textarea>
				                      </div>
				                    </div>
				                  </div>
				                </div>
				              </div>
				            </div>
				          </div>
              			  <div class="form-actions">
			                <div class="pull-right">
			                	<button class="btn btn-success btn-cons" type="submit"><i class="icon-ok"></i> Ubah</button>
			                    <a href="<?php echo site_url('absensi/kehadiran') ?>"><button class="btn btn-white btn-cons" type="button"> Batal</button></a>
			                </div>
			              </div>
              			</div>
        		</div>
        	</div>
    	</div>
    </div>
</div>