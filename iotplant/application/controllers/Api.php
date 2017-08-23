<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Api extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_get($dtoken='',$smois='',$temp='',$hum='',$dhttemp='') {
        $data = array(
            'device_token'=> $dtoken,
            'soil_moisture'=> number_format($smois,2,'.',''),
            'temperature'=> number_format($dhttemp,2,'.',''),
            // 'temperature'=> number_format($this->get('temperature'),2,'.',''),
            'humidity'=> number_format($hum,2,'.',''),
            // 'dht_temp'=> number_format($this->get('dht_temp'),2,'.',''),
            );

       /*$data = array(
            'device_token'=> $this->get('device_token'),
            'soil_moisture'=> number_format($this->get('soil_moisture'),2,'.',''),
            'temperature'=> number_format($this->get('dht_temp'),2,'.',''),
            // 'temperature'=> number_format($this->get('temperature'),2,'.',''),
            'humidity'=> number_format($this->get('humidity'),2,'.',''),
            // 'dht_temp'=> number_format($this->get('dht_temp'),2,'.',''),
            );*/

       // $idDevice = $this->db->get_where('devices', array('device_token' => $data['device_token']))->row('id');
            
       if ($data['temperature'] >= 0 && $data['humidity'] >= 0) {
            $this->db->trans_start();
            $idDevice = $this->db->get_where('devices', array('device_token' => $data['device_token']))->row('id_device');
            if ($idDevice) {
                    $dataDevice = array(
                    'stat_soil_moisture' => $data['soil_moisture'],
                    'stat_temperature' => $data['temperature'],
                    'stat_humidity' => $data['humidity'],
                    );
                $this->db->update('devices', $dataDevice, array('id_device' => $idDevice));
                $dataSensor = array(
                    'fk_device'=> $idDevice,
                    'soil_moisture' => $data['soil_moisture'],
                    'c1' => $this->cSoilMoisture($data['soil_moisture']),
                    'temperature'=> $data['temperature'],
                    'c2' => $this->cTemperature($data['temperature']),
                    'humidity'=> $data['humidity'],
                    'c3' => $this->cHumidity($data['humidity']),
                );
                $this->db->insert('sensor', $dataSensor);
                $this->db->trans_complete();
            }

            if ($this->db->trans_status()) {
                // $status = $this->db->select('stat_watering')->get_where('devices', array('device_token' => $data['device_token']))->row();
                // $this->response($status, 200);
                $this->response(array('status' => 'success',200));
            } else {
                $this->response(array('status' => 'fail', 502));
            }
       }
        
    }

    function statusDevices_get($device_token='',$statusVal='')
    {
        // $device_token = $this->uri->segment(3);
        // $statusVal = $this->uri->segment(4);
        (empty($device_token) && empty($statusVal)) ? show_404() : null ;
        $idDevice = $this->db->get_where('devices', array('device_token' => $device_token))->row('id_device');
        $this->db->update('devices', array('status' => $statusVal), array('id_device' => $idDevice));
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

    public function cSoilMoisture($valueSoilMoisture='')
    {
        /*
        Jika Nilai Tinggi -> Tidak tertancap ke tanah (Tidak Lembab)
        Jika Nilai Rendah -> Tertancap ke tanah dan Kelembapan dapat di ukur

        if ($valueSoilMoisture > 830) {
            $cSoil = 100;
        } elseif($valueSoilMoisture >=790 && $valueSoilMoisture <=830) {
            $cSoil = 75;
        } elseif($valueSoilMoisture >=670 && $valueSoilMoisture <=789) {
            $cSoil = 50;
        } elseif($valueSoilMoisture >=510 && $valueSoilMoisture <=669) {
            $cSoil = 25;
        } else {
            $cSoil = 0;
        }*/

        

        if ($valueSoilMoisture >= 500) {
            $cSoil = 100;
        } elseif($valueSoilMoisture >=400) {
            $cSoil = 75;
        } elseif($valueSoilMoisture >=300) {
            $cSoil = 50;
        } elseif($valueSoilMoisture >=200) {
            $cSoil = 25;
        } else {
            $cSoil = 0;
        }

        

        return $cSoil;        
    }

    public function cTemperature($valueTemperature='')
    {
        /*if ($valueTemperature > 50) {
            $cTemp = 100;
        } elseif($valueTemperature >= 36 && $valueTemperature <=50) {
            $cTemp = 75;
        } elseif($valueTemperature >= 26 && $valueTemperature <=35) {
            $cTemp = 50;
        } elseif($valueTemperature >= 15 && $valueTemperature <=25) {
            $cTemp = 25;
        } else {
            $cTemp = 0;
        }*/

        
            
        if ($valueTemperature >= 40) {
            $cTemp = 100;
        } elseif($valueTemperature >= 35) {
            $cTemp = 75;
        } elseif($valueTemperature >= 25) {
            $cTemp = 50;
        } elseif($valueTemperature >= 20) {
            $cTemp = 25;
        } else {
            $cTemp = 0;
        }

        

        return $cTemp;        
    }

    public function cHumidity($valueHumidity='')
    {
        /*if ($valueHumidity < 50) {
            $cHumidity = 100;
        } elseif($valueHumidity >= 50 && $valueHumidity <=65) {
            $cHumidity = 75;
        } elseif($valueHumidity >= 66 && $valueHumidity <=75) {
            $cHumidity = 50;
        } elseif($valueHumidity >= 76 && $valueHumidity <=85) {
            $cHumidity = 25;
        } else {
            $cHumidity = 0;
        }*/

    
    
        if ($valueHumidity >= 90) {
            $cHumidity = 0;
        } elseif($valueHumidity >= 75) {
            $cHumidity = 25;
        } elseif($valueHumidity >= 60) {
            $cHumidity = 50;
        } elseif($valueHumidity >= 25) {
            $cHumidity = 75;
        } else {
            $cHumidity = 100;
        }  

        return $cHumidity;        
    }


    /*public function test()
    {
        echo "Haloo";
    }

    public function checkTime()
    {
        $date = date("Y-m-d H:i:s"); 
       
        echo "<pre>";
        print_r($date);
        echo "</pre>";
    }*/

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */