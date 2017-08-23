<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devices extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		// $this->User->allowUsers('admin');
		$page = $this->data->page($this->db->get('devices')->num_rows());	
		$data = array(
			'title' => "Data Alat",
			'form' => "Tambah Data Alat",
			'table' => "Data Semua Alat",
			// 'dd' => ['Aktif','Tidak'],
			// 'watering' => $this->db->get_where('devices',['id_device' => $id_device, 'watering_time >=' => date("Y-m-d"),])->row(),
			'rows' => $this->db->select('id_device, fk_user, name, device, device_token, status')->get('devices',$page->limit,$page->offset),
			'pagination' => $this->pagination->create_links(),
			'no' => $page->number,
			);
		// echo "<pre>";
		// print_r($data['rows']->result());
		// echo "</pre>";
		$this->template->admin('admin/dataDevices',$data);
	}

	public function select()
	{
		// $this->User->allowUsers('admin');
		$id_device = $this->uri->segment(3);
		$page = $this->data->page($this->db->get('devices')->num_rows());	
		
		$data = array(
			'title' => "Data Alat",
			'form' => "Update Data Alat",
			'table' => "Data Semua Alat",
			// 'dd' => $this->Data->dropDown($selectDosen->row()->status,['Aktif','Tidak']),
			'row' => $this->db->get_where('devices',['id_device' => $id_device])->row(),
			'rows' => $this->db->get('devices',$page->limit,$page->offset),
			'pagination' => $this->pagination->create_links(),
			'no' => $page->number,
			);
		/*echo "<pre>";
		print_r($selectDosen->row());
		echo "</pre>";*/
		$this->template->admin('admin/dataDevices',$data);
	}

	public function update()
	{
		// $this->User->allowUsers('admin');
		$data = $this->input->post();
		/*$flash = array(
			'type' => 'danger',
			'input' => (object) $data,
			);
		$this->Data->validation('dataDosen',$flash,'dosen/select/'.$data['id_dosen']);
		*/
		unset($data['id_device']);
		$this->db->update('devices', $data, array('id_device' => $this->input->post('id_device')));
		redirect($this->uri->segment(1),'refresh');
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
	}

	public function add()
	{
		# code...
	}

	public function history()
	{
		
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */