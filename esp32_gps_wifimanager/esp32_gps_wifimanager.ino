#include <WiFiManager.h>
#include <HTTPClient.h>
#include <SoftwareSerial.h>
#include <TinyGPS++.h>

const char* serverAddress = "http://api.pnmrute.com/update_gps_data.php";
// const char* serverAddress = "http://192.168.100.15/update_gps_data.php";


SoftwareSerial serial_gps(16, 17); // RX2 and TX2 in ESP32
TinyGPSPlus gps;

void setup() {
    Serial.begin(115200);
    WiFiManager wm;
    bool res;
    res = wm.autoConnect("GpsDriver"); // anonymous ap

    if(!res) {
        Serial.println("Failed to connect");
    } 
    else {
        Serial.println("connected to Wi-Fi:)");
    }

  serial_gps.begin(9600);
  Serial.println("Starting GPS!");

}

void loop() {
    while(serial_gps.available()){
    gps.encode(serial_gps.read());
  }

  if (gps.location.isUpdated()){
    Serial.print("Latitude : ");
    Serial.print(gps.location.lat(), 6);
    Serial.print(" Longitude : ");
    Serial.println(gps.location.lng(), 6);

    // Connect to the server and send GPS data via HTTP POST
    sendGPSData(gps.location.lat(), gps.location.lng());

    delay(30000); // Kirim data setiap 1 menit (60 detik)
  }   
}

void sendGPSData(double lat, double lng) {
  // Create HTTP client object
  HTTPClient http;

  // Create payload data
  String postData = "lat=" + String(lat, 6) + "&lng=" + String(lng, 6);

  // Print the data to be sent for debugging
  Serial.print("Sending data: ");
  Serial.println(postData);

  // Start connection to server
  http.begin(serverAddress);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  // Send POST request with GPS data
  int httpResponseCode = http.POST(postData);

  // Check response from server
  if (httpResponseCode > 0) {
    Serial.print("HTTP Response code: ");
    Serial.println(httpResponseCode);
    String response = http.getString();
    Serial.println("Response: " + response);
  } else {
    Serial.print("HTTP Error code: ");
    Serial.println(httpResponseCode);
  }

  // End connection
  http.end();
}
