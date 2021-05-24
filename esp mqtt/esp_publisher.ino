#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include <ESPDateTime.h>

const char* ssid ="TP-Link_7AF2"; //replace this with your wifi  name
const char* password ="baginski1"; //replace with your wifi password
char hostname[] ="192.168.1.27"; //replace this with IP address of machine 
//on which broker is installed
#define TOKEN "bytesofgigabytes"

WiFiClient wifiClient;
PubSubClient client(wifiClient);

int status = WL_IDLE_STATUS;
unsigned long timeSinceStart;

void setup() 
{
  // put your setup code here, to run once:
  Serial.begin(115200);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) 
  {
  delay(500);
  Serial.print(".");
  }
  Serial.println("Connected to WiFi");
  Serial.println("ESP8266 AS PUBLISHER");
  client.setServer(hostname, 1883 ); //default port for mqtt is 1883
}

void loop() 
{
  // put your main code here, to run repeatedly:
  if ( !client.connected())
  {
    reconnect();
  }
  MQTTPOST_temperature();
  delay(2000);
  MQTTPOST_alarm();
  delay(2000);
  MQTTPOST_lighting();
  delay(500000);//delay 5 Sec // 500 secs
}

void MQTTPOST_temperature()
{
  //payload formation begins here
  String payload = "temperature"; // topic
  payload += ",1"; // id_device 
  payload +=",1,"; // id_channel
  payload += DateTime.formatUTC("%Y-%m-%d %H:%M:%S");
  payload += ",36"; // measurement
  payload += ",temperature"; // measurement type
  payload += ",C"; // measurement units, only for temperature

  char attributes[1000];
  payload.toCharArray( attributes, 1000 );
  client.publish("temperature", attributes); //topic="test" MQTT data post command.
  Serial.println( attributes );
}

void MQTTPOST_alarm()
{
  //payload formation begins here
  String payload = "alarm"; // topic
  payload += ",2"; // id_device 
  payload +=",1,"; // id_channel
  payload += DateTime.formatUTC("%Y-%m-%d %H:%M:%S");
  payload += ",1"; // measurement
  payload += ",alarm"; // measurement type 

  char attributes[1000];
  payload.toCharArray( attributes, 1000 );
  client.publish("alarm", attributes); //topic="test" MQTT data post command.
  Serial.println( attributes );
}

void MQTTPOST_lighting()
{
  //payload formation begins here
  String payload = "lighting"; // topic
  payload += ",3"; // id_device
  payload +=",1,"; // id_channel
  payload += DateTime.formatUTC("%Y-%m-%d %H:%M:%S");
  payload += ",0"; // measurement
  payload += ",lighting"; // measurement type

  char attributes[1000];
  payload.toCharArray( attributes, 1000 );
  client.publish("lighting", attributes); //topic="test" MQTT data post command.
  Serial.println( attributes );
}

//this function helps you reconnect wifi as well as broker if connection gets disconnected.
void reconnect() 
{
  while (!client.connected())
  {
    status = WiFi.status();
    if ( status != WL_CONNECTED) 
    {
      WiFi.begin(ssid, password);
      while (WiFi.status() != WL_CONNECTED) 
      {
        delay(500);
        Serial.print(".");
      }
    Serial.println("Connected to AP");
    }
    Serial.print("Connecting to Broker …");
    Serial.print("192.168.43.220");
  
    if ( client.connect("ESP8266 Device", TOKEN, NULL) )
    {
      Serial.println("[DONE]" );
    }
    else 
    {
    Serial.println( " : retrying in 5 seconds]" );
    delay( 5000 );
    }
  }
}
