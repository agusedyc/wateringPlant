<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tanaman extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('result');
	}
	
	public function index()
	{
		// $this->User->allowUsers('admin');
		/*$this->db->select();
		$this->db->from('devices');
		$this->db->join('saw_result', 'saw_result.fk_device = devices.id_device');
		$this->db->where('watering_time ==', date("Y-m-d"));
		$join = $this->db->get();
*/
		$page = $this->data->page($this->db->get('devices')->num_rows());	
		$data = array(
			'title' => "Data Tanaman",
			'form' => "Tambah Data Tanaman",
			'table' => "Data Semua Tanaman",
			// 'dd' => ['Aktif','Tidak'],
			// 'watering' => $this->db->get_where('devices',['id_device' => $id_device, 'watering_time >=' => date("Y-m-d"),])->row(),
			// 'rows' => $this->db->select('id_device, fk_user, status, plant_name, stat_soil_moisture, stat_temperature, stat_humidity, watering_am, watering_pm, weight_c1, weight_c2, weight_c3')->get('devices',$page->limit,$page->offset),
			'rows' => $this->result->dataTodayById($page->limit, $page->offset),
			'pagination' => $this->pagination->create_links(),
			'no' => $page->number,
			);
		// echo "<pre>";
		// print_r($data['rows']);
		// echo "</pre>";
		$this->template->admin('admin/dataTanaman',$data);
	}

	public function select()
	{
		// $this->User->allowUsers('admin');
		$id_device = $this->uri->segment(3);
		$page = $this->data->page($this->db->get('devices')->num_rows());	
		
		$data = array(
			'title' => "Data Tanaman",
			'form' => "Update Data Tanaman",
			'table' => "Data Semua Tanaman",
			// 'dd' => $this->Data->dropDown($selectDosen->row()->status,['Aktif','Tidak']),
			'row' => $this->db->get_where('devices',['id_device' => $id_device])->row(),
			'rows' => $this->result->dataTodayById($page->limit, $page->offset),
			'pagination' => $this->pagination->create_links(),
			'no' => $page->number,
			);
		/*echo "<pre>";
		print_r($selectDosen->row());
		echo "</pre>";*/
		$this->template->admin('admin/dataTanaman',$data);
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

}

/* End of file Penyiram.php */
/* Location: ./application/controllers/Penyiram.php */