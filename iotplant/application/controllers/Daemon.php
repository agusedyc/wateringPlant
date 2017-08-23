<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daemon extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		// Token A a1682c558de345d1b67eb01235e7cb93
		(!is_cli()) ? redirect(404,'refresh') : null ;
		
	}

	// public function index()
	// {
	// 	echo "string";
	// }

	public function dataStatus()
	{
		$now = date("Y-m-d H:i:s");
		$lastIdData = $this->db->select_max('id_sensor')->get('sensor')->row();
		$lastData = $this->db->get_where('sensor', array('id_sensor' => $lastIdData->id_sensor))->row('created_at'); 
		$strNow = strtotime($now);
		$strLastData = strtotime($lastData);
		$diff = $strNow - $strLastData;
		// jika data terlalu lama > 30s false
		// Jika data terlalu cepat < 5s false
		if ($diff > 30) {
			// $this->callRpiNotify();
			// echo "false";
			return false;
		}else{
			if ($diff < 5) {
				return false;
			}else{
				return true;
			}
		}
	}

	public function callRpiNotify($notification='')
	{
		$token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0b2tlbiI6ImFndXNlZHljIn0.4VY9B1aMVTA5tLxz4GV6BgZCk_Z7Mx-0AJXq7v1X7Y4";
		// $notification = "!!! Web Hook Watering Plant IS DOWN !!!";
		$text = str_replace(' ', '%20', $textUnFormat);
		$url = "http://api.rpinotify.it/notification/".$notification."/text/".$text;
		
		$this->getApi($url);
	}

	/**
	cek apakah masuk atau tidak datanya
	jika tidak berarti webhook mati
	pindah ke mode daemon
	jika device online
	jalankan daemon get data

	cek device online
	jika onlen
	cek data web hook 
	jika data tidak masuk
	pindah mode daemon
	*/

	public function actionData($blynkToken='')
	{
		// $i = 0;
		// while ($i < 5) {
			if ($this->dataStatus()==false) {
				// echo "False";
				// $this->getBlynkData($blynkToken);
				// Change to Run Python Script
				// $command = escapeshellcmd("python /home/pi/wateringPlant/command/getDataPython.py $blynkToken");
				$wateringAction = escapeshellcmd("bash /home/pi/wateringPlant/command/wateringActionBash.sh $blynkToken");
				shell_exec($wateringAction);
				$wateringTrigger = escapeshellcmd("bash /home/pi/wateringPlant/command/wateringTriggerBash.sh $blynkToken");
				shell_exec($wateringTrigger);
				$getData = escapeshellcmd("bash /home/pi/wateringPlant/command/getDataBash.sh $blynkToken");
				shell_exec($getData);
				// echo $a;
				// echo "_";
				
				// echo $b;
				// echo "Jalan";	
			}
			// sleep(10);
			// $i++;
		// }
		// set_time_limit(61);
	}

	public function getApi($url='')
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

	public function devicesToken()
	{
		$dataToken = $this->db->select('device_token')->get('devices')->result();
		/*echo "<pre>";
		print_r($dataToken);
		echo "</pre>";	*/	
		return $dataToken;
	}

	public function devicesStatus()
	{
		$tokens = $this->devicesToken();
		foreach ($tokens as $key => $value) {
			$this->actionData($value->device_token);	
			// $status = $this->getApi("http://blynk-cloud.com/$value->device_token/isHardwareConnected");
			// echo $status;
			// echo "<br>";
			// if ($status=="true") {
				// Devices On
				// jika sudah nyala jangan di jalankan lagi Bashnya;
				// Update : Permintaan diatas sudah di handel script bash
				// Bukan tidak di jalankan, tetapi dibatalkan perintah GETnya
				// $this->actionData($value->device_token);	
				// $this->db->update('devices', array('status' => '1'), array('device_token' => $value->device_token));
			// }else{
				// $this->db->update('devices', array('status' => '0'), array('device_token' => $value->device_token));
			// }		
		}
	}

}

/* End of file Daemon.php */
/* Location: ./application/controllers/Daemon.php */