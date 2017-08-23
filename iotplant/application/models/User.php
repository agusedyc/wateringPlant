<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

	function setRole($idUser,$role)
	{
		// $role = 'admin';
		$array = array('slug' => $role, 'role_name' => $role);
		$this->db->or_like($array);
		$getRole = $this->db->get('roles');
		
		$roleUser = array(
		'fk_user' => $idUser, 
		'fk_role' => $getRole->row()->id_role,
		);
		$this->db->insert('role_user',$roleUser);
	}	

	function reHash($id='', $hash='', $password='')
	{
		if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
	        // If so, create a new hash, and replace the old one
	        $newHash = password_hash($password, PASSWORD_DEFAULT);
	        $data = array('password' => $newHash);
	        $this->db->update('users', $data, array('id_user' => $id));
	    }
	}

	function isLogin($username,$password)
	{
		$user = $this->db->get_where('users', array('username' => $username));
		if ($user->num_rows()=='1') {
			if (password_verify($password,$user->row()->password)) {
				$this->reHash($user->row()->id_user,$user->row()->password,$password);
				$data = array(
				'role' => $this->User->hasRole($user->row()->id_user)->role_name,
				'slug' => $this->User->hasRole($user->row()->id_user)->slug,
				'username' => $user->row()->username,
				'userId' => $user->row()->id_user,
				'name' => $this->User->hasName($user->row()->id_user),
				'nameId' => $this->User->hasNameId($user->row()->id_user),
				);
				return $data;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function hasRole($idUser)
	{
		// $user = $this->db->get_where('users', array('username' => $username));
		$this->db->select('*');
		$this->db->from('role_user');
		$this->db->join('roles', 'roles.id_role = role_user.fk_role', 'left');
		$this->db->where(array('fk_user' => $idUser));
		$getRole = $this->db->get();
		return $getRole->row();
	}

	function hasName($idUser)
	{
		$role = $this->User->hasRole($idUser)->slug;
		switch ($role) {
		   case 'admin':
		         // return $this->db->get_where('pegawai', array('fk_user' => $idUser))->row()->nama_pegawai;
		   		 return $this->db->get_where('dosen', array('fk_user' => $idUser))->row()->nama_dosen;
		         break;
		   case 'dosen':
		         return $this->db->get_where('dosen', array('fk_user' => $idUser))->row()->nama_dosen;
		         break;
		   case 'mhs':
		         return $this->db->get_where('mahasiswa', array('fk_user' => $idUser))->row()->nama_mhs;
		         break;
		}
	}

	function hasNameId($idUser)
	{
		$role = $this->User->hasRole($idUser)->slug;
		switch ($role) {
		   case 'admin':
		         // return $this->db->get_where('pegawai', array('fk_user' => $idUser))->row()->id_pegawai;
		    	return $this->db->get_where('dosen', array('fk_user' => $idUser))->row()->id_dosen;
		         break;
		   case 'dosen':
		         return $this->db->get_where('dosen', array('fk_user' => $idUser))->row()->id_dosen;
		         break;
		   case 'mhs':
		         return $this->db->get_where('mahasiswa', array('fk_user' => $idUser))->row()->id_mhs;
		         break;
		}
	}

	function allowUsers($role)
	{
		$roles = explode("|", $role);
		if ($this->session->userdata('login')=='1') {
			if (in_array($this->session->userdata('slug'), $roles)) {
				return true;
			}else{
				// redirect('dashboard','refresh');
				$this->logout();
			}
		}else{
			// $this->user->logout();
			$this->logout();
		}
	}

	function available($username)
	{
		$user = $this->db->get_where('users', array('username' => $username))->num_rows();
		if ($user == 1) {
			return true;
		}else{
			return false;
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login','refresh');
	}

	function mhsReg($data='')
	{
		$this->db->trans_start();
		$user = array(
			'username' => $data->username,
			'email' => $data->email,
			'password' => $data->password,
			);
		$this->db->insert('users', $user);

		$id_user = $this->db->insert_id();
		$this->User->setRole($id_user,'mhs');

		$mhs = array(
			'fk_user' => $id_user,
			'nim' => $data->nim, 
			'nama_mhs' => $data->nama_mhs, 
			);
		$this->db->insert('mahasiswa', $mhs);

		$id_mhs = $this->db->insert_id();
		$jurnal = array('fk_mhs' => $id_mhs);
		$this->db->insert('jurnal', $jurnal);
		$this->db->trans_complete();

		return $this->db->trans_status();		
	}

	function register($data,$id_role)
	{
		$this->db->trans_start();
		$user = array(
			'name' => $data->name,
			'username' => $data->username,
			// 'email' => $data->email,
			'password' => password_hash($data->password, PASSWORD_DEFAULT),
			);
		$this->db->insert('users', $user);

		$id_user = $this->db->insert_id();
		$this->setRole($id_user,$id_role);
		$this->db->trans_complete();

		return $this->db->trans_status();		
	}

}

/* End of file User.php */
/* Location: ./application/models/User.php */