<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class attendance extends MX_Controller {
	
	var $title = "Attendance";
    var $filename = "attendance";
	public $data;
	function __construct()
	{
		parent::__construct();
        $this->lang->load('attendance');
	}
	
	function index()
	{
        $data['title'] = $this->title;
        permission();
		$this->_render_page('index', $data);
	}

    function list_attendance($user="0",$tgl="0000-00-00",$dep="0",$shift="0",$status="0")
    {
        $data['user'] = $user;
        //$data['path_file'] = $this->filename.'_user_migrasi';
        $data['path_file'] = $this->filename.'_user';
        $data['main_content'] = $data['path_file'];
        $data['filename'] = $this->filename;
        $data['title'] = $this->title;
        //if($user == 0 && $tgl == "0000-00-00" && !$this->uri->segment(5)) $tgl = date("Y-m-d");
        $data['tgl'] = $tgl;
        $exp = explode("~", $tgl);
        $data['tgl_today'] = $exp[0];
        if($exp[0] != "0000-00-00")
        {
            $data['start_date'] = $exp[0];
            if(!isset($exp[1])) $data['end_date'] = $exp[0];
            else if(!$exp[1]) $data['end_date'] = $exp[0];
            else $data['end_date'] = $exp[1];
        }
        else $data['start_date']=$data['end_date']="";
        $data['shift'] = $shift;
        
        /* Mazhters */
        if($exp[0]==date("Y-m-d")) $tabel_view="kg_view_kehadiran_rutin";
        else $tabel_view="kg_view_kehadiran_mcci";
        /* End Mazhters */
        
        $path_paging = base_url().$this->filename."/main/".$user."/".$tgl."/".$dep."/".$shift."/".$status;
        $uri_segment = 8;
        $pg = $this->uri->segment($uri_segment);
        /*riza*/
        $filter = array($tabel_view.".tahun"=> "order/asc", $tabel_view.".bulan"=> "order/asc", $tabel_view.".tanggal"=> "order/asc");
        $per_page=500;
        //End Global
        
        $filter_where_in=array();
        $data['opt_pic'] = GetOptPIC();
        $data['opt_pic'][''] = "";
        $data['opt_dep'] = GetOptDepartment();
        //$data['opt_dep'][''] = "";
        $data['opt_tgl'] = GetOptDate();
        $data['opt_bln'] = GetOptMonth();
        $data['opt_thn'] = GetOptYear();
        
        $exp = explode("-",$exp[0]);
        if(!isset($exp[0])) $exp[0] = "";
        if(!isset($exp[1])) $exp[1] = "";
        if(!isset($exp[2])) $exp[2] = "";
        
        //if($exp[2] > 0) $filter = array("tahun"=> "order/asc", "bulan"=> "order/asc", "tanggal"=> "order/asc");
        //else $filter = array("id_employee"=> "order/asc", "tahun"=> "order/asc", "bulan"=> "order/asc", "tanggal"=> "order/asc");
        
        if($status)
        {
            /*if($status == "alpa2")
            {
                $kemarin = date("Y-m-d", mktime(0, 0, 0, $exp[1], $exp[2]-1, $exp[0]));
                $exp_alpa = explode("-", $kemarin);
                $filter["alpa"] = "where/1";
            }
            else */
            if($status == "jh") $filter['terlambat !='] = "where/1";
            $filter[$status] = "where/1";
        }
        
        $kondisi="";
        if($status == "alpa2")
        {
            $tgl_alpa=array($exp[2], $exp_alpa[2]);
            $filter_where_in['tanggal'] = $tgl_alpa;
            
            $bln_alpa=array($exp[1], $exp_alpa[1]);
            $filter_where_in['bulan'] = $bln_alpa;
            
            $thn_alpa=array($exp[0], $exp_alpa[0]);
            $filter_where_in['tahun'] = $thn_alpa;
        }
        else
        {
            if($data['start_date'] == $data['end_date'])
            {
                if($exp[0] > 0)
                {
                    $filter[$tabel_view.'.tahun'] = "where/".$exp[0];$data['title'] = $this->title." ( ".$exp[0]." )";
                    if($exp[1] > 0)
                    {
                        $filter[$tabel_view.'.bulan'] = "where/".$exp[1];$data['title'] = $this->title." ( ".GetMonth(intval($exp[1]))." ".$exp[0]." )";
                        if($exp[2] > 0){$filter[$tabel_view.'.tanggal'] = "where/".$exp[2];$data['title'] = $this->title." ( ".$exp[2]." ".GetMonth(intval($exp[1]))." ".$exp[0]." )";}
                    }
                }
                else if($exp[1] > 0)
                {
                    $exp[0] = date("Y");
                    $filter['tahun'] = "where/".$exp[0];
                    $filter['bulan'] = "where/".$exp[1];$data['title'] = $this->title." ( ".GetMonth(intval($exp[1]))." ".$exp[0]." )";
                    if($exp[2] > 0){$filter['tanggal'] = "where/".$exp[2];$data['title'] = $this->title." ( ".$exp[2]." ".GetMonth(intval($exp[1]))." ".$exp[0]." )";}
                }
                else if($exp[2] > 0)
                {
                    $exp[0] = date("Y");$exp[1]=date("m");
                    $filter['tahun'] = "where/".$exp[0];
                    $filter['bulan'] = "where/".$exp[1];
                    $filter['tanggal'] = "where/".$exp[2];$data['title'] = $this->title." ( ".$exp[2]." ".GetMonth(intval($exp[1]))." ".$exp[0]." )";
                }
            }
        }
        
        if($dep)
        {
            /*$ex = explode("-",$dep);
            $dep=array();
            foreach($ex as $r)
            {
                $dep[] = $r;
            }
            $filter_where_in['id_department'] = $dep;*/
            $filter['id_department'] = "where/".$dep;
        }
        //else $dep=array();
        
        if($user)
        {
            $temp_user=$user;
            $ex = explode("-",$user);
            $user=array();
            foreach($ex as $r)
            {
                $user[] = $r;
            }
            $filter_where_in['id_employee'] = $user;
            $user=$temp_user;
        }
        //else $user=array();

        $data['spic'] = $user;
        $data['sdep'] = $dep;
        /*$data['stgl'] = $exp[2];
        $data['sbln'] = $exp[1];
        $data['sthn'] = $exp[0];*/
        
        //Grup Admin
        $id_grup = $this->session->userdata("webmaster_grup");
        $where = "";
        if($id_grup == 4) $filter['nik'] = "where/-";
        //else if($id_grup == 3) $filter['urut_position <'] = "where/40";
        //else if($id_grup == 2) $filter['urut_position >='] = "where/40";
        //End
        //$filter['urut_position'] = "order/asc";
        $filter[$tabel_view.'.id_employee'] = "order/asc";

        //if(count($user) > 0 || $exp[2] > 0)
        if(($exp[2] > 0 && ($data['start_date'] == $data['end_date'])) || $user)
        {
            $data['flag_tgl']=1;
            $data['grid'] = array("Nama Karyawan","Tanggal","Hadir","OFF","Cuti","Ijin","PHL","Sakit","Alpa","PG","Terlambat","Scan Masuk", "Scan Pulang", "Keterangan");
            $data['list'] = array("id_employee","tgl","jh","off","cuti","ijin","phl","sakit","alpa","potong_gaji","terlambat","scan_masuk", "scan_pulang", "keterangan");
            if($status == "alpa2")
            {
                $sql = "select * from ".$tabel_view." where tanggal='".$exp[2]."' AND bulan='".$exp[1]."' AND tahun='".$exp[0]."' AND alpa='1'
                AND id_employee in (select id_employee from ".$tabel_view." where tanggal='".$exp_alpa[2]."' AND bulan='".$exp_alpa[1]."' AND tahun='".$exp_alpa[0]."' AND alpa='1')";
                $data['query_all'] = $this->db->query($sql);
                if(!$pg) $pg=0;
                $data['query_list'] = $this->db->query($sql." LIMIT $pg, $per_page");
            }
            else
            {
                if($data['start_date'])
                {
                    $filter['date_full >='] = "where/".$data['start_date'];
                    $filter['date_full <='] = "where/".$data['end_date'];
                }
                
                if($shift) {
                    //if($shift == "p") $where_shift = " (kg_jadwal_shift.tgl_".intval($exp[2])."='".$shift."' || kg_jadwal_shift.tgl_".intval($exp[2])."='ns')";
                    if($shift == "p") $where_shift = " (kg_jadwal_shift.tgl_".intval($exp[2])."!='s' && kg_jadwal_shift.tgl_".intval($exp[2])."!='m')";
                    else $where_shift = " kg_jadwal_shift.tgl_".intval($exp[2])."='".$shift."' ";
                    $data['query_all'] = GetJoin($tabel_view, "jadwal_shift", "kg_jadwal_shift.id_employee=".$tabel_view.".id_employee and kg_jadwal_shift.bulan='".$exp[1]."' and kg_jadwal_shift.tahun='".$exp[0]."' and $where_shift", "inner", "*", $filter, $filter_where_in);
                    $filter['limit'] = $pg."/".$per_page;                   
                    $data['query_list'] = GetJoin($tabel_view, "jadwal_shift", "kg_jadwal_shift.id_employee=".$tabel_view.".id_employee and kg_jadwal_shift.bulan='".$exp[1]."' and kg_jadwal_shift.tahun='".$exp[0]."' and $where_shift", "inner", "*,".$tabel_view.".id as id_k", $filter, $filter_where_in);

                } else {
                    $data['query_all'] = GetAll($tabel_view, $filter, $filter_where_in);
                    $filter['limit'] = $pg."/".$per_page;
                    $data['query_list'] = GetAll($tabel_view, $filter, $filter_where_in);
                }
            }
        }
        else
        {
            /*$temp = $filter['id_employee'];
            unset($filter['id_employee']);
            $filter['id_employee'] = $temp;
            $temp = $filter['tanggal'];
            unset($filter['tanggal']);
            $filter['tanggal'] = $temp;
            $temp = $filter['bulan'];
            unset($filter['bulan']);
            $filter['bulan'] = $temp;
            $temp = $filter['tahun'];
            unset($filter['tahun']);
            if($temp == "order/asc") $temp = "where/".date("Y");
            $filter['tahun'] = $temp;*/
            if($data['start_date'])
            {
                $filter['date_full >='] = "where/".$data['start_date'];
                $filter['date_full <='] = "where/".$data['end_date'];
            }
            $data['flag_tgl']=0;
            $data['grid'] = array("Nama Karyawan","JHK","Hadir","OFF","Cuti","PHL","Ijin","Sakit","Alpa","Potong Gaji","Pulang Cepat");
            $data['list'] = array("person_nm","jhk","jh","off","cuti","phl","ijin","sakit","alpa","potong_gaji","pc");
            /*if($exp[1] > 0) $filter['group'] = array("employee.id","bulan","tahun");
            elseif($exp[0] > 0) $filter['group'] = array("employee.id","tahun");
            else */
            //$filter['group'] = array("employee.id","tahun");
            $filter['id_employee'] = "group";
            //else $filter['group'] = array("employee.id");
            /*$select = "employee.id as a_id,employee.name, kg_attendance.id, SUM(kg_attendance.jhk) as jhk, SUM(kg_attendance.sakit) as sakit,
            SUM(kg_attendance.cuti) as cuti,SUM(kg_attendance.ijin) as ijin,,SUM(kg_attendance.alpa) as alpa,SUM(kg_attendance.off) as off,
            SUM(kg_attendance.potong_gaji) as potong_gaji, SUM(kg_attendance.pc) as pc,SUM(kg_attendance.jh) as jh";
            $data['query_all'] = GetJoin("employee","attendance","attendance.id_employee=employee.id ".$kondisi, "left", $select, $filter, $filter_where_in);*/
            $select = "id, person_nm, id_employee as a_id, SUM(jhk) as jhk, SUM(sakit) as sakit,
            SUM(cuti) as cuti,SUM(ijin) as ijin,SUM(phl) as phl,SUM(alpa) as alpa,SUM(off) as off,
            SUM(potong_gaji) as potong_gaji, SUM(pc) as pc, SUM(jh) as jh";
            $data['query_all'] = GetAllSelect($tabel_view, $select, $filter);
            //lastq();
            $filter['limit'] = $pg."/".$per_page;
            //$data['query_list'] = GetJoin("employee","attendance","attendance.id_employee=employee.id ".$kondisi, "left", $select, $filter, $filter_where_in);
            $data['query_list'] = GetAllSelect($tabel_view, $select, $filter);
            //die($this->db->last_query());
        }
        
        if(!$this->uri->segment(3) && !$this->uri->segment(4) && !$this->uri->segment(5)) $data['dis_tgl'] = "display:none;";
        else $data['dis_tgl'] = "display:''";
        
        //Page
        $pagination = Page($data['query_all']->num_rows(),$per_page,$pg,$path_paging,$uri_segment);
        if(!$pagination) $pagination = "<strong>1</strong>";
        $data['pagination'] = $pagination;
        //End Page

        $this->load->view('attendance', $data);
    }

    function detail($user="0",$tgl="0000-00-00",$dep="0",$shift="0",$status="0")
    {
        $data['user'] = $user;
        //$data['path_file'] = $this->filename.'_user_migrasi';
        $data['path_file'] = $this->filename.'_user';
        $data['main_content'] = $data['path_file'];
        $data['filename'] = $this->filename;
        $data['title'] = $this->title;
        //if($user == 0 && $tgl == "0000-00-00" && !$this->uri->segment(5)) $tgl = date("Y-m-d");
        $data['tgl'] = $tgl;
        $exp = explode("~", $tgl);
        $data['tgl_today'] = $exp[0];
        if($exp[0] != "0000-00-00")
        {
            $data['start_date'] = $exp[0];
            if(!isset($exp[1])) $data['end_date'] = $exp[0];
            else if(!$exp[1]) $data['end_date'] = $exp[0];
            else $data['end_date'] = $exp[1];
        }
        else $data['start_date']=$data['end_date']="";
        $data['shift'] = $shift;
        
        /* Mazhters */
        if($exp[0]==date("Y-m-d")) $tabel_view="kg_view_kehadiran_rutin";
        else $tabel_view="kg_view_kehadiran_mcci";
        /* End Mazhters */
        
        $path_paging = base_url().$this->filename."/main/".$user."/".$tgl."/".$dep."/".$shift."/".$status;
        $uri_segment = 8;
        $pg = $this->uri->segment($uri_segment);
        /*riza*/
        $filter = array($tabel_view.".tahun"=> "order/asc", $tabel_view.".bulan"=> "order/asc", $tabel_view.".tanggal"=> "order/asc");
        $per_page=500;
        //End Global
        
        $filter_where_in=array();
        $data['opt_pic'] = GetOptPIC();
        $data['opt_pic'][''] = "";
        $data['opt_dep'] = GetOptDepartment();
        //$data['opt_dep'][''] = "";
        $data['opt_tgl'] = GetOptDate();
        $data['opt_bln'] = GetOptMonth();
        $data['opt_thn'] = GetOptYear();
        
        $exp = explode("-",$exp[0]);
        if(!isset($exp[0])) $exp[0] = "";
        if(!isset($exp[1])) $exp[1] = "";
        if(!isset($exp[2])) $exp[2] = "";
        
        //if($exp[2] > 0) $filter = array("tahun"=> "order/asc", "bulan"=> "order/asc", "tanggal"=> "order/asc");
        //else $filter = array("id_employee"=> "order/asc", "tahun"=> "order/asc", "bulan"=> "order/asc", "tanggal"=> "order/asc");
        
        if($status)
        {
            /*if($status == "alpa2")
            {
                $kemarin = date("Y-m-d", mktime(0, 0, 0, $exp[1], $exp[2]-1, $exp[0]));
                $exp_alpa = explode("-", $kemarin);
                $filter["alpa"] = "where/1";
            }
            else */
            if($status == "jh") $filter['terlambat !='] = "where/1";
            $filter[$status] = "where/1";
        }
        
        $kondisi="";
        if($status == "alpa2")
        {
            $tgl_alpa=array($exp[2], $exp_alpa[2]);
            $filter_where_in['tanggal'] = $tgl_alpa;
            
            $bln_alpa=array($exp[1], $exp_alpa[1]);
            $filter_where_in['bulan'] = $bln_alpa;
            
            $thn_alpa=array($exp[0], $exp_alpa[0]);
            $filter_where_in['tahun'] = $thn_alpa;
        }
        else
        {
            if($data['start_date'] == $data['end_date'])
            {
                if($exp[0] > 0)
                {
                    $filter[$tabel_view.'.tahun'] = "where/".$exp[0];$data['title'] = $this->title." ( ".$exp[0]." )";
                    if($exp[1] > 0)
                    {
                        $filter[$tabel_view.'.bulan'] = "where/".$exp[1];$data['title'] = $this->title." ( ".GetMonth(intval($exp[1]))." ".$exp[0]." )";
                        if($exp[2] > 0){$filter[$tabel_view.'.tanggal'] = "where/".$exp[2];$data['title'] = $this->title." ( ".$exp[2]." ".GetMonth(intval($exp[1]))." ".$exp[0]." )";}
                    }
                }
                else if($exp[1] > 0)
                {
                    $exp[0] = date("Y");
                    $filter['tahun'] = "where/".$exp[0];
                    $filter['bulan'] = "where/".$exp[1];$data['title'] = $this->title." ( ".GetMonth(intval($exp[1]))." ".$exp[0]." )";
                    if($exp[2] > 0){$filter['tanggal'] = "where/".$exp[2];$data['title'] = $this->title." ( ".$exp[2]." ".GetMonth(intval($exp[1]))." ".$exp[0]." )";}
                }
                else if($exp[2] > 0)
                {
                    $exp[0] = date("Y");$exp[1]=date("m");
                    $filter['tahun'] = "where/".$exp[0];
                    $filter['bulan'] = "where/".$exp[1];
                    $filter['tanggal'] = "where/".$exp[2];$data['title'] = $this->title." ( ".$exp[2]." ".GetMonth(intval($exp[1]))." ".$exp[0]." )";
                }
            }
        }
        
        if($dep)
        {
            /*$ex = explode("-",$dep);
            $dep=array();
            foreach($ex as $r)
            {
                $dep[] = $r;
            }
            $filter_where_in['id_department'] = $dep;*/
            $filter['id_department'] = "where/".$dep;
        }
        //else $dep=array();
        
        if($user)
        {
            $temp_user=$user;
            $ex = explode("-",$user);
            $user=array();
            foreach($ex as $r)
            {
                $user[] = $r;
            }
            $filter_where_in['id_employee'] = $user;
            $user=$temp_user;
        }
        //else $user=array();

        $data['spic'] = $user;
        $data['sdep'] = $dep;
        /*$data['stgl'] = $exp[2];
        $data['sbln'] = $exp[1];
        $data['sthn'] = $exp[0];*/
        
        //Grup Admin
        $id_grup = $this->session->userdata("webmaster_grup");
        $where = "";
        if($id_grup == 4) $filter['nik'] = "where/-";
        //else if($id_grup == 3) $filter['urut_position <'] = "where/40";
        //else if($id_grup == 2) $filter['urut_position >='] = "where/40";
        //End
        //$filter['urut_position'] = "order/asc";
        $filter[$tabel_view.'.id_employee'] = "order/asc";

        //if(count($user) > 0 || $exp[2] > 0)
        if(($exp[2] > 0 && ($data['start_date'] == $data['end_date'])) || $user)
        {
            $data['flag_tgl']=1;
            $data['grid'] = array("Tanggal","Hadir","OFF","Cuti","Ijin","PHL","Sakit","Alpa","PG","Terlambat","Scan Masuk", "Scan Pulang", "Keterangan");
            $data['list'] = array("tgl","jh","off","cuti","ijin","phl","sakit","alpa","potong_gaji","terlambat","scan_masuk", "scan_pulang", "keterangan");
            if($status == "alpa2")
            {
                $sql = "select * from ".$tabel_view." where tanggal='".$exp[2]."' AND bulan='".$exp[1]."' AND tahun='".$exp[0]."' AND alpa='1'
                AND id_employee in (select id_employee from ".$tabel_view." where tanggal='".$exp_alpa[2]."' AND bulan='".$exp_alpa[1]."' AND tahun='".$exp_alpa[0]."' AND alpa='1')";
                $data['query_all'] = $this->db->query($sql);
                if(!$pg) $pg=0;
                $data['query_list'] = $this->db->query($sql." LIMIT $pg, $per_page");
            }
            else
            {
                if($data['start_date'])
                {
                    $filter['date_full >='] = "where/".$data['start_date'];
                    $filter['date_full <='] = "where/".$data['end_date'];
                }
                
                if($shift) {
                    //if($shift == "p") $where_shift = " (kg_jadwal_shift.tgl_".intval($exp[2])."='".$shift."' || kg_jadwal_shift.tgl_".intval($exp[2])."='ns')";
                    if($shift == "p") $where_shift = " (kg_jadwal_shift.tgl_".intval($exp[2])."!='s' && kg_jadwal_shift.tgl_".intval($exp[2])."!='m')";
                    else $where_shift = " kg_jadwal_shift.tgl_".intval($exp[2])."='".$shift."' ";
                    $data['query_all'] = GetJoin($tabel_view, "jadwal_shift", "kg_jadwal_shift.id_employee=".$tabel_view.".id_employee and kg_jadwal_shift.bulan='".$exp[1]."' and kg_jadwal_shift.tahun='".$exp[0]."' and $where_shift", "inner", "*", $filter, $filter_where_in);
                    $filter['limit'] = $pg."/".$per_page;                   
                    $data['query_list'] = GetJoin($tabel_view, "jadwal_shift", "kg_jadwal_shift.id_employee=".$tabel_view.".id_employee and kg_jadwal_shift.bulan='".$exp[1]."' and kg_jadwal_shift.tahun='".$exp[0]."' and $where_shift", "inner", "*,".$tabel_view.".id as id_k", $filter, $filter_where_in);

                } else {
                    $data['query_all'] = GetAll($tabel_view, $filter, $filter_where_in);
                    $filter['limit'] = $pg."/".$per_page;
                    $data['query_list'] = GetAll($tabel_view, $filter, $filter_where_in);
                }
            }
        }
        else
        {
            /*$temp = $filter['id_employee'];
            unset($filter['id_employee']);
            $filter['id_employee'] = $temp;
            $temp = $filter['tanggal'];
            unset($filter['tanggal']);
            $filter['tanggal'] = $temp;
            $temp = $filter['bulan'];
            unset($filter['bulan']);
            $filter['bulan'] = $temp;
            $temp = $filter['tahun'];
            unset($filter['tahun']);
            if($temp == "order/asc") $temp = "where/".date("Y");
            $filter['tahun'] = $temp;*/
            if($data['start_date'])
            {
                $filter['date_full >='] = "where/".$data['start_date'];
                $filter['date_full <='] = "where/".$data['end_date'];
            }
            $data['flag_tgl']=0;
            $data['grid'] = array("Nama Karyawan","JHK","Hadir","OFF","Cuti","PHL","Ijin","Sakit","Alpa","Potong Gaji","Pulang Cepat");
            $data['list'] = array("person_nm","jhk","jh","off","cuti","phl","ijin","sakit","alpa","potong_gaji","pc");
            /*if($exp[1] > 0) $filter['group'] = array("employee.id","bulan","tahun");
            elseif($exp[0] > 0) $filter['group'] = array("employee.id","tahun");
            else */
            //$filter['group'] = array("employee.id","tahun");
            $filter['id_employee'] = "group";
            //else $filter['group'] = array("employee.id");
            /*$select = "employee.id as a_id,employee.name, kg_attendance.id, SUM(kg_attendance.jhk) as jhk, SUM(kg_attendance.sakit) as sakit,
            SUM(kg_attendance.cuti) as cuti,SUM(kg_attendance.ijin) as ijin,,SUM(kg_attendance.alpa) as alpa,SUM(kg_attendance.off) as off,
            SUM(kg_attendance.potong_gaji) as potong_gaji, SUM(kg_attendance.pc) as pc,SUM(kg_attendance.jh) as jh";
            $data['query_all'] = GetJoin("employee","attendance","attendance.id_employee=employee.id ".$kondisi, "left", $select, $filter, $filter_where_in);*/
            $select = "id, person_nm, id_employee as a_id, SUM(jhk) as jhk, SUM(sakit) as sakit,
            SUM(cuti) as cuti,SUM(ijin) as ijin,SUM(phl) as phl,SUM(alpa) as alpa,SUM(off) as off,
            SUM(potong_gaji) as potong_gaji, SUM(pc) as pc, SUM(jh) as jh";
            $data['query_all'] = GetAllSelect($tabel_view, $select, $filter);
            //lastq();
            $filter['limit'] = $pg."/".$per_page;
            //$data['query_list'] = GetJoin("employee","attendance","attendance.id_employee=employee.id ".$kondisi, "left", $select, $filter, $filter_where_in);
            $data['query_list'] = GetAllSelect($tabel_view, $select, $filter);
            //die($this->db->last_query());
        }
        
        if(!$this->uri->segment(3) && !$this->uri->segment(4) && !$this->uri->segment(5)) $data['dis_tgl'] = "display:none;";
        else $data['dis_tgl'] = "display:''";
        
        //Page
        $pagination = Page($data['query_all']->num_rows(),$per_page,$pg,$path_paging,$uri_segment);
        if(!$pagination) $pagination = "<strong>1</strong>";
        $data['pagination'] = $pagination;
        //End Page
        
        
        $this->_render_page($this->filename.'_detail', $data);
    }

    function overtime($user="0",$tgl="0000-00-00",$dep="0",$status="0")
    {
        //Set Global
        permission();
        $data['filename'] = 'overtime';
        $data['title'] = 'Overtime';
        //if($user == 0 && $tgl == "0000-00-00" && !$this->uri->segment(5)) $tgl = date("Y-m-d");
        $data['tgl'] = $tgl;
        $exp = explode("~", $tgl);
        if($exp[0] != "0000-00-00")
        {
            $data['start_date'] = $exp[0];
            if(!isset($exp[1])) $data['end_date'] = $exp[0];
            else if(!$exp[1]) $data['end_date'] = $exp[0];
            else $data['end_date'] = $exp[1];
        }
        else $data['start_date']=$data['end_date']="";
        
        $path_paging = base_url().$this->filename."/main/".$user."/".$tgl."/".$dep."/".$status;
        $uri_segment = 7;
        $pg = $this->uri->segment($uri_segment);
        $per_page=15;
        //End Global
        
        $filter_where_in=array();
        $data['opt_pic'] = GetOptPIC();
        $data['opt_pic'][''] = "";
        $data['opt_dep'] = GetOptDepartment();
        //$data['opt_dep'][''] = "";
        $data['opt_tgl'] = GetOptDate();
        $data['opt_bln'] = GetOptMonth();
        $data['opt_thn'] = GetOptYear();
        
        $exp = explode("-",$exp[0]);
        if(!isset($exp[0])) $exp[0] = "";
        if(!isset($exp[1])) $exp[1] = "";
        if(!isset($exp[2])) $exp[2] = "";
        
        //if($exp[2] > 0) $filter = array("tahun"=> "order/asc", "bulan"=> "order/asc", "tanggal"=> "order/asc");
        //else $filter = array("id_employee"=> "order/asc", "tahun"=> "order/asc", "bulan"=> "order/asc", "tanggal"=> "order/asc");
        
        //Grup Admin
        $id_grup = $this->session->userdata("webmaster_grup");
        if($id_grup == 3) $filter['urut_position <'] = "where/40";
        
        if($status)
        {
            /*if($status == "alpa2")
            {
                $kemarin = date("Y-m-d", mktime(0, 0, 0, $exp[1], $exp[2]-1, $exp[0]));
                $exp_alpa = explode("-", $kemarin);
                $filter["alpa"] = "where/1";
            }
            else */
            if($status == "jh") $filter['terlambat !='] = "where/1";
            $filter[$status] = "where/1";
        }
        
        $kondisi="";
        if($status == "alpa2")
        {
            $tgl_alpa=array($exp[2], $exp_alpa[2]);
            $filter_where_in['tanggal'] = $tgl_alpa;
            
            $bln_alpa=array($exp[1], $exp_alpa[1]);
            $filter_where_in['bulan'] = $bln_alpa;
            
            $thn_alpa=array($exp[0], $exp_alpa[0]);
            $filter_where_in['tahun'] = $thn_alpa;
        }
        else
        {
            if($data['start_date'] == $data['end_date'])
            {
                if($exp[0] > 0)
                {
                    $filter['tahun'] = "where/".$exp[0];$data['title'] = $this->title." ( ".$exp[0]." )";
                    if($exp[1] > 0)
                    {
                        $filter['bulan'] = "where/".$exp[1];$data['title'] = $this->title." ( ".GetMonth(intval($exp[1]))." ".$exp[0]." )";
                        if($exp[2] > 0){$filter['tanggal'] = "where/".$exp[2];$data['title'] = $this->title." ( ".$exp[2]." ".GetMonth(intval($exp[1]))." ".$exp[0]." )";}
                    }
                }
                else if($exp[1] > 0)
                {
                    $exp[0] = date("Y");
                    $filter['tahun'] = "where/".$exp[0];
                    $filter['bulan'] = "where/".$exp[1];$data['title'] = $this->title." ( ".GetMonth(intval($exp[1]))." ".$exp[0]." )";
                    if($exp[2] > 0){$filter['tanggal'] = "where/".$exp[2];$data['title'] = $this->title." ( ".$exp[2]." ".GetMonth(intval($exp[1]))." ".$exp[0]." )";}
                }
                else if($exp[2] > 0)
                {
                    $exp[0] = date("Y");$exp[1]=date("m");
                    $filter['tahun'] = "where/".$exp[0];
                    $filter['bulan'] = "where/".$exp[1];
                    $filter['tanggal'] = "where/".$exp[2];$data['title'] = $this->title." ( ".$exp[2]." ".GetMonth(intval($exp[1]))." ".$exp[0]." )";
                }
            }
        }
        
        if($dep)
        {
            /*$ex = explode("-",$dep);
            $dep=array();
            foreach($ex as $r)
            {
                $dep[] = $r;
            }
            $filter_where_in['id_department'] = $dep;*/
            $filter['id_department'] = "where/".$dep;
        }
        //else $dep=array();
        
        if($user)
        {
            $temp_user=$user;
            $ex = explode("-",$user);
            $user=array();
            foreach($ex as $r)
            {
                $user[] = $r;
            }
            $filter_where_in['id_employee'] = $user;
            $user=$temp_user;
            if($data['start_date'])
            {
                $filter['date_full >='] = "where/".$data['start_date'];
                $filter['date_full <='] = "where/".$data['end_date'];
            }
        }
        //else $user=array();

        $data['spic'] = $user;
        $data['sdep'] = $dep;
        /*$data['stgl'] = $exp[2];
        $data['sbln'] = $exp[1];
        $data['sthn'] = $exp[0];*/
        
        $filter['name'] = "order/asc";
        $filter['lembur'] = "where/1";
        //if(count($user) > 0 || $exp[2] > 0)
        if(($exp[2] > 0 && ($data['start_date'] == $data['end_date'])) || $user)
        {
            $data['flag_tgl']=1;
            $data['grid'] = array("Nama Karyawan","Tanggal","OT. Incidental","Kelebihan Jam Kerja","Tunjangan Hari Kerja","Alasan Lembur","Scan Masuk","Scan Pulang","Keterangan");
            $data['list'] = array("id_employee","tgl","ot_incidental","ot_allow_shift","ot_cont_allow","alasan_lembur","scan_masuk","scan_pulang","keterangan");
            if($status == "alpa2")
            {
                $sql = "select * from kg_view_kehadiran where tanggal='".$exp[2]."' AND bulan='".$exp[1]."' AND tahun='".$exp[0]."' AND alpa='1'
                AND id_employee in (select id_employee from kg_view_kehadiran where tanggal='".$exp_alpa[2]."' AND bulan='".$exp_alpa[1]."' AND tahun='".$exp_alpa[0]."' AND alpa='1')";
                $data['query_all'] = $this->db->query($sql);
                if(!$pg) $pg=0;
                $data['query_list'] = $this->db->query($sql." LIMIT $pg, $per_page");
                
            }
            else
            {
                $data['query_all'] = GetAll("kg_view_kehadiran", $filter, $filter_where_in);
                $filter['limit'] = $pg."/".$per_page;
                $data['query_list'] = GetAll("kg_view_kehadiran", $filter, $filter_where_in);
                //lastq();
            }
        }
        else
        {
            /*$temp = $filter['id_employee'];
            unset($filter['id_employee']);
            $filter['id_employee'] = $temp;
            $temp = $filter['tanggal'];
            unset($filter['tanggal']);
            $filter['tanggal'] = $temp;
            $temp = $filter['bulan'];
            unset($filter['bulan']);
            $filter['bulan'] = $temp;
            $temp = $filter['tahun'];
            unset($filter['tahun']);
            if($temp == "order/asc") $temp = "where/".date("Y");
            $filter['tahun'] = $temp;*/
            if($data['start_date'])
            {
                $filter['date_full >='] = "where/".$data['start_date'];
                $filter['date_full <='] = "where/".$data['end_date'];
            }
            $data['flag_tgl']=0;
            $data['grid'] = array("Nama Karyawan","Overtime","OT. Incidental","Kelebihan Jam Kerja","Tunjangan Hari Kerja");
            $data['list'] = array("name","jhk","ot_incidental","ot_allow_shift","ot_cont_allow");
            /*if($exp[1] > 0) $filter['group'] = array("employee.id","bulan","tahun");
            elseif($exp[0] > 0) $filter['group'] = array("employee.id","tahun");
            else */
            //$filter['group'] = array("employee.id","tahun");
            $filter['id_employee'] = "group";
            //else $filter['group'] = array("employee.id");
            /*$select = "employee.id as a_id,employee.name, kg_kehadirandetil.id, SUM(kg_kehadirandetil.jhk) as jhk, SUM(kg_kehadirandetil.sakit) as sakit,
            SUM(kg_kehadirandetil.cuti) as cuti,SUM(kg_kehadirandetil.ijin) as ijin,,SUM(kg_kehadirandetil.alpa) as alpa,SUM(kg_kehadirandetil.off) as off,
            SUM(kg_kehadirandetil.potong_gaji) as potong_gaji, SUM(kg_kehadirandetil.pc) as pc,SUM(kg_kehadirandetil.jh) as jh";
            $data['query_all'] = GetJoin("employee","kehadirandetil","kehadirandetil.id_employee=employee.id ".$kondisi, "left", $select, $filter, $filter_where_in);*/
            $select = "id, name, id_employee as a_id, SUM(jhk) as jhk, SUM(ot_incidental) as ot_incidental,
            SUM(ot_allow_shift) as ot_allow_shift,SUM(ot_cont_allow) as ot_cont_allow";
            $data['query_all'] = GetAllSelect("kg_view_kehadiran", $select, $filter);
            //lastq();
            $filter['limit'] = $pg."/".$per_page;
            //$data['query_list'] = GetJoin("employee","kehadirandetil","kehadirandetil.id_employee=employee.id ".$kondisi, "left", $select, $filter, $filter_where_in);
            $data['query_list'] = GetAllSelect("kg_view_kehadiran", $select, $filter);
            //die($this->db->last_query());
        }
        
        if(!$this->uri->segment(3) && !$this->uri->segment(4) && !$this->uri->segment(5)) $data['dis_tgl'] = "display:none;";
        else $data['dis_tgl'] = "display:''";
        
        //Page
        $pagination = Page($data['query_all']->num_rows(),$per_page,$pg,$path_paging,$uri_segment);
        if(!$pagination) $pagination = "<strong>1</strong>";
        $data['pagination'] = $pagination;
        //End Page
        $this->load->view('overtime', $data);
    }

    function shift($dep=0,$period=0)
    {
        $this->data['title'] = $this->title;
        permission();
        $data['path_file'] = $this->filename;
        permissionkaryawan($this->session->userdata('webmaster_id'), $data['path_file']);
        $data['main_content'] = $data['path_file'];
        $data['filename'] = $this->filename;
        $data['title'] = $this->title;
        
        $path_paging = base_url().$this->filename."/main/".$dep."/".$period;
        $uri_segment = 5;
        $pg = $this->uri->segment($uri_segment);
        $per_page=15;
        //End Global
        
        //$data['opt_pic'] = GetOptPIC();
        $data['opt_pic'][''] = "";
        $data['opt_dep'] = GetOptDepartment();
        //$data['opt_dep'][''] = "";
        
        
        
        $filter = array("id_employee"=> "order/asc");
        $filter_where_in = array();
        /*if($user)
        {
            $exp = explode("-",$user);
            $user=array();
            foreach($exp as $r)
            {
                $user[] = $r;
            }
            $filter_where_in['id'] = $user;
        }
        else $user=array();*/
        
        if($dep && $dep!="-")
        {
            $exp = explode("-",$dep);
            $dep=array();
            foreach($exp as $r)
            {
                $dep[] = $r;
            }
            $filter_where_in['id_department'] = $dep;
        }
        else $dep=array();
        if($period)
        {
            $filter['bulan'] = "where/".substr($period,0,2);
            $filter['tahun'] = "where/".substr($period,3,4);
            $period=$period;
        }
        else $period=NULL;
        
        $data['dep']=$dep;
        $data['period']=$period;
        
        $data['grid'] = array("Nama","Departemen","Bulan","Shift Pagi","Shift Sore","Shift Malam","Non Shift","Off");
        $data['query_all'] = GetAll('kg_view_jadwal_shift', $filter, $filter_where_in);
        $filter['limit'] = $pg."/".$per_page;
        $data['query_list'] = GetAll('kg_view_jadwal_shift', $filter, $filter_where_in);
        $data['list'] = array("employee","title","bulan","jum_p","jum_s","jum_m","jum_ns","jum_off");
        //lastq();
        //Page
        $pagination = Page($data['query_all']->num_rows(),$per_page,$pg,$path_paging,$uri_segment);
        if(!$pagination) $pagination = "<strong>1</strong>";
        $data['pagination'] = $pagination;
        //End Page
        /*  $data['grid_export'] = array("Nama","No Employee", "Jabatan", "Departement", "Date Of Joint", "Status", "Jenis Kelamin","Tanggal Lahir", "Keluarga", "Riwayat Pendidikan", "Riwayat Kerja", "Riwayat Training", "Riwayat Medis");
            $data['query_list_export'] = GetAll($this->tabel, array("id !="=> "where/1"));
            $data['list_export'] = array("name","nip","id_jabatan","id_kedeputian","tgl_aktif","status_pernikahan","gender","ttl","keluarga","pendidikan","riwayatkerja","training","medis");
            
            $data['main_content'] = "hris/personal_export";
            $html = $this->load->view("template_export",$data);
            to_excel($html,str_replace(" ","_",$this->title));*/
        $this->load->view('shift', $data);
    }

    function edit($dep=NULL,$tgl="2012-01-01",$user=1,$id=0,$flag=NULL)
    {
        $data['tes'] = 'tes';
        $data['absensi'] = array('Hadir',
                                  'OFF',
                                  'Hari Raya',
                                  'Cuti',
                                  'PHL',
                                  'Izin',
                                  'SKD',
                                  'Opname',
                                  'S2',
                                  'KK',
                                  'Alpa',
                                  'Terlambat',
                                  'Potong Gaji',
                                  'Pulang Cepat',
            );
        
        $this->_render_page($this->filename.'_edit',$data);
    }

	function _render_page($view, $data=null, $render=false)
    {
        // $this->viewdata = (empty($data)) ? $this->data: $data;
        // $view_html = $this->load->view($view, $this->viewdata, $render);
        // if (!$render) return $view_html;
        $data = (empty($data)) ? $this->data : $data;
        if ( ! $render)
        {
            $this->load->library('template');

                if(in_array($view, array('index', 'attendance_edit')))
                {
                    $this->template->set_layout('default');

                    $this->template->add_css('assets/plugins/bootstrap-select2/select2.css');
                    $this->template->add_css('assets/plugins/bootstrap-datepicker/css/datepicker.css');
                    $this->template->add_css('assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css');

                    $this->template->add_js('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js');
                    $this->template->add_js('assets/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js');
                    $this->template->add_js('modules/js/'.$this->filename.'.js');
                }

            if ( ! empty($data['title']))
            {
                $this->template->set_title($data['title']);
            }

            $this->template->load_view($view, $data);
        }
        else
        {
            return $this->load->view($view, $data, TRUE);
        }
    }
}
?>