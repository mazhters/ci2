<div class="grid simple transparent">
	<div class="grid-title">
		<h4>List <span class="semi-bold">Attendance</span></h4></a>
		<div class="actions">
			<a href="javascript:void(0);" onclick="backAtt('<?php echo $start_date;?>', '<?php echo $end_date;?>')"><i class='fa fa-chevron-circle-left'></i> Back</a>
		</div>
	</div>
</div>

<div class="col-md-6">
    <div class="row">
        <div class="tiles white col-md-12  no-padding">         
            <div class="tiles-body">
                <div class="row">
                	<?php
                	foreach($emp->result_array() as $e) {
                		?>
                    <div class="col-md-3">
                        <div class="">
                            <img width="100" height="100" src="<?php echo assets_url('assets/img/profiles/photo-default.png')?>" data-src="<?php echo assets_url('assets/img/profiles/photo-default.png')?>" data-src-retina="<?php echo assets_url('assets/img/profiles/photo-default.png')?>" alt="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <span class="semi-bold">Name</span>
                    </div>
                    <div class="col-md-4">
                        <span class="semi-bold">: <?php echo $e['person_nm'];?></span>
                    </div>
                    <br/><br/>
                    <div class="col-md-4">
                        <span class="semi-bold">Job Title</span>
                    </div>
                    <div class="col-md-4">
                        <span class="semi-bold">:</span>
                    </div>
                    <br/><br/>
                    <div class="col-md-4">
                        <span class="semi-bold">Division/Section</span>
                    </div>
                    <div class="col-md-4">
                        <span class="semi-bold">:</span>
                    </div>
                    <?php
                  }
                  ?>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table table-striped table-hover">
    <tr>
    	<?php if(permissionaction()){?>
    	<input type="hidden" id="temp_id" value="">
    	<th>
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
    foreach($query_list->result_array() as $r)
    {
    	if($shift) $r['id'] = $r['id_k'];
    	echo "<tr id='listz-".$r['id']."'>";
    	if(permissionaction()) echo "<td class='box_delete'><input type='checkbox' class='delete' id='del".$r['id']."' value='".$r['id']."'></td>";
    	
		
		foreach($list as $s)
    	{
    		if($s == "tgl")
    		{
    			$r[$s] = GetTanggal($r['tanggal'])." ".GetMonthFull(intval($r['bulan']))." ".$r['tahun'];
    		}
    		else if($s == "id_employee")
    		{
    			$r[$s.'_temp'] = $r[$s];
    			//$r[$s] = GetValue("person_nm","hris_persons", array("person_id"=> "where/".$r[$s]));
    		}
    		else if($s == "shift")
    		{
    			$r[$s] = GetShift(GetValue("tgl_".intval($r['tanggal']),"kg_jadwal_shift", array("id_employee"=> "where/".$r['id_employee'], "bulan"=> "where/".$r['bulan'], "tahun"=> "where/".$r['tahun'])));
    			//lastq();
    		}
    		else if($s == "name" || $s == "keterangan" || $s == "scan_masuk" || $s == "scan_pulang") $r[$s] = $r[$s];
    		else if(($s == 'jh' || $s == 'hr') && $flag_tgl)
    		{
				//print_mz($r);
				if($r['hr'] == 1) { 
				$r['jh'] = "<i class='fa fa-check'></i>"; 
				}
    			else if($s == "jh" && $r['jh'] == 1){ 
				
				$r['jh'] = "<i class='fa fa-check'></i>";}
    			else $r[$s]="";
    		}
    		else if($r[$s] == 1 && $flag_tgl) $r[$s] = "<i class='fa fa-check'></i>";
    		else if($flag_tgl) $r[$s]="";
    		echo "<td>".$r[$s]."</td>";
    	}
    	if(!$r['id']) $r['id']=0;
    	
    	if(permissionaction()){
    	echo "<td class='action'>";
	    if($flag_tgl){ 
	    	if(permissionactionz()){ 
		    	if($tgl_today==date("Y-m-d")) echo "-";
		    	//else echo "<a href='".site_url($filename.'/edit/0/'.$r['tahun'].'-'.$r['bulan'].'-'.GetTanggal($r['tanggal']).'/'.$r['id_employee'].'/'.$r['id'].'/u')."'>Edit</a>";
          else echo '<a class="btn btn-sm btn-primary" href="javascript:void(0);" title="detail" onclick="editAtt('."'".$r['id']."'".')"><i class="fa fa-pencil"></i></a>';
	    	}
	    } else echo "<a href='".site_url($filename.'/main/'.$r['a_id'].'/'.$tgl)."'>Detail</a>";
	    echo "</td>";
	  	}
	    echo "</tr>";
    }
    ?>
</table>