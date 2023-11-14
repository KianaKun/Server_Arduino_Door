#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>
#include <ESP32Servo.h>

String key = "83217"; //Token pada database mysql
const int servo = 25;
int derajat = 0;
Servo myServo;

const char* ssid = "SSID";
const char* password = "Password";

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
    Serial.print("IP Addressnya: ");
    Serial.println(WiFi.localIP());
}

void loop(){
  if(WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin("http://IP Address Webserver/control.php");
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
        derajat=100;
        myServo.write(derajat);
        Serial.println("Pintu terkunci");
      }else{
        derajat=0;
        myServo.write(derajat);
        Serial.println("Pintu Terbuka");
      }
    }else{
      Serial.print("Koneksi ke database : ");
      Serial.println(httpResponseCode);
    }
    http.end();
  }
  delay(3000);
}
