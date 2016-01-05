<div class="tab-pane" id="tab1Inspire">
  <div class="row">
    <div class="col-md-12">

    	<form id="search" action="<?php echo site_url($path_file.'/search');?>" method="post">
        <h3>Search</h3>
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-3">
                  <label>Departement</label>
                  <select class="select2" style="width:100%">
                      <option value="0">-- Choose Departement --</option>
                      <option value="0">Tes</option>
                      <option value="0">Tes 2</option>
                  </select>
              </div>
              <div class="col-md-3">
                  <div class="row">
                      <label>Periode</label>
                      <div id="datepicker_start" class="input-append date success no-padding">
                        <input type="text" class="form-control" name="start_cuti" required>
                        <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> 
                      </div>
                  </div>
              </div>
              

              <div class="col-md-2">
                  <label>&nbsp;</label>
                  <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i>&nbsp;Search</button>
                    </div>
                  </div>
              </div>
          </div>
        </div>
      </form>
      <br/>
      <h3>File Upload</h3>
      <div class="row">
          <div class="col-md-12">
              <div class="col-md-3">
                  <label>File</label>
                  <input type="file" id="file_upload" name="userfile">
              </div>
              <div class="col-md-1">
              </div>
              <div class="col-md-2">
                  <label>&nbsp;</label>
                  <button type="submit" name="submit" class="btn btn-primary"><i class='fa fa-upload'> Upload</i></button>
              </div>
          </div>
          <div class="col-md-12">
            <br/>
            <legend>
                <label><a href="http://localhost/dus/uploads/template_kehadiran.xls">Download Template</a></label>  
            </legend>
          </div>
      </div>

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
    		if($s=="title") {
				$r[$s] = GetValue("title", "department", array("id"=> "where/".GetValue("id_department", "employee", array("id"=> "where/".$r['id_employee']))));
			}
			elseif($s=="employee") {
				$r[$s] = GetValue("name", "employee", array("id"=> "where/".GetValue("id", "employee", array("id"=> "where/".$r['id_employee']))));
			}
			elseif($s=='bulan'){
				$r['bulan']=getBulan($r['bulan']).' '.$r['tahun'];
			}
    		echo "<td>".$r[$s]."</td>";
    	}
    	echo "<td class='action'>";
    	hak_edit1($this->session->userdata('webmaster_grup'),$filename,1,$r['id']);
    	echo "</tr>";
    }
    ?>
	</table>
    </div>
  </div>
</div>

<script src="<?php echo assets_url('modules/js/attendance.js')?>"></script>