#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>
#include <ESP32Servo.h>

String key = "83217";
const int servo = 25;
int derajat = 0;
Servo myServo;

const char* ssid = "Salwa Firodisa";
const char* password = "Cemong30";

void setup(){
    Serial.begin(115200);
    delay(1000);
    WiFi.mode(WIFI_STA);

    myServo.attach(servo);
    myServo.write(0);
    WiFi.begin(ssid, password);
    Serial.println("\nConnecting");

    while(WiFi.status() != WL_CONNECTED){
        Serial.print(".");
        delay(100);
    }

    Serial.println("\nConnected to the WiFi network");
    Serial.print("Local ESP32 IP: ");
    Serial.println(WiFi.localIP());
}

void loop(){
  if(WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin("http://192.168.1.2/control.php");
    http.addHeader("Content-type", "application/x-www-form-urlencoded");
    int httpResponseCode = http.POST("token="+ key);
    delay(100);
    if (httpResponseCode > 0) {
      String response = http.getString();
      char json[500];
      response.toCharArray(json,500);
      StaticJsonDocument<200> doc;
      deserializeJson(doc,json);
      int door = doc["door"];
      if(door == 1){
        derajat=180;
        myServo.write(derajat);
      }else{
        derajat=0;
        myServo.write(derajat);
      }
      Serial.print("door =");
      Serial.println(door);
    }else{
      Serial.print("Error on sending POST");
      Serial.println(httpResponseCode);
    }
    http.end();
  }
  delay(5000);
}