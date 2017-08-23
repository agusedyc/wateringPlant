#!/bin/env bash
while true
do
	device_token=$1
	bash_data=$(ps aux | grep -i "TriggerBash.sh $device_token" | grep -v "grep" | wc -l)
	if [ $bash_data -lt 4 ];
		then
			deviceStatus=$(curl -sr GET 'http://blynk-cloud.com/'$device_token'/isHardwareConnected')
			if [ $deviceStatus == 'true' ];
				then
					action=$(php /var/www/html/iotplant/index.php saw actionWatering "$device_token")
					if [ $action -gt 0 ];
						then
							curl -sr GET 'http://blynk-cloud.com/'$device_token'/update/D4?value=0'
							sleep $action
							curl -sr GET 'http://blynk-cloud.com/'$device_token'/update/D4?value=1'
							sleep 1
					fi
			fi
		else
			exit
	fi
done