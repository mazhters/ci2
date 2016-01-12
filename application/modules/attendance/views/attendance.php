<div class="tab-pane active" id="content">
  <div class="row column-seperation">
    <div class="col-md-12">
    	<div class="panel-group" id="accordion" data-toggle="collapse">
			  <div class="panel panel-default">
					<div class="panel-heading">
					  <h4 class="panel-title">
						<a class="" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
						   Search
						</a>
					  </h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in">
					  <div class="panel-body">
						 <form id="search" action="<?php echo site_url($path_file.'/list_attendance');?>" method="post">
			        <div class="row">
			          <div class="col-md-12">
			              <!--<div class="col-md-3">
			                  <label>Departement</label>
			                  <select class="select2" style="width:100%">
			                      <option value="0">-- Choose Departement --</option>
			                      <option value="0">Tes</option>
			                      <option value="0">Tes 2</option>
			                  </select>
			              </div>-->
			              <div class="col-md-3">
			                  <div class="row">
			                      <label>Date</label>
			                      <div id="datepicker_start" class="input-append date success no-padding">
			                        <input type="text" class="form-control start_att tgl" name="start_cuti" value="<?php echo $start_date;?>" required>
			                        <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> 
			                      </div>
			                  </div>
			              </div>
			              <div class="to">to</div>
			              <div class="col-md-3">
			                  <div class="row">
			                      <label>&nbsp;</label>
			                      <div id="datepicker_end" class="input-append date success no-padding">
			                          <input type="text" class="form-control end_att tgl" name="end_cuti" value="<?php echo $end_date;?>">
			                          <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> 
			                      </div>
			                  </div>
			              </div>
			
			              <div class="col-md-2">
			                  <label>&nbsp;</label>
			                  <div class="row">
			                    <div class="col-md-12">
			                        <button type="submit" class="btn btn-info btn-search"><i class="fa fa-search"></i>&nbsp;Search</button>
			                    </div>
			                  </div>
			              </div>
			          </div>
			        </div>
			      </form>
					  </div>
					</div>
			  </div>
			  <div class="panel panel-default" style="display:none;">
					<div class="panel-heading">
					  <h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion"  href="#collapseTwo">
						  Syncronize
						</a>
					  </h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse">
					  <div class="panel-body">				
	            <div class="row">
			          <div class="col-md-12">
		              <div class="col-md-3">
	                  <div class="row">
	                      <label>Date</label>
	                      <div id="datepicker_start" class="input-append date success no-padding">
	                        <input type="text" class="form-control tgl_absen tgl" required>
	                        <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> 
	                      </div>
	                  </div>
		              </div>
		              <div class="col-md-2">
	                  <label>&nbsp;</label>
	                  <button type="button" name="submit" class="btn btn-success btn-sync"><i class='fa fa-refresh'> Sync</i></button>
	                  <div class="sync"></div>
		              </div>
			          </div>
			        </div>
					  </div>
					</div>
			  </div>
			  <div class="panel panel-default" style="display:none;">
					<div class="panel-heading">
					  <h4 class="panel-title">
						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
						 Upload
						</a>
					  </h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse">
					  <div class="panel-body">
							<div class="row">
			          <div class="col-md-12">
		              <div class="col-md-4">
		                  <label>File</label>
		                  <input type="file" id="file_upload" name="userfile">
		              </div>
		              <div class="col-md-2">
		                  <label>&nbsp;</label>
		                  <button type="submit" name="submit" class="btn btn-primary"><i class='fa fa-upload'> Upload</i></button>
		              </div>
			          </div>
			          <!--<div class="col-md-12">
			            <br/>
			            <legend>
			                <label><a href="http://localhost/dus/uploads/template_kehadiran.xls">Download Template</a></label>  
			            </legend>
			          </div>-->
			        </div>
					  </div>
					</div>
			  </div>
			</div>
			
			<div class="grid simple transparent">
				<div class="grid-title">
					<h4>List <span class="semi-bold">Attendance</span></h4>
				</div>
			</div>

      <form id="<?php echo $filename;?>">
      <div  id="table_att">
        <table class="table table-bordered no-more-tables">
          <tr>
            <?php if(permissionaction()){?>
            <input type="hidden" id="temp_id" value="">
            <th class="box_delete">
                <input type="checkbox" onclick="checkedAll('<?php echo $filename;?>', true)" id="primary_check" value="" name="">
            </th>
            <?php }?>
            <?php
            foreach($grid as $r)
            {
                echo "<th>".$r."</th>";
            }
            ?>
            <?php if(permissionaction()){?>
            <th class='action'>Action</th>
            <?php }?>
        </tr>
        <?php
        $shift=array();
        $q_cek_shift = GetAll("kg_jadwal_shift", array("id_employee"=> "group"));
        foreach($q_cek_shift->result_array() as $s) {
        	$shift[$s['id_employee']] = $s['id_employee']; 
        }

        foreach($query_list->result_array() as $r)
        {
        	if(isset($shift[$r['a_id']])) {
            echo "<tr id='listz-".$r['id']."'>";
            if(permissionaction()) echo "<td class='box_delete'><input type='checkbox' class='delete' id='del".$r['id']."' value='".$r['id']."'></td>";
            foreach($list as $s)
            {
                if($s == "name") $r[$s] = $r[$s];
                else if($s == 'hr' && $r['hr'] == 1 && $flag_tgl){ $r['jhk'] = "<img src='".base_url()."assets/images/1.gif'>";}
                else if($r[$s] == 1 && $flag_tgl) $r[$s] = "<img src='".base_url()."assets/images/1.gif'>";
                else if($flag_tgl) $r[$s]="";
                echo "<td>".$r[$s]."</td>";
            }
            if(!$r['id']) $r['id']=0;
            if(permissionaction()){
                echo "<td class='action text-center'>";
                if($flag_tgl) echo "<a href='".site_url($path_file.'/detail/'.$dep.'/'.$tgl.'/'.$r['a_id'].'/'.$r['id'])."'>Edit</a> | ";
                echo '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="detail" onclick="detailAtt('."'".$r['a_id']."'".')"><i class="fa fa-info"></i></a>';
                echo "</td>";
            }
            echo "</tr>";
          }
        }
        ?>
        </table>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo assets_url('modules/js/attendance.js')?>"></script>