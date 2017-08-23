<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
// Token A a1682c558de345d1b67eb01235e7cb93
class Saw extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        
    }

    public function index($device_token='')
    {
        show_404();
        // $this->saveResult($device_token);
        // echo "<pre>";
        // print_r($this->saveResult('a1682c558de345d1b67eb01235e7cb93'));
        // print_r(date("a",strtotime(date("Y-m-d H:i:s"))));
        // echo "</pre>";
    }

    public function mapTime($value, $fromLow, $fromHigh, $toLow, $toHigh) {
        $value = strtotime($value);
        $fromLow = strtotime($fromLow);
        $fromHigh = strtotime($fromHigh);
        $toLow = strtotime($toLow);
        $toHigh = strtotime($toHigh);

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

    public function getTime($tokenDevice='')
    {        
        // $tokenDevice = $this->uri->segment(3);
        (empty($tokenDevice)) ? show_404() : null ;

        // $date = date("Y-m-d H:i:s"); 
        // $date = "2017-06-21 17:16:18";
        $statusDevice = $this->db->get_where('devices', array('device_token' => $tokenDevice))->row();
       
        $am =  $statusDevice->watering_am;
        $ama = explode(' - ', $am)['0'];
        $amb = explode(' - ', $am)['1'];

        $pm =  $statusDevice->watering_pm;
        $pma = explode(' - ', $pm)['0'];
        $pmb = explode(' - ', $pm)['1'];

        $data = (object) array(
            'id_device' => $statusDevice->id_device,
            'ama' => $ama,
            'amb' => $amb,
            'pma' => $pma,
            'pmb' => $pmb, 
            );
        // print_r($statusDevice);
        return $data;
    }

    public function dataAm($device_token='')
    {
        $this->benchmark->mark('code_start');
        $data = $this->getTime($device_token);
        $ama = $data->ama;
        // $amb = $data->amb;

        // $pma = $data->pma;
        $pmb = $data->pmb;

        // Get 2 Hours After PM ,1 day before
        $pmb_start = date("Y-m-d",strtotime('-1 days'))." ".$pmb.":00";
        $pmb_end = date('Y-m-d H:i:s',strtotime('+2 hour',strtotime($pmb_start)));
        $array_pmb = array(
            'created_at >=' => $pmb_start, 
            'created_at <=' => $pmb_end,
            'fk_device' => $data->id_device,
            );
        $this->db->cache_on();
        $get_pmb = $this->db->select('id_sensor,c1,c2,c3')->where($array_pmb)->get('sensor')->result();

        // Get 2 Hours before AM
        $ama_end = date("Y-m-d")." ".$ama.":00";
        $ama_start = date('Y-m-d H:i:s',strtotime('-2 hour',strtotime($ama_end)));
        $array_ama = array(
            'created_at >=' => $ama_start, 
            'created_at <=' => $ama_end,
            'fk_device' => $data->id_device,
            );
        $this->db->cache_on();
        $get_ama = $this->db->select('id_sensor,c1,c2,c3')->where($array_ama)->get('sensor')->result();
        // Merge data After PM and before AM
        $merge_pmb_ama = array_merge($get_pmb,$get_ama);
        
        $data = (object) array(
            'sensor' => $merge_pmb_ama,
            'pmb_start' => $pmb_start, 
            'pmb_end' => $pmb_end,
            'ama_start' => $ama_start,
            'ama_end' => $ama_end,
            );
        return $data;
        $this->benchmark->mark('code_end');

        /*echo "<pre>";
        echo $this->benchmark->elapsed_time('code_start', 'code_end');
        echo "<br>";
        print_r($pmb_start);
        echo "<br>";
        print_r($pmb_end);
        echo "<br>";
        print_r($ama_start);
        echo "<br>";
        print_r($ama_end);
        echo "<br>";
        print_r($pmb);
        echo "<br>";
        print_r($ama);
        echo "<br>";
        print_r($merge_pmb_ama);
        echo "</pre>";*/
    }

    public function dataPm($device_token='')
    {
        $this->benchmark->mark('code_start');
        $data = $this->getTime($device_token);
        // $ama = $time->ama;
        $amb = $data->amb;

        $pma = $data->pma;
        // $pmb = $time->pmb;

        // Get 2 Hours After AM
        $amb_start = date("Y-m-d")." ".$amb.":00";
        $amb_end = date('Y-m-d H:i:s',strtotime('+2 hour',strtotime($amb_start)));
        $array_amb = array(
            'created_at >=' => $amb_start, 
            'created_at <=' => $amb_end,
            'fk_device' => $data->id_device,
            );
        $this->db->cache_on();
        $get_amb = $this->db->select('id_sensor,c1,c2,c3')->where($array_amb)->get('sensor')->result();

        // Get 2 Hours before PM
        $pma_end = date("Y-m-d")." ".$pma.":00";
        $pma_start = date('Y-m-d H:i:s',strtotime('-2 hour',strtotime($pma_end)));
        $array_pma = array(
            'created_at >=' => $pma_start, 
            'created_at <=' => $pma_end,
            'fk_device' => $data->id_device,
            );
        $this->db->cache_on();
        $get_pma = $this->db->select('id_sensor,c1,c2,c3')->where($array_pma)->get('sensor')->result();
        // Merge data After AM and before PM
        $merge_amb_pma = array_merge($get_amb,$get_pma);
        
        $data = (object) array(
            'sensor' => $merge_amb_pma,
            'amb_start' => $amb_start,
            'amb_end' => $amb_end,
            'pma_start' => $pma_start, 
            'pma_end' => $pma_end,
            );
        return $data;
        $this->benchmark->mark('code_end');

       /* echo "<pre>";
        echo $this->benchmark->elapsed_time('code_start', 'code_end');
        echo "<br>";
        print_r($amb_start);
        echo "<br>";
        print_r($amb_end);
        echo "<br>";
        print_r($pma_start);
        echo "<br>";
        print_r($pma_end);
        echo "<br>";
        print_r($amb);
        echo "<br>";
        print_r($pma);
        echo "<br>";
        print_r($merge_amb_pma);
        echo "</pre>";*/
    }

    public function saveResult($device_token='')
    {
        $time = $this->getTime($device_token);
        if (date("a",strtotime(date("Y-m-d H:i:s")))=="am") {
            echo "Am => ".PHP_EOL;
            // $this->benchmark->mark('result_am_start');
            // $resultAm = $this->result($device_token,'am');
            // $this->benchmark->mark('result_am_end');
            // $benchmarkAm = $this->benchmark->elapsed_time('result_am_start', 'result_am_end');
            if (strtotime(date("H:i"))>=strtotime($time->ama) && strtotime(date("H:i"))<=strtotime($time->ama) /*&& strtotime(date("H:i"))<=strtotime("+1 minutes",strtotime($time->ama))*/) {
                echo "True ".date("H:i").">=".$time->ama." && ".date("H:i")."<=".date("H:i",strtotime("+1 minutes",strtotime($time->ama))).PHP_EOL;
                $resultAm = $this->result($device_token,'am');
                $dataAm = array(
                    'fk_device' => $resultAm->id_device,
                    'ranking' => $resultAm->rangking,
                    'watering_time' => $resultAm->wateringTime,
                );
                // print_r($dataAm);
                $this->db->insert('saw_result', $dataAm);
            }/*else{
                exit;
            }*/
        }elseif(date("a",strtotime(date("Y-m-d H:i:s")))=="pm") {
            echo "Pm => ".PHP_EOL;
            // echo date("H:i",strtotime("+2 minutes",strtotime($time->pma)));
            // echo $time->pma;
            // $this->benchmark->mark('result_pm_start');
            // $resultPm = $this->result($device_token,'pm');
            // $this->benchmark->mark('result_pm_end');
            // $benchmarkPm = $this->benchmark->elapsed_time('result_pm_start', 'result_pm_end');
            if (strtotime(date("H:i"))>=strtotime($time->pma) && strtotime(date("H:i"))<=strtotime($time->pma)/*&& strtotime(date("H:i"))<=strtotime("+1 minutes",strtotime($time->pma))*/) {
                echo "True ".date("H:i").">=".$time->pma." && ".date("H:i")."<=".date("H:i",strtotime("+1 minutes",strtotime($time->pma))).PHP_EOL;
                $resultPm = $this->result($device_token,'pm');
                $dataPm = array(
                    'fk_device' => $resultPm->id_device,
                    'ranking' => $resultPm->rangking,
                    'watering_time' => $resultPm->wateringTime,
                );
                // print_r($dataPm);
                $this->db->insert('saw_result', $dataPm);
            }/*else{
                exit;
            }*/
        }/*else{
            exit;
        }*/
  
    }

    public function result($device_token='',$day='')
    {
        $time = $this->getTime($device_token);
        
        if ($day=='pm') {
            $data = $this->dataPm($device_token);
            $start_reading = $data->amb_start;
            $end_reading = $data->pma_end;
            $start_watering = $time->pma;
            $end_watering = $time->pmb;
        }elseif ($day=='am') {
            $data = $this->dataAm($device_token);
            $start_reading = $data->pmb_start;
            $end_reading = $data->ama_end;
            $start_watering = $time->ama;
            $end_watering = $time->amb;
        }else{
            show_404();
        }
        $dataRank = $this->ranking($data->sensor,$device_token);
        $data = $this->wateringTime($dataRank->id_sensor,$start_reading,$end_reading,$start_watering,$end_watering);

        $result = (object) array(
                'id_device' => $data->id_device,
                'rangking' => $dataRank->rangking,
                'wateringTime' => $data->wateringTime, 
            );

        return $result;
        /*echo "<pre>";
        echo "<br>";
        echo $day;
        echo "<br>";
        print_r($data);
        echo "<br>";
        print_r($dataRank);
        echo "</pre>";*/
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

    public function wateringTime($id='',$start_reading,$end_reading,$start_watering,$end_watering)
    {

        $sensorData = $this->db->get_where('sensor',array('id_sensor'=>$id))->row();
        $dataWatering = (object) array(
            'id_device' => $sensorData->fk_device,
            'reading_at' => $sensorData->created_at, 
            'wateringTime' => date("Y-m-d H:i:s",$this->mapTime($sensorData->created_at,$start_reading,$end_reading,$start_watering,$end_watering)),
            );
        // 'created_at' => $this->db->get_where('sensor',array('id_sensor'=>$dt_pm->id_sensor))->row('created_at'),
        // 'watering_pm' => date("Y-m-d H:i:s",$this->map(strtotime($this->db->get_where('sensor',array('id_sensor'=>$dt_pm->id_sensor))->row('created_at')),strtotime($data->amb_start),strtotime($data->pma_end),strtotime($time->pma),strtotime($time->pmb))),
        return $dataWatering;
    }

    public function ranking($dataSensor='',$tokenDevice='')
    {
        $weight = $this->getWeighting($tokenDevice);
        // $dataSensor = $this->dataAm('a1682c558de345d1b67eb01235e7cb93')->sensor;
        $maxData = (object) array(
            'c1' => $this->maxValueInArray($dataSensor,'c1')->value, 
            'c2' => $this->maxValueInArray($dataSensor,'c2')->value, 
            'c3' => $this->maxValueInArray($dataSensor,'c3')->value, 
            );
        foreach ($dataSensor as $dataList) {
            // echo $dt_pm->c1;
            $rangking = round((($dataList->c1/$maxData->c1)*$weight->c1)+(($dataList->c2/$maxData->c2)*$weight->c2)+(($dataList->c3/$maxData->c3)*$weight->c3),3);
            $dataRank[] = array(
                'id_sensor' => $dataList->id_sensor,
                'rangking' => $rangking,
                );
        }
        $fristRank = $this->maxValueInArray($dataRank,'rangking');
        return $fristRank->data;
       /* echo "<pre>";
        print_r($weight);
        echo "<br>";
        print_r($dataSensor);
        echo "<br>";
        print_r($maxData);
        echo "<br>";
        print_r($dataRank);
        echo "<br>";
        print_r($fristRank->data);
        echo "</pre>";*/
    }

    public function maxValueInArray($array, $keyToSearch)
    {
        $currentMax = NULL;
        foreach($array as $arr)
        {
            foreach($arr as $key => $value)
            {

                if ($key == $keyToSearch && ($value >= $currentMax))
                {
                    $currentMax = $value;
                    $data = (object) array(
                        // $currentMax,
                        'value' => $currentMax, 
                        'data' => (object) $arr, 
                        );
                }
            }

        }

        return $data;
    }

    function actionWatering($device_token='a1682c558de345d1b67eb01235e7cb93')
    {
        // ambil data by token 
        // ambil data berdasarkan data hari ini 
        // di order desc 
        // di ambil satu baris terakhir pake ->row()
        $id_device = $this->getTime($device_token)->id_device;
        // $wateringResult = $this->db->like('created_at',date("Y-m-d"))->get_where('saw_result', array('fk_device' => $id_device));
        $wateringResult = $this->db->select('id_result,watering_time,ranking')->like('created_at',date("Y-m-d"))->order_by('id_result','desc')->get_where('saw_result', array('fk_device' => $id_device))->row();
         if (strtotime(date("Y-m-d H:i:s"))>=strtotime($wateringResult->watering_time) && strtotime(date("Y-m-d H:i:s"))<=strtotime($wateringResult->watering_time)){

            if ($wateringResult->rangking >= '9') {
                echo "15";
            }elseif($wateringResult->rangking >= '8') {
                echo "10";
            }elseif ($wateringResult->rangking >= '7') {
                echo "5";
            }else{
                echo "0";
            }
            
        }else{
            echo "0";
        }
        
        // echo "<pre>";
        // print_r($wateringResult);
        // echo "</pre>";
    }

    /*function wateringStatus_get($device_token='')
    {
        $idDevice = $this->db->get_where('devices' array('device_token'=>$device_token))->row('id_device');
        $result = $this->db->select_max('id_result')->where('fk_device',$idDevice)->get('saw_result');
    }*/

}

/* End of file Saw.php */
/* Location: ./application/controllers/Saw.php */