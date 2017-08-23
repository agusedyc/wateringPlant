<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Status extends REST_Controller {
	function __construct($config = 'rest') {
        parent::__construct($config);
    }

	function index_get() {
       $data = array(
            'alat'=> $this->get('alat'),
            'suhu'=> number_format($this->get('suhu'),1,'.',''),
            'humiditas'=> number_format($this->get('humiditas'),1,'.',''),
            // 'suhu'=> $this->get('suhu'),
            // 'humiditas'=> $this->get('humiditas'),
            );
       if ($data['suhu']>0 || $data['humiditas']>0) {
            $this->db->trans_start();
            $this->db->insert('sensor', $data);
            $this->db->update('status', $data, array('alat' => $data['alat']));
            $this->db->trans_complete();
            if ($this->db->trans_status()) {
                $this->db->where('alat', $data['alat']);
                $status = $this->db->select('id, alat, suhu, humiditas, kelembaban, siram, created_at, updated_at')->get('status')->row();
                $this->response($status, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
       }
        
    }

    /*function index_get() {
       $alat = $this->get('alat');
        if ($alat == '') {
            $status = $this->db->get('status')->result();
        } else {
            $this->db->where('alat', $alat);
            $status = $this->db->get('status')->row();
        }
        $this->response($status, 200);
    }*/

    function index_post() {
        $data = array(
        			'alat'=> $this->post('alat'),
                    'suhu'=> $this->post('suhu'),
                    'humiditas'=> $this->post('humiditas'),
                    );
        $insert = $this->db->insert('sensor', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */