<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result extends CI_Model {

		function idDevice($limit='',$offset='')
		{
			$deviceId = $this->db->select('id_device, fk_user, status, plant_name, stat_soil_moisture, stat_temperature, stat_humidity, watering_am, watering_pm, weight_c1, weight_c2, weight_c3')->get('devices',$limit='',$offset='');
			/*echo "<pre>";
			// print_r($data['rows']->result());
			print_r($deviceId->result());
			echo "</pre>";*/
			return $deviceId->result();
		}

		function dataTodayById($limit='',$offset='')
		{
			$devices = $this->db->select('id_device, fk_user, status, plant_name, stat_soil_moisture, stat_temperature, stat_humidity, watering_am, watering_pm, weight_c1, weight_c2, weight_c3')->get('devices',$limit='',$offset='')->result();
			foreach ($devices as $value) {
				$dataResult[] = (object) array(
					'id_device' => $value->id_device,
					'fk_user' => $value->fk_user,
					'status' => $value->status,
					'plant_name' => $value->plant_name,
					'stat_soil_moisture' => $value->stat_soil_moisture,
					'stat_temperature' => $value->stat_temperature,
					'stat_humidity' => $value->stat_humidity,
					'watering_am' => $value->watering_am,
					'watering_pm' => $value->watering_pm,
					'weight_c1' => $value->weight_c1,
					'weight_c2' => $value->weight_c2,
					'weight_c3' => $value->weight_c3,
					// 'device' => $devices,
					'saw_result' => $this->db->get_where('saw_result',['fk_device' => $value->id_device, 'watering_time >=' => date('Y-m-d')])->result(), 
					);

			}
			return $dataResult;
			/*echo "<pre>";
			print_r($dataResult);
			echo "</pre>";*/
		}	

}

/* End of file Result.php */
/* Location: ./application/models/Result.php */