<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
// Token a1682c558de345d1b67eb01235e7cb93
class Sensor extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		
	}

	public function index()
	{
        $this->benchmark->mark('code_start');
		$date = $this->map(strtotime('2017-06-24 03:15:58'),strtotime('2017-06-24 07:00:00'),strtotime('2017-06-24 00:59:59'),strtotime('2017-06-24 01:00:00'),strtotime('2017-06-24 03:00:00'));
		echo $x = date("Y-m-d H:i:s",$date);
        $this->benchmark->mark('code_end');
        echo "<br>";
        echo $this->benchmark->elapsed_time('code_start', 'code_end');
	}

	public function get()
	{	
			// $getDeviceToken = $this->uri->segment(3);
			// if (!empty($getDeviceToken)) {
				$client = new \GuzzleHttp\Client();
				$headers = ['User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36'];
				$jsonData = $client->request('GET', 'http://blynk-cloud.com/a1682c558de345d1b67eb01235e7cb93/get/V0',$headers)->getBody();
				$responseData = json_decode($jsonData);

				echo "<pre>";
				print_r($responseData);
				echo "</pre>";
			// } else {
			// 	echo "Gagal dapat Token";
			// }
			
			

			$data = array(
	            'device_token'=> $getDeviceToken,
	            'soil_moisture'=> number_format($responseData['0'],2,'.',''),
	            'temperature'=> number_format($responseData['1'],2,'.',''),
	            'humidity'=> number_format($responseData['2'],2,'.',''),
	            'dht_temp'=> number_format($responseData['3'],2,'.',''),
	            );
	       // $idDevice = $this->db->get_where('devices', array('device_token' => $data['device_token']))->row('id');
	            
	       if ($data['temperature'] >= 0 && $data['humidity'] >= 0) {
	            $this->db->trans_start();
	            $idDevice = $this->db->get_where('devices', array('device_token' => $data['device_token']))->row('id');
	            if ($idDevice) {
	                    $dataDevice = array(
	                    'stat_soil_moisture' => $data['soil_moisture'],
	                    'stat_temperature' => $data['temperature'],
	                    'stat_humidity' => $data['humidity'],
	                    );
	                $this->db->update('devices', $dataDevice, array('id' => $idDevice));
	                $dataSensor = array(
	                    'fk_device'=> $idDevice,
	                    'soil_moisture' => $data['soil_moisture'],
	                    'temperature'=> number_format($this->get('temperature'),2,'.',''),
	                    'humidity'=> number_format($this->get('humidity'),2,'.',''),
	                );
	                $this->db->insert('sensor', $dataSensor);
	                $this->db->trans_complete();
	            }

	            if ($this->db->trans_status()) {
	                // $this->db->where('alat', $data['alat']);
	                // $status = $this->db->select('id, alat, suhu, humiditas, kelembaban, siram, created_at, updated_at')->get('status')->row();
	                // $this->response(array('status' => 'success'), 200);
	                echo "Berhasil";
	            } else {
	                // $this->response(array('status' => 'fail', 502));
	                echo "Gagal";
	            }
	       }	


		// '{"id": 1420053, "name": "guzzle", ...}'
	}

	function map($value, $fromLow, $fromHigh, $toLow, $toHigh) {
        $fromRange = $fromHigh - $fromLow;
        $toRange = $toHigh - $toLow;
        $scaleFactor = $toRange / $fromRange;

        // Re-zero the value within the from range
        $tmpValue = $value - $fromLow;
        // Rescale the value to the to range
        $tmpValue *= $scaleFactor;
        // Re-zero back to the to range
        return $tmpValue + $toLow;
    }



	public function checkTime()
    {
    	$tokenDevice = $this->uri->segment(3);
    	(empty($tokenDevice)) ? redirect('/','refresh') : null ;
        $date = date("Y-m-d H:i:s"); 
        // $date = "2017-06-21 17:16:18";
        $statusDevice = $this->db->get_where('devices', array('device_token' => $tokenDevice))->row();
       
        $am =  $statusDevice->watering_am;
        $ama = explode(' - ', $am)['0'];
        $amb = explode(' - ', $am)['1'];

        $pm =  $statusDevice->watering_pm;
        $pma = explode(' - ', $pm)['0'];
        $pmb = explode(' - ', $pm)['1'];

        // Get 2 Hours After AM
        $amb_start = date("Y-m-d")." ".$amb.":00";
        $amb_end = date('Y-m-d H:i:s',strtotime('+2 hour',strtotime($amb_start)));
        $array_amb = array(
        	'created_at >=' => $amb_start, 
        	'created_at <=' => $amb_end,
        	'fk_device' => $statusDevice->id_device,
        	);

        $get_amb = $this->db->select('id_sensor,c1,c2,c3')->where($array_amb)->get('sensor')->result();

        // Get 2 Hours before PM
        $pma_end = date("Y-m-d")." ".$pma.":00";
        $pma_start = date('Y-m-d H:i:s',strtotime('-2 hour',strtotime($pma_end)));
        $array_pma = array(
        	'created_at >=' => $pma_start, 
        	'created_at <=' => $pma_end,
        	'fk_device' => $statusDevice->id_device,
        	);
        $get_pma = $this->db->select('id_sensor,c1,c2,c3')->where($array_pma)->get('sensor')->result();
        // Merge data After AM and before PM
        $merge_amb_pma = array_merge($get_amb,$get_pma);
        $max = max($merge_amb_pma);

        $weight = $this->getWeighting($tokenDevice);

        foreach ($merge_amb_pma as $dt_pm) {
        	// echo $dt_pm->c1;
        	$rangking = round((($dt_pm->c1/$max->c1)*$weight->c1)+(($dt_pm->c2/$max->c2)*$weight->c2)+(($dt_pm->c3/$max->c3)*$weight->c3),3);
			$dataRank[] = array(
				'id_sensor' => $dt_pm->id_sensor,
				'rangking' => $rangking,
				'created_at' => $this->db->get_where('sensor',array('id_sensor'=>$dt_pm->id_sensor))->row('created_at'),
				'watering_pm' => date("Y-m-d H:i:s",$this->map(strtotime($this->db->get_where('sensor',array('id_sensor'=>$dt_pm->id_sensor))->row('created_at')),strtotime($amb_start),strtotime($pma_end),strtotime($pma),strtotime($pmb))),
				);
        }

        echo "<pre>";
        print_r($max);
        echo "<br>";
        print_r($weight);
         echo "<br>";
        print_r(max($dataRank));
        echo "<br>";
        print_r($date);
        echo "<br>";
        print_r($amb_start);
        echo "<br>";
        print_r($amb_end);
        echo "<br>";
        print_r($pma_start);
        echo "<br>";
        print_r($pma_end);
        echo "<br>";
        print_r($am);
        echo "<br>";
        print_r($ama);
        echo "<br>";
        print_r($amb);
        echo "<br>";
        print_r($pm);
        echo "<br>";
        print_r($pma);
        echo "<br>";
        print_r($pmb);
        echo "<br>";
        print_r($merge_amb_pma);
        echo "<br>";
        print_r($max);
        echo "</pre>";
    }

    public function getWeighting($tokenDevice = '')
    {
    	$getWeight = $this->db->select('weight_c1,weight_c2,weight_c3')->get_where('devices', array('device_token' => $tokenDevice))->row();
    	$weightPercent = (object) array(
    		'c1' => $getWeight->weight_c1 / 100, 
    		'c2' => $getWeight->weight_c2 / 100, 
    		'c3' => $getWeight->weight_c3 / 100, 
    		);
    	return $weightPercent;
    	 /*echo "<pre>";
        print_r($getWeight);
        echo "<br>";
        print_r($weightPercent);
        // echo "<br>";
        // print_r($max);
        echo "</pre>";*/
    }

}

/* End of file Sensor.php */
/* Location: ./application/controllers/Sensor.php */