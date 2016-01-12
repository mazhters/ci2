<div class="tab-pane active" id="content">
  <div class="row column-seperation">
    <div class="col-md-12">
    	<div class="grid simple transparent">
				<div class="grid-title">
					<h4>List <span class="semi-bold">Employee</span></h4>
				</div>
			</div>

      <form id="<?php echo $filename;?>">
      <div  id="table_att">
        <table class="table table-bordered no-more-tables">
			    <tr>
			    	<input type="hidden" id="temp_id" value="">
			    	<th class="box_delete">
			    		<input type="checkbox" onclick="checkedAll('<?php echo $filename;?>', true)" id="primary_check" value="" name="">
			    	</th>
			    	<?php
			    	foreach($grid as $r)
			    	{
			    		if($r=="NIK" || $r=="Tanggal Mulai Gabung" || $r=="Jenis Kelamin") echo "<th style='text-align:center;'>".$r."</th>";
			    		else echo "<th>".$r."</th>";
			    	}
			    	?>
			    	<th class='action'>Action</th>
			    </tr>
			    <?php
			    foreach($query_list->result_array() as $r)
			    {
			    	/*$kontrak = strtotime($r['date_end_contract']);
			    	if($kontrak > 0)
			    	{
			    		$selisih = $kontrak - strtotime(date("Y-m-d"));
			    		if($selisih > 0)
			    		{
			    			if($selisih <= 604800) $cls = "redz";
			    			else if($selisih <= 2592000) $cls = "yellowz";
			    			else $cls="";
			    		}
			    		else $cls = "redz";
			    	}
			    	else */
			    	$cls="";
			    	
			    	echo "<tr id='listz-".$r['person_id']."' class='".$cls."'>";
			    	echo "<td class='box_delete'><input type='checkbox' class='delete' id='del".$r['person_id']."' value='".$r['person_id']."'></td>";
			    	foreach($list as $s)
			    	{
			    		if($s=="ttl")
			    		{
			    			$tgl_lahir_temp = strtotime($r['birth_dttm']);
								$tgl_lahir = date("d", $tgl_lahir_temp)." ".GetBulanIndo(date("F", $tgl_lahir_temp))." ".date("Y", $tgl_lahir_temp);
			    			$r[$s] = $r['birthplace'].", ".$tgl_lahir;
			    		}
			    		else if($s=="date_hire_since") $r[$s] = FormatTanggalShort($r[$s]);
			    		else if($s=="usia") $r[$s] = (date("Y") - substr($r['date_of_birth'],0,4));
			    		if($s=="nik" || $s=="date_hire_since" || $s=="sex") echo "<td style='text-align:center;'>".$r[$s]."</td>";
			    		else echo "<td>".$r[$s]."</td>";
			    	}
			    	echo "<td class='action'>";//<a href='".site_url($path_file.'/detail/'.$r['person_id'])."'>Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='".site_url($path_file.'/dashboard/'.$r['person_id'])."'>Detail</a>";
			    	echo '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="detail" onclick="detailEmp('."'".$r['person_id']."'".')"><i class="fa fa-edit"></i></a>';
			    	//&nbsp;&nbsp;|&nbsp;&nbsp;<a href='#' data-controls-modal='modal-export' class='export_all' rel='".$r['id']."'>Export</a>";
			    	//&nbsp;|&nbsp;&nbsp;<a href='".site_url($path_file.'/wp/'.$r['id'])."'>Kegiatan</a></td>";
			    	echo "</td>";
			    	echo "</tr>";
			    }
			    ?>
				</table>
				<!--<br><br>
			  <div class="clear"></div>
			  <div class="pagination">
			  	<ul>
			    	<li class="prev disabled"><a><?php echo lang('page');?></a></li>
			      <?php echo $pagination;?>
			    </ul>
			  </div>
				<div class="tombol">
					<input type="button" value="<?php echo lang("delete");?>" alt="<?php echo lang("delete");?>" title="<?php echo lang("delete");?>" class="delete_button btn" disabled/>
					<input type="button" value="<?php echo lang("add");?>" alt="<?php echo lang("add");?>" title="<?php echo lang("add");?>" class="btn" onClick="javascript:window.location='<?php echo base_url().$path_file;?>/detail/0';"/>
				</div>
				<div id="id_temp" value=""></div>-->
			</div>
			</form>
    </div>
  </div>
</div>

<script src="<?php echo assets_url('modules/js/employee.js')?>"></script>