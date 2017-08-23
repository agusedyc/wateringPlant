#include <UIPEthernet.h> // Used for Ethernet
#include <dht.h>

// **** ETHERNET SETTING ****
// Arduino Uno pins: 10 = CS, 11 = MOSI, 12 = MISO, 13 = SCK
// Ethernet MAC address - must be unique on your network - MAC Reads T4A001 in hex (unique in your network)
byte mac[] = { 0x54, 0x34, 0x41, 0x30, 0x30, 0x31 };                                       
// For the rest we use DHCP (IP address and such)

EthernetClient client;
char server[] = "edyagusc.id.tunnel.my.id"; // IP Adres (or name) of server to dump data to
int  interval = 5000; // Wait between dumps
dht DHT;
#define DHT11_PIN 2
void setup() {

  Serial.begin(9600);
  Ethernet.begin(mac);

  Serial.println("Arduino Nano + Ethernet ENC28J60");
  Serial.println("-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-\n");
  Serial.print("IP Address        : ");
  Serial.println(Ethernet.localIP());
  Serial.print("Subnet Mask       : ");
  Serial.println(Ethernet.subnetMask());
  Serial.print("Default Gateway IP: ");
  Serial.println(Ethernet.gatewayIP());
  Serial.print("DNS Server IP     : ");
  Serial.println(Ethernet.dnsServerIP());
}

void loop() {
  // char PostData[] = "{\"alat\": \"0x1e950f\", \"suhu\": \"31\", \"humiditas\": \"70\"}"; // your JSON payload
  // if you get a connection, report back via serial:
  int chk = DHT.read11(DHT11_PIN);
  

      if (client.connect(server, 80)) {
        Serial.println("-> Connected");
        // Make a HTTP request:
        client.print( "GET /iotplant/index.php/api?");
        client.print("alat=");
        client.print( "0x1e950f" );
        client.print("&");
        client.print("suhu=");
        client.print(DHT.temperature, 1);
        client.print("&");
        client.print("humiditas=");
        client.print(DHT.humidity, 1);
        client.println( " HTTP/1.1");
        client.print( "Host: ");
        client.println(server);
        client.println( "Connection: close" );
        client.println();
        client.println();
        client.stop();
      }else{
        // you didn't get a connection to the server:
        Serial.println("--> connection failed\n");
      }

  delay(interval);
}