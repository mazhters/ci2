<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_component extends MX_Controller {
	
	var $title = "payroll";
    var $page_title = "Component";
	var $filename = "payroll_component";
	public $data;
	function __construct()
	{
		parent::__construct();
        $this->load->model('payroll_component_model','payroll');
        $this->load->model('all_model','all_model');
	}
	
	function index()
	{
        $this->data['title'] = ucfirst($this->title);
		$this->data['page_title'] = $this->page_title;

        $this->data['component_type'] = $this->payroll->get_component_type();
        $this->data['tax_component'] = $this->payroll->get_tax_component();

        permission();
		$this->_render_page($this->filename, $this->data);
	}

    public function ajax_list()
    {
        $list = $this->payroll->get_datatables();//lastq();//print_mz($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $p_comp) {
            //get component type
            $component_type = $this->all_model->GetValue('title','payroll_component_type','id = '.$p_comp->component_type_id);
            //get tax component
            $tax_component = $this->all_model->getValue('title','payroll_tax_component','id = '.$p_comp->tax_component_id);
            if (!$tax_component) {
                $tax_component = "";
            }
            //status attribute
            if ($p_comp->is_annualized == 1) {
                $is_annualized = "Annualized";
            }else{
                $is_annualized = "Not Annualized";
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $p_comp->title;
            $row[] = $p_comp->code;
            $row[] = $component_type;
            $row[] = $is_annualized;
            $row[] = $tax_component;

             $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0);" username="Edit" onclick="edit_user('."'".$p_comp->id."'".')"><i class="fa fa-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" username="Hapus" onclick="delete_user('."'".$p_comp->id."'".')"><i class="fa fa-trash"></i></a>';
        

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->payroll->count_all(),
                        "recordsFiltered" => $this->payroll->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->payroll->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    public function ajax_add()
    {
        //$this->_validate();
        $data = array(
                'title' => $this->input->post('title'),
                'code' => $this->input->post('code'),
                'component_type_id' => $this->input->post('component_type_id'),
                'is_annualized' => $this->input->post('is_annualized'),
                'tax_component_id' => $this->input->post('tax_component_id'),
                'created_by' => GetUserID(),
                'created_on' => date('Y-m-d H:i:s')
            );
        $insert = $this->payroll->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        //$this->_validate();
        $data = array(
                'title' => $this->input->post('title'),
                'code' => $this->input->post('code'),
                'component_type_id' => $this->input->post('component_type_id'),
                'is_annualized' => $this->input->post('is_annualized'),
                'tax_component_id' => $this->input->post('tax_component_id'),
                'edited_by' => GetUserID(),
                'edited_on' => date('Y-m-d H:i:s')
            );
        $this->payroll->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->payroll->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
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

                if(in_array($view, array($this->filename)))
                {
                    $this->template->set_layout('default');
                    $this->template->add_css('assets/plugins/data-tables/DT_bootstrap.min.css');
                    $this->template->add_css('assets/plugins/bootstrap-select2/select2.css');

                    $this->template->add_js('assets/plugins/data-tables/jquery.dataTables.min.js');
                    $this->template->add_css('assets/plugins/jquery-datatable/css/jquery.dataTables.css');
                    $this->template->add_js('assets/plugins/data-tables/jquery.dataTables.min.js');
                    $this->template->add_js('assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js');
                    $this->template->add_js('assets/plugins/datatables-responsive/js/datatables.responsive.js');
                    $this->template->add_js('modules/js/'.$this->title.'/'.$this->filename.'.js');
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