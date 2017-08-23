#!/bin/env bash
while true
# for i in `seq 1 12`;
do
	#a1682c558de345d1b67eb01235e7cb93
	device_token=$1
	# bash_data=$(ps ax | grep bash | grep wateringActionBash.sh | grep $device_token | wc -l)
	bash_data=$(ps aux | grep -i "wateringActionBash.sh $device_token" | grep -v "grep" | wc -l)
	# echo $bash_data
	if [ $bash_data -lt 4 ];
		then
			# print $bash_data
			deviceStatus=$(curl -sr GET 'http://blynk-cloud.com/'$device_token'/isHardwareConnected')
			if [ $deviceStatus == 'true' ];
				then
					php /var/www/html/iotplant/index.php saw saveResult "$device_token"
					# echo "Eksekusi $device_token"
					sleep 1
					# action=$(php /var/www/html/iotplant/index.php saw actionWatering "$device_token")
					# if[$action -gt 0];
						# then
							# curl -sr GET 'http://blynk-cloud.com/'$device_token'/update/D4?value=0'
							# sleep $action
							# curl -sr GET 'http://blynk-cloud.com/'$device_token'/update/D4?value=1'
					# fi
			fi
		else
			# echo keluar
			exit
	fi
done
