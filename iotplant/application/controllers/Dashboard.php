<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
			
	}

	public function admin($value='')
	{
		// $this->User->allowUsers('admin');
		$data = array(
			'title' => 'Dashboard Admin', 
			);
		$this->template->admin('admin/dashAdmin',$data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */