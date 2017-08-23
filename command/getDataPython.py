#!/usr/bin/python

import sys
import json
import requests
import time


while True:
	# Get the dataset
	#url = 'http://blynk-cloud.com/a1682c558de345d1b67eb01235e7cb93/get/V0'
	# token = 'a1682c558de345d1b67eb01235e7cb93'
	token = sys.argv[1]
	url = 'http://blynk-cloud.com/%s/get/V0'%(token)
	response = requests.get(url)
	apiData = response.json()

	localUrl = 'http://localhost/iotplant/index.php/saw?device_token=%s&soil_moisture=%s&temperature=%s&humidity=%s&dht_temp=%s'%(token,apiData[0],apiData[1],apiData[2],apiData[3])
	localRequests = requests.get(localUrl)
	# localResponse = localRequests.json()
	# print sys.argv[1]
	time.sleep(10)




