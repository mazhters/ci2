<div class="tab-pane" id="tab1Inspire">
  <div class="row">
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
						 <form id="search" action="<?php echo site_url($path_file.'/shift');?>" method="post">
			        <div class="row">
			          <div class="col-md-12">
			              <div class="col-md-3">
		                  <div class="row">
		                      <label>Period</label>
		                      <div id="datepicker_start" class="input-append date success no-padding">
		                        <input type="text" class="form-control start_att" id="periode" name="period" value="<?php echo $period;?>" required>
		                        <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> 
		                      </div>
		                  </div>
			              </div>
			
			              <div class="col-md-2">
		                  <label>&nbsp;</label>
		                  <div class="row">
		                    <div class="col-md-12">
		                    	<button type="submit" class="btn btn-info btn-search-shift"><i class="fa fa-search"></i>&nbsp;Search</button>
		                    </div>
		                  </div>
			              </div>
			          </div>
			        </div>
			      </form>
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
      	<table class="table table-striped table-hover">
			    <tr>
			    	<input type="hidden" id="temp_id" value="">
			    	<th class="box_delete">
			    		<input type="checkbox" onclick="checkedAll('<?php echo $filename;?>', true)" id="primary_check" value="" name="">
			    	</th>
			    	<?php
			    	foreach($grid as $r)
			    	{
			    		echo "<th>".$r."</th>";
			    	}
			    	?>
			    	<th class='action'>Action</th>
			    </tr>
			    <?php
				
					$style='';
			    foreach($query_list->result_array() as $r)
			    {
					
					/*$getdep=GetValue("id_department", "employee", array("id"=> "where/".$r['id_employee']));
					//print_mz($dep);
					if($dep){if(in_array($getdep,$dep)){$style.='';}else{$style.='style="display:none;"'; }}*/
			    	echo "<tr $style id='listz-".$r['id']."' >";
			    	echo "<td class='box_delete'><input type='checkbox' class='delete' id='del".$r['id']."' value='".$r['id']."'></td>";
			    	foreach($list as $s)
			    	{
				    	if($s=='bulan'){
								$r['bulan']=GetMonth(intval($r['bulan'])).' '.$r['tahun'];
							}
			    		echo "<td>".$r[$s]."</td>";
			    	}
			    	echo "<td class='action'>";
			    	//echo "<a href='".site_url($filename.'/detail/'.$r)."'>Edit</a>";
			    	echo '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="detail" onclick="editShift('."'".$r['id']."'".')"><i class="fa fa-edit"></i></a>';
			    	echo "</tr>";
			    }
			    ?>
				</table>
			</div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo assets_url('modules/js/attendance.js')?>"></script>