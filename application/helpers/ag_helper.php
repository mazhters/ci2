<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('permission')){
	function permission()
	{
		$CI =& get_instance();
		if(!$CI->session->userdata("user_id")){
			redirect("login");
		}
		
		return $CI->session->userdata("user_id");
	}
}