<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Model {

	function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

	/*function all($table,$limit=null,$offset=null)
	{
		return $this->db->get($table, $limit, $offset);
	}*/
	
	function page($numRow,$perPage=10,$segment=4)
	{
		$baseUrl = array(
			$this->uri->segment(1),
			$u2 = (empty($this->uri->segment(2))) ? "index" : $this->uri->segment(2),
			$u3 = (empty($this->uri->segment(3))) ? "hal" : $this->uri->segment(3),
			// $u4 = (empty($this->uri->segment(4))) ? "" : "",
			// $u5 = (empty($this->uri->segment(5))) ? "" : $this->uri->segment(5)
			);
		$config['base_url'] = site_url($baseUrl);
		$config['total_rows'] = $numRow;
		$config['per_page'] = $perPage;
		$config['uri_segment'] = $segment;

		$config['num_links'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

		$this->pagination->initialize($config);
		/*Penomoran Pagination*/
		$offset = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
		$offset2 = ($offset*$config['per_page'])-$config['per_page'];
		if ($offset2<0) {
			$offset2=0;
		}else{
			$offset2;
		}
		/*Akhir Penomoran Pagination*/

		// $data['data'] = $this->db->get($table, $config['per_page'], $offset2);
		$data['limit'] = $config['per_page'];
		$data['offset'] = $offset2;

		// $data['per'] = $config['per_page'];
	    // $data['noi'] = $offset;
	     if ($offset==0) {
            $offset=1;
        }else{
             $no=0;
        }
        $no=($offset*$config['per_page'])-$config['per_page'];

		$data['number'] = $no;
	    // $data['pagination'] = $this->pagination->create_links();
	    return (object) $data;
	}

	function dropDown($search,$data)
	{
		// $dta = array('Aktif', 'Tidak');
		// $x = 'Aktif';
		$cri =  array_search($search, $data);
		if ($cri !== false) {
		    unset($data[$cri]);
		    return (object) $data;
		    // print_r($dta);
		}
	}

	function dropDownMulti($search,$data,$filed)
	{
		foreach ($data as $key => $val) {
	       if ($val[$filed] === $search) {
	           // return $key;
	       	unset($data[$key]);
	       	/*echo "<pre>";
		print_r($val);
		echo "<br>";
		echo "</pre>";*/
	       }
	   }
	   return $data;
	}

	function validation($item, $value,$redirect)
	{
		if ($this->form_validation->run() == FALSE) {
			// Data Salah
			$valid = array('notif' => validation_errors());
			$flash = (object) array_merge($valid,$value);	
			$this->session->set_flashdata($item, $flash);
			redirect($redirect,'refresh');
			break;
		}/*else{
			// Data benar
			return true;
		}*/
	}

}

/* End of file GetData.php */
/* Location: ./application/models/GetData.php */