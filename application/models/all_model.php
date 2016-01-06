<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_model extends CI_Model {

	function GetAll($tbl,$filter=array(),$order=NULL,$by="asc")
	{
		foreach($filter as $key=> $value)
		{
			$exp = explode("/",$value);
			
			if($exp[1] >= 0)
			{
				if($exp[0] == "where") $this->db->where($key, $exp[1]);
				else if($exp[0] == "like") $this->db->like($key, $exp[1]);
				else if($exp[0] == "where_or") $this->db->where($exp[1]);
				else if($exp[0] == "limit") $this->db->limit($key, $exp[1]);
			}
		}
		if($order) $this->db->order_by($order, $by);
		$query = $this->db->get($tbl);
		
		return $query->result_array();
	}

	function GetRow($tbl,$filter=array(),$order=NULL,$by="asc")
	{
		foreach($filter as $key=> $value)
		{
			$exp = explode("/",$value);
			
			if($exp[1] >= 0)
			{
				if($exp[0] == "where") $this->db->where($key, $exp[1]);
				else if($exp[0] == "like") $this->db->like($key, $exp[1]);
				else if($exp[0] == "where_or") $this->db->where($exp[1]);
				else if($exp[0] == "limit") $this->db->limit($key, $exp[1]);
			}
		}
		if($order) $this->db->order_by($order, $by);
		$query = $this->db->get($tbl);
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return FALSE;
		}
		
		
	}
	
	function GetAllRecord($tbl,$filter=array())
	{
		foreach($filter as $key=> $value)
		{
			$exp = explode("/",$value);
			
			if($exp[1] >= 0)
			{
				if($exp[0] == "where") $this->db->where($key, $exp[1]);
				else if($exp[0] == "like") $this->db->like($key, $exp[1]);
				else if($exp[0] == "where_or") $this->db->where($exp[1]);
			}
		}
		$query = $this->db->get($tbl);
		
		return $query->num_rows();
	}
	
	function CekTotalRecord($tbl,$primary,$id)
	{
		$this->db->where($primary, $id);
		$query = $this->db->get($tbl);
		return $query->num_rows();
	}
	
	function GetList($tbl,$field_order,$filter,$start_limit=0,$limit,$asc="desc")
	{
		foreach($filter as $key=> $value)
		{
			$exp = explode("/",$value);
			if($exp[1])
			{
				if($exp[0] == "where") $this->db->where($key, $exp[1]);
				else if($exp[0] == "like") $this->db->like($key, $exp[1]);
				else if($exp[0] == "where_or") $this->db->where($exp[1]);
			}
		}
		
		$this->db->limit($limit,$start_limit);
		
		$ex_ord = explode("/", $field_order);
		foreach($ex_ord as $ord)
		{
			$this->db->order_by($ord, $asc);
		}
		$query = $this->db->get($tbl);
		
		return $query->result_array();
	}
	
	function GetById($tbl,$primary,$id)
	{
		$this->db->where($primary, $id);
		$query = $this->db->get($tbl);
		return $query->result_array();
	}
	
	function GetValue($field,$table,$where)
	{
		$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;
		$query = $this->db->query($sql);
		foreach($query->result_array() as $r)
		{
			return $r[$field];
		}
		return false;
	}

	function DeleteWhere($table,$where){
		$this->db->delete($table,$where);

		return true;
	}

	function Insert($table,$data) {
		$this->db->insert($table, $data);

		return $this->db->insert_id();
	}

	function Update($table,$data,$where) {
		$this->db->update($table, $data, $where);

		return $this->db->affected_rows();
	}

}

/* End of file all_model.php */
/* Location: ./application/models/all_model.php */