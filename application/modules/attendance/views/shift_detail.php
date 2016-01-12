<div class="grid simple transparent">
	<div class="grid-title">
		<h4>List <span class="semi-bold">Attendance</span></h4></a>
		<div class="actions">
			<a href="javascript:void(0);" onclick="backShift('<?php echo $periode;?>')"><i class='fa fa-chevron-circle-left'></i> Back</a>
		</div>
	</div>
</div>

<div class="col-md-6">
    <div class="row">
        <div class="tiles white col-md-12  no-padding">         
            <div class="tiles-body">
                <div class="row">
                  <div class="col-md-3">
                      <div class="">
                          <img width="100" height="100" src="<?php echo assets_url('assets/img/profiles/photo-default.png')?>" data-src="<?php echo assets_url('assets/img/profiles/photo-default.png')?>" data-src-retina="<?php echo assets_url('assets/img/profiles/photo-default.png')?>" alt="">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <span class="semi-bold">Name</span>
                  </div>
                  <div class="col-md-4">
                      <span class="semi-bold">: <?php echo $person_nm;?></span>
                  </div>
                  <br/><br/>
                  <div class="col-md-4">
                      <span class="semi-bold">Period</span>
                  </div>
                  <div class="col-md-4">
                      <span class="semi-bold">: <?php echo urldecode($periode);?></span>
                  </div>
                  <br/><br/>
                  <div class="col-md-4">
                      <span class="semi-bold">Group</span>
                  </div>
                  <div class="col-md-4">
                      <span class="semi-bold">: <?php echo $group;?></span>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="form_edit_shift" action="attendance/shift_update" method="post" enctype="multipart/form-data">
<table class="table table-striped">
	<?php 
		echo form_hidden("id", isset($val["id"]) ? $val["id"] : 0);
		echo form_hidden("id_employee", $val['id_employee']);
		echo form_hidden("bulan", $val['bulan']);
		echo form_hidden("tahun", $val['tahun']);
		$jml_hari = date("t", mktime(0, 0, 0, $val['bulan'], 1, $val['tahun']));
		$loop=round($jml_hari/2);
	?>
	<?php for($a=1;$a<=$loop;$a++)
  {
  	$b=$a+$loop;
  	if(!isset($tgl['tgl_'.$a])) $tgl['tgl_'.$a]="";
  	if(!isset($tgl['tgl_'.$a])) $tgl['tgl_'.$a]="";
		?>
		<tr>
			<td>
				<div class="row">
					<div class="col-md-3 bold">Tanggal <?php echo $a?></div>
					<div class="col-md-8">
						<div class="radio radio-primary"> 
							<input type="radio" id="1_<?php echo $a?>" name="tgl_<?php echo $a?>" value="1" <?php if($tgl['tgl_'.$a]=='1') echo "checked";?>><label for="1_<?php echo $a;?>">Pagi</label>
							<input type="radio" id="2_<?php echo $a?>" name="tgl_<?php echo $a?>" value="2" <?php if($tgl['tgl_'.$a]=='2') echo "checked";?>><label for="2_<?php echo $a;?>">Siang</label>
							<input type="radio" id="3_<?php echo $a?>" name="tgl_<?php echo $a?>" value="3" <?php if($tgl['tgl_'.$a]=='3') echo "checked";?>><label for="3_<?php echo $a;?>">Malam</label><br>
							<input type="radio" id="off_<?php echo $a?>" name="tgl_<?php echo $a?>" value="off" <?php if($tgl['tgl_'.$a]=='off') echo "checked";?>><label for="off_<?php echo $a;?>">OFF</label>
							<input type="radio" id="ns_<?php echo $a?>" name="tgl_<?php echo $a?>" value="ns" <?php if($tgl['tgl_'.$a]=='ns') echo "checked";?>><label for="ns_<?php echo $a;?>">Non Shift</label>
							<!--<input type="checkbox" name="separo[]" value="<?php echo $a?>" <?php if(isset($separo[$a])) echo "checked";?>> Lembur 1/2&nbsp;&nbsp;
							<input type="checkbox" name="pts[]" value="<?php echo $a?>" <?php if(isset($pts[$a])) echo "checked";?>> Lembur Putus-->
						</div>
					</div>
				</div>
			</td>
			
			<?php if($b <= $jml_hari) {?>
			<td>
				<div class="row">
					<div class="col-md-3 bold">Tanggal <?php echo $b?></div>
					<div class="col-md-8">
						<div class="radio radio-primary"> 
							<input type="radio" id="1_<?php echo $b?>" name="tgl_<?php echo $b?>" value="1" <?php if($tgl['tgl_'.$b]=='1') echo "checked";?>><label for="1_<?php echo $b;?>">Pagi</label>
							<input type="radio" id="2_<?php echo $b?>" name="tgl_<?php echo $b?>" value="2" <?php if($tgl['tgl_'.$b]=='2') echo "checked";?>><label for="2_<?php echo $b;?>">Siang</label>
							<input type="radio" id="3_<?php echo $b?>" name="tgl_<?php echo $b?>" value="3" <?php if($tgl['tgl_'.$b]=='3') echo "checked";?>><label for="3_<?php echo $b;?>">Malam</label><br>
							<input type="radio" id="off_<?php echo $b?>" name="tgl_<?php echo $b?>" value="off" <?php if($tgl['tgl_'.$b]=='off') echo "checked";?>><label for="off_<?php echo $b;?>">OFF</label>
							<input type="radio" id="ns_<?php echo $b?>" name="tgl_<?php echo $b?>" value="ns" <?php if($tgl['tgl_'.$b]=='ns') echo "checked";?>><label for="ns_<?php echo $b;?>">Non Shift</label>
							<!--<input type="checkbox" name="separo[]" value="<?php echo $b?>" <?php if(isset($separo[$b])) echo "checked";?>> Lembur 1/2&nbsp;&nbsp;
							<input type="checkbox" name="pts[]" value="<?php echo $b?>" <?php if(isset($pts[$b])) echo "checked";?>> Lembur Putus-->
						</div>
					</div>
				</div>
			</td>
			<?php }?>
		</tr>
		<?php 
	}
	?>
</table>
</form>

<div class="clearfix_button pull-right">
	<button type="submit" class="btn btn-success btn-submit-shift">&nbsp;Submit</button>
	<br><br><br>
</div>

<script src="<?php echo assets_url('modules/js/attendance.js')?>"></script>