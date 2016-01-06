<div class="tab-pane" id="tab1FollowUs">
  <div class="row">
    <div class="col-md-12">
      <form id="<?php echo $filename;?>">
                  <h3><?php echo $title;?></h3>
                  <table class="table table-striped table-hover">
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
                        else if($r[$s] == 1 && $flag_tgl) $r[$s] = "<img src='".base_url()."assets/images/1.gif'>";
                        else if($flag_tgl) $r[$s]="";
                        echo "<td>".$r[$s]."</td>";
                      }
                      if(!$r['id']) $r['id']=0;
                      if(permissionaction()){
                        echo "<td class='action'>";
                        if($flag_tgl) echo "<a href='".site_url($path_file.'/detail/'.$dep.'/'.$tgl.'/'.$r['a_id'].'/'.$r['id'])."'>Edit</a> | ";
                        echo "<a href='".site_url($path_file.'/main/'.$r['a_id'].'/'.$tgl)."'>Detail</a>";
                        echo "</td>";
                      }
                      echo "</tr>";
                    }
                    ?>
                  </table>
                  <br><br>
                  <div class="clear"></div>
                  <div class="pagination">
                    <ul>
                      <?php echo $pagination;?>
                    </ul>
                  </div>
                  <div class="tombol">
                    <?php if(permissionaction()){?>
                    <input type="button" value="Upload Kehadiran" alt="Upload Kehadiran" title="Upload Kehadiran" class="btn" onClick="javascript:window.location='<?php echo site_url("kehadirandetil/upload");?>'"/>
                      <?php if($flag_tgl) {?>
                      <input type="button" value="Delete>" alt="Delete>" title="Delete>" class="delete_button btn" disabled/>
                      <input type="button" value="Add" alt="Add" title="Add" class="btn" onClick="javascript:window.location='<?php echo base_url().$path_file;?>/detail/0';"/>
                      <?php }?>
                    <?php }?>
                  </div>
                </form>
    </div>
  </div>
</div>