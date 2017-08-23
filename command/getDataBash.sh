#!/bin/env bash
while true
# for i in `seq 1 12`;
do
	#a1682c558de345d1b67eb01235e7cb93
	device_token=$1
	# bash_data=$(ps ax | grep bash | grep getDataBash.sh | grep $device_token | wc -l)
	bash_data=$(ps aux | grep -i "getDataBash.sh $device_token" | grep -v "grep" | wc -l)
	# echo $bash_data
	if [ $bash_data -lt 4 ];
		then
			# print $bash_data
			# deviceStatus=$(curl --request GET 'http://blynk-cloud.com/'$device_token'/isHardwareConnected')
			deviceStatus=$(curl -sr GET 'http://blynk-cloud.com/'$device_token'/isHardwareConnected')
			if [ $deviceStatus == 'true'  ]; 
				then
					#statements					
					data=$(curl -sr GET 'http://blynk-cloud.com/'$device_token'/get/V0')
					soil_moisture=$(echo "$data" | jq --raw-output '.[0]')
					temperature=$(echo "$data" | jq --raw-output '.[1]')
					humidity=$(echo "$data" | jq --raw-output '.[2]')
					dht_temp=$(echo "$data" | jq --raw-output '.[3]')

					# echo 'http://localhost/iotplant/index.php/saw?device_token='$device_token'&soil_moisture='$soil_moisture'&temperature='$temperature'&humidity='$humidity'&dht_temp='$dht_temp''
					# echo $data
					# localApi = $(curl 'http://localhost/iotplant/index.php/saw?device_token='$device_token'&soil_moisture='$soil_moisture'&temperature='$temperature'&humidity='$humidity'&dht_temp='$dht_temp'')
					# curl --request GET 'http://localhost/iotplant/index.php/api?device_token='$device_token'&soil_moisture='$soil_moisture'&temperature='$temperature'&humidity='$humidity'&dht_temp='$dht_temp''
					php /var/www/html/iotplant/index.php api "$device_token" "$soil_moisture" "$temperature" "$humidity" "$dht_temp"
					# curl --request GET 'http://localhost/iotplant/index.php/api/statusDevices/'$device_token'/0'
					php /var/www/html/iotplant/index.php api statusDevices "$device_token" "1"
					sleep 8
				else
					# curl --request GET 'http://localhost/iotplant/index.php/api/statusDevices/'$device_token'/0'
					php /var/www/html/iotplant/index.php api statusDevices "$device_token" "0"
					#exit
			fi
		else
			# echo keluar
			exit

	fi
done


