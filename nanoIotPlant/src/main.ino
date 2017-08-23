/**************************************************************
 * Blynk is a platform with iOS and Android apps to control
 * Arduino, Raspberry Pi and the likes over the Internet.
 * You can easily build graphic interfaces for all your
 * projects by simply dragging and dropping widgets.
 *
 *   Downloads, docs, tutorials: http://www.blynk.cc
 *   Blynk community:            http://community.blynk.cc
 *   Social networks:            http://www.fb.com/blynkapp
 *                               http://twitter.com/blynk_app
 *
 * Blynk library is licensed under MIT license
 * This example code is in public domain.
 *
 **************************************************************
 *
 * This example shows how to use ENC28J60 (UIPEthernet library)
 * to connect your project to Blynk.
 *
 * For this example you need UIPEthernet library:
 *   https://github.com/ntruchsess/arduino_uip
 *
 * Typical wiring would be:
 *  VCC -- 5V
 *  GND -- GND
 *  CS  -- D10
 *  SI  -- D11
 *  SCK -- D13
 *  SO  -- D12
 *  INT -- D2
 *
 * Feel free to apply it to any other example. It's simple!
 *
 **************************************************************/

//#define BLYNK_PRINT Serial    // Comment this out to disable prints and save space
// #include <UIPEthernet.h>
#include <SimpleTimer.h>
#include <BlynkSimpleUIPEthernet.h>
#include <dht.h>
#include <LM35.h>
// #include <avr/wdt.h>

// You should get Auth Token in the Blynk App.
// Go to the Project Settings (nut icon).
const char auth[] = "a1682c558de345d1b67eb01235e7cb93";

// Pin Digital
const int pinDht = 3;
const int pinRelay = 4;
const int pinReset = 5;

//Pin Analog
const int pinTemp = 0;
const int pinSoil = 1;

dht DHT;
LM35Sensor lm35;
SimpleTimer timer;

const int numReadings = 10;

int readings[numReadings];      // the readings from the analog input
int readIndex = 0;              // the index of the current reading
int total = 0;                  // the running total
int average = 0;                // the average
// int analogPin = 0;           // pin analog

void displayWidget()
{
   //init Lib
  lm35.read(pinTemp);
  DHT.read22(pinDht);

   // Read temperature as Celsius (the default)
  float dhtTemperature = DHT.temperature;
  if(dhtTemperature < 0){
      dhtTemperature = 0;
  }
  // Read Humidity
  float dhtHumidity = DHT.humidity;
  if(dhtHumidity < 0){
      dhtHumidity = 0;
  }

   // Read Soil Temprature as Celcius
  float tempSoil = lm35.getCelsius();
  if(tempSoil >= 100){
        tempSoil = 0;
    }

  // Read Analog Data From Soil Mosture
  float dataSoilMoisture = smoothingAnalogRead(pinSoil);

  // Read temperature as Celsius (the default)
  float dhtTemp = dhtTemperature;

  // Read Humidity
  float dhtHum = dhtHumidity;
   
  // Read soilMoisture
  float soilMois = dataSoilMoisture;

  // Read Temprature
  float temp = tempSoil;


  // Soil Mosture Widget
  Blynk.virtualWrite(V1,soilMois);
  // Temperature Soil Widget
  Blynk.virtualWrite(V2,temp);
  // Humidity Widget
  Blynk.virtualWrite(V3,dhtHum);
  // Temperature Widget
  Blynk.virtualWrite(V4,dhtTemp);

  // Web Hook Widget
  Blynk.virtualWrite(V0, soilMois, temp, dhtHum, dhtTemp);
}

void resetWire(){
  digitalWrite(pinReset, LOW);
}


int smoothingAnalogRead(int analogPin){
  // subtract the last reading:
  total = total - readings[readIndex];
  // read from the sensor:
  readings[readIndex] = analogRead(analogPin);
  // add the reading to the total:
  total = total + readings[readIndex];
  // advance to the next position in the array:
  readIndex = readIndex + 1;

  // if we're at the end of the array...
  if (readIndex >= numReadings) {
    // ...wrap around to the beginning:
    readIndex = 0;
  }

  // calculate the average:
  return average = total / numReadings;
}

void setup()
{
  digitalWrite(pinRelay, HIGH);
  pinMode(pinRelay, OUTPUT); 
  digitalWrite(pinReset, HIGH);
  pinMode(pinReset, OUTPUT);

  // Serial.begin(9600);
  Blynk.begin(auth);
  // You can also specify server.
  // For more options, see BoardsAndShields/Arduino_Ethernet_Manual example
  //Blynk.begin(auth, "blynk-cloud.com", 8442);
  //Blynk.begin(auth, IPAddress(192,168,1,100), 8888);
  // setAnalogRead();
  // initialize all the readings to 0:
  for (int thisReading = 0; thisReading < numReadings; thisReading++) {
    readings[thisReading] = 0;
  }
  timer.setInterval(1800000L, resetWire);
  timer.setInterval(10000L, displayWidget);
  // timer.setInterval(15000L, webHook);
}

void loop()
{
  Blynk.run();
  timer.run(); // Initiates SimpleTimer
}
