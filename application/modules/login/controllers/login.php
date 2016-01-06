<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends MX_Controller {
	
	var $title = "Login";
	var $filename = "login";
	public $data;
	function __construct()
	{
		parent::__construct();
        $this->load->model('login_model', 'login');
	}
	
	function index()
	{
        $this->data['message'] = $this->session->flashdata('message');
		$this->data['title'] = $this->title;
		$this->_render_page($this->filename.'/login', $this->data);
	}

    function cek_login()
    {
        $username = $this->input->post("username");
        //$userpass = md5($this->config->item('encryption_key').$this->input->post("password"));
        $userpass = $this->input->post("password");
        
        $query=$this->login->cekLogin($username,$userpass);//lastq();
        //$query2=cekLoginEmployee($username,$userpass);
        if ($query->num_rows() > 0)
        {
            $row = $query->row(); 
            $this->load->library("session");
            $this->session->set_userdata('user_id',$row->user_id);
            $this->session->set_userdata('person_id',$row->person_id);
            redirect('dashboard');
        }
        else
        {
            $this->session->set_flashdata('message', 'incorrect login');
            redirect('login', 'refresh');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
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

                if(in_array($view, array($this->filename.'/login')))
                {
                    $this->template->set_layout('single');

                    $this->template->add_js('modules/js/login.js');
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