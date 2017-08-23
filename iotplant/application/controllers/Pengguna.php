<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('user','data');
	}
	
	public function index()
	{
		// $this->User->allowUsers('admin');
		$page = $this->data->page($this->db->get('users')->num_rows());	

		$this->db->select('*');
		$this->db->from('role_user','users','roles');
		$this->db->join('roles', 'role_user.fk_role = roles.id_role');
		$this->db->join('users', 'role_user.fk_user = users.id_user');
		// $this->db->where(['id_user' => $id_user]);
		$this->db->limit($page->limit,$page->offset);
		$dataPenyiram =$this->db->get();

		
		$data = array(
			'title' => "Data Pengguna",
			'form' => "Tambah Data Pengguna",
			'table' => "Data Semua Pengguna",
			'dd' => $this->db->select('id_role, role_name')->get('roles')->result_array(),
			// 'watering' => $this->db->get_where('devices',['id_device' => $id_device, 'watering_time >=' => date("Y-m-d"),])->row(),
			'rows' => $dataPenyiram,
			'pagination' => $this->pagination->create_links(),
			'no' => $page->number,
			);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		$this->template->admin('penyiram/dataPenyiram',$data);
	}

	public function select()
	{
		// $this->User->allowUsers('admin');
		$id_user = $this->uri->segment(3);
		$page = $this->data->page($this->db->get('users')->num_rows());	

		// $this->db->select('id_role,role_name,id_user,name,username');
		$this->db->select('*');
		$this->db->from('role_user','users','roles');
		$this->db->join('roles', 'role_user.fk_role = roles.id_role');
		$this->db->join('users', 'role_user.fk_user = users.id_user');
		$this->db->where(['id_user' => $id_user]);
		$selectpenyiram =$this->db->get();
		// unset($query['created_at','updated_at']);

		$this->db->select('*');
		$this->db->from('role_user','users','roles');
		$this->db->join('roles', 'role_user.fk_role = roles.id_role');
		$this->db->join('users', 'role_user.fk_user = users.id_user');
		// $this->db->where(['id_user' => $id_user]);
		$this->db->limit($page->limit,$page->offset);
		$dataPenyiram =$this->db->get();
		
		$data = array(
			'title' => "Data Pengguna",
			'form' => "Update Data Pengguna",
			'table' => "Data Semua Pengguna",
			'dd' => $this->data->dropDownMulti($selectpenyiram->row()->fk_role,$this->db->select('id_role, role_name')->get('roles')->result_array(),'id_role'),
			'row' => $selectpenyiram->row(),
			'rows' => $dataPenyiram,
			'pagination' => $this->pagination->create_links(),
			'no' => $page->number,
			);
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
		$this->template->admin('penyiram/dataPenyiram',$data);
	}

	public function update()
	{
		// $this->User->allowUsers('admin');
		$data = $this->input->post();
		// $flash = array(
		// 	'type' => 'danger',
		// 	'input' => (object) $data,
		// 	);
		// $this->Data->validation('dataDosen',$flash,'dosen/select/'.$data['id_dosen']);

		if (!empty($data['password'])) {
			$user = array(
			'name' => $data['name'],
			'username' => $data['username'],
			'password' => password_hash($data['password'], PASSWORD_DEFAULT),
			);
			$this->db->update('users', $user, array('id_user' => $data['id_user']));
			$this->db->update('role_user',['fk_role' => $data['role']],['fk_user' => $data['id_user']]);
		}else{
			$user = array(
			'name' => $data['name'],
			'username' => $data['username'],
			// 'password' => password_hash($data['password'], PASSWORD_DEFAULT),
			);
			$this->db->update('users', $user, array('id_user' => $data['id_user']));
			$this->db->update('role_user',['fk_role' => $data['role']],['fk_user' => $data['id_user']]);
		}

		redirect($this->uri->segment(1),'refresh');
		echo "<pre>";
		print_r($user);
		echo "</pre>";
	}

	public function add()
	{
		// $this->User->allowUsers('admin');				
		$data = (object) $this->input->post();
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		// $flash = array(
		// 	'type' => 'danger',
		// 	'input' => (object) $data,
		// 	);
		// $this->Data->validation('dataDosen',$flash,$this->uri->segment(1));
		
		$this->user->register($data,$data->role);
		
		/*echo "<pre>";
		print_r($user);
		echo "<br>";
		print_r($dosen);
		echo "</pre>";*/

		redirect($this->uri->segment(1),'refresh');
	}

}

/* End of file Pengguna.php */
/* Location: ./application/controllers/Pengguna.php */