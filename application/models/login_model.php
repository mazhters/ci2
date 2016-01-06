<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function cekLogin($username,$userpass)
	{
		$this->db->where("user_nm",$username);
		$this->db->where("pwd1",$userpass);
		$query=$this->db->get("hris_users");
		return $query;
	}

}