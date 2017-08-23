#include <UIPEthernet.h> // Used for Ethernet
#include <SPI.h>

// **** ETHERNET SETTING ****
// Arduino Uno pins: 10 = CS, 11 = MOSI, 12 = MISO, 13 = SCK
// Ethernet MAC address - must be unique on your network - MAC Reads T4A001 in hex (unique in your network)
byte mac[] = { 0x54, 0x34, 0x41, 0x30, 0x30, 0x31 };                                       
// For the rest we use DHCP (IP address and such)

EthernetClient client;
char server[] = "edyagusc.id.tunnel.my.id"; // IP Adres (or name) of server to dump data to
int  interval = 5000; // Wait between dumps
void setup() {

  Serial.begin(9600);
  Ethernet.begin(mac);

  Serial.println("-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-\n");
  Serial.print("IP Address        : ");
  Serial.println(Ethernet.localIP());
  Serial.print("Subnet Mask       : ");
  Serial.println(Ethernet.subnetMask());
  Serial.print("Default Gateway IP: ");
  Serial.println(Ethernet.gatewayIP());
  Serial.print("DNS Server IP     : ");
  Serial.println(Ethernet.dnsServerIP());
  // delay(1000);  
}

void loop() {
  if (client.connect(server, 80)) {
    Serial.println();
    Serial.println("connected");
    // Make a HTTP request:
    client.println("GET /iotplant/index.php/status?alat=0x1e950f HTTP/1.1");
    client.print( "Host: ");
    client.println(server);
    client.println("Connection: close");
    client.println();
    int i = 0;
    char c[] = {};
    while(client.connected()) {
      //Serial.println("Sebelum Reading");
      while (client.available()) {
        // Serial.print("->>");

        c[i] = client.read();
        Serial.print(c[i]);
        i++;
        
        //Serial.print("|");
      }
      //Serial.println("Setelah Reading");
    }
    //Serial.print(c);
  } else {
    // if you didn't get a connection to the server:
    Serial.println("connection failed");
  }

  // char PostData[] = "{\"alat\": \"0x1e950f\", \"suhu\": \"31\", \"humiditas\": \"70\"}"; // your JSON payload
  // if there are incoming bytes available
  // from the server, read them and print them:

  //Serial.println("Sebelum delay");
  delay(interval);
}