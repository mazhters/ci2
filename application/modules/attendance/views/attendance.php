<div class="tab-pane active" id="content">
  <div class="row column-seperation">
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
                      <label>Date</label>
                      <div id="datepicker_start" class="input-append date success no-padding">
                        <input type="text" class="form-control" name="start_cuti" required>
                        <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> 
                      </div>
                  </div>
              </div>
              <div class="col-md-1">
                  <label>&nbsp;</label>
                  <b>To</b>
              </div>
              <div class="col-md-3">
                  <div class="row">
                      <label>&nbsp;</label>
                      <div id="datepicker_end" class="input-append date success no-padding">
                          <input type="text" class="form-control" name="end_cuti" required>
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
        foreach($query_list->result_array() as $r)
        {
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
        ?>
        </table>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo assets_url('modules/js/attendance.js')?>"></script>
            