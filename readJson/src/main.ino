// Sample Arduino Json Web Client
// Downloads and parse http://jsonplaceholder.typicode.com/users/1
// 
// Copyright Benoit Blanchon 2014-2017
// MIT License
// 
// Arduino JSON library
// https://bblanchon.github.io/ArduinoJson/
// If you like this project, please add a star!
// #include <avr/wdt.h>
#include <ArduinoJson.h>
#include <UIPEthernet.h> // Used for Ethernet
#include <dht.h>
#include <SimpleTimer.h>

dht DHT;
SimpleTimer timer;
EthernetClient client;

const char * server = "edyagusc.id.tunnel.my.id"; // server's address
const unsigned long BAUD_RATE = 9600; // serial connection speed
const unsigned long HTTP_TIMEOUT = 10000; // max respone time from server
const size_t MAX_CONTENT_SIZE = 161; // max size of the HTTP response
const int onboardLED  = 13;
const int resetPin  = 3;

// The type of data that we want to extract from the page
struct UserData
{
  char siram[1];
  // char humiditas[5];
};

//void(* resetFunc) (void) = 0;

void resetWire(){
  digitalWrite(resetPin, LOW);
  delay(200);
}

void runProgram(){
  if (connect(server))
  {
    if (sendRequest(server) && skipResponseHeaders())
    {
      UserData userData;
      if (readReponseContent(& userData))
      {
        // printUserData(& userData);
      }
    }
  }
  disconnect();
}

// ARDUINO entry point #1: runs once when you press reset or power the board
void setup()
{
  digitalWrite(resetPin, HIGH);
  delay(200);
  pinMode(resetPin, OUTPUT);
//  initSerial();
  initEthernet();
  timer.setInterval(5000, runProgram);
  timer.setInterval(60000, resetWire);
// wdt_enable(WDTO_2S);
}

// ARDUINO entry point #2: runs over and over again forever
void loop()
{
  // pinMode(onboardLED, OUTPUT);
  timer.run();
  // wdt_reset();
}

// Initialize Serial port
// void initSerial()
// {
//   Serial.begin(BAUD_RATE);
//   while (!Serial)
//   {
//     ; // wait for serial port to initialize
//   }
//   // Serial.println("Serial ready");
// }

// Initialize Ethernet library
void initEthernet()
{
  byte mac[] =
  {
    0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
  };
  if (!Ethernet.begin(mac))
  {
    // Serial.println("Failed to configure Ethernet");
    return;
  }
  // Serial.println("Ethernet ready");
  delay(1000);
}

// Open connection to the HTTP server
bool connect(const char * hostName)
{
  // Serial.print("Connect to ");
  // Serial.println(hostName);
  bool ok = client.connect(hostName, 80);
  // Serial.println(ok? "Connected HTTP":"Connection Failed!");
  return ok;
}

// Send the HTTP GET request to the server
bool sendRequest(const char * host)
{
  // const char* resource = "/iotplant/index.php/status?alat=0x1e950f"; // http resource
  DHT.read11(2);
  delay(500);
  client.print("GET /iotplant/index.php/status?");
  client.print("alat=");
  client.print("0x1e950f");
  client.print("&");
  client.print("suhu=");
  client.print(DHT.temperature, 1);
  client.print("&");
  client.print("humiditas=");
  client.print(DHT.humidity, 1);
  client.println(" HTTP/1.0");
  client.print("Host: ");
  client.println(host);
  client.println("Connection: close");
  client.println();
  return true;
}

// Skip HTTP headers so that we are at the beginning of the response's body
bool skipResponseHeaders()
{
  // HTTP headers end with an empty line
  char endOfHeaders[] = "\r\n\r\n";
  client.setTimeout(HTTP_TIMEOUT);
  bool ok = client.find(endOfHeaders);
  if (!ok)
  {
    // Serial.println("No response or invalid response!");
  }
  return ok;
}

bool readReponseContent(struct UserData * userData)
{
  // Compute optimal size of the JSON buffer according to what we need to parse.
  // This is only required if you use StaticJsonBuffer.
  const size_t BUFFER_SIZE =
  JSON_OBJECT_SIZE(8) // the root object has 8 elements
    + MAX_CONTENT_SIZE; // additional space for strings
  // Allocate a temporary memory pool
  DynamicJsonBuffer jsonBuffer(BUFFER_SIZE);
  JsonObject & root = jsonBuffer.parseObject(client);
  if (!root.success())
  {
    // Serial.println("JSON parsing failed!");
    return false;
  }
  // Here were copy the strings we're interested in
  strcpy(userData -> siram, root["siram"]);
  // strcpy(userData->humiditas, root["humiditas"]);
  // It's not mandatory to make a copy, you could just use the pointers
  // Since, they are pointing inside the "content" buffer, so you need to make
  // sure it's still in memory when you read the string
  return true;
}

// Print the data extracted from the JSON
// void printUserData(const struct UserData * userData)
// {
//   Serial.print("siram = ");
//   Serial.println(userData -> siram);
// }

// Close the connection with the HTTP server
void disconnect()
{
  // Serial.println("Disconnect");
  client.stop();
}