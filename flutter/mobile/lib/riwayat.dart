import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'dart:convert';
import 'package:http/http.dart' as http;

class RiwayatPage extends StatefulWidget {
  @override
  _RiwayatPageState createState() => _RiwayatPageState();
}

class _RiwayatPageState extends State<RiwayatPage> {
  late Future<List<Map<String, dynamic>>> _futureRiwayat;

  @override
  void initState() {
    super.initState();
    _futureRiwayat = _loadRiwayat();
  }

  Future<List<Map<String, dynamic>>> _loadRiwayat() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    String? driverIdString = prefs.getString('driver_id');
    if (driverIdString != null) {
      try {
        final String url = 'http://api.pnmrute.com/fetchRiwayat.php';
        //  final String url = 'http://192.168.100.15/fetchRiwayat.php';
        final response = await http.post(
          Uri.parse(url),
          headers: <String, String>{
            'Content-Type': 'application/json; charset=UTF-8',
          },
          body: jsonEncode(<String, dynamic>{
            'driver_id': driverIdString,
          }),
        );

        if (response.statusCode == 200) {
          final List<dynamic> responseData = jsonDecode(response.body);
          return List<Map<String, dynamic>>.from(responseData);
        } else {
          throw Exception('Failed to load history');
        }
      } catch (e) {
        return Future.error("Invalid driver ID format");
      }
    } else {
      return Future.error("Driver ID not found");
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Riwayat Penugasan'),
      ),
      body: Padding(
        padding: EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            SizedBox(height: 20),
            Text(
              'Riwayat Penugasan',
              style: TextStyle(
                fontSize: 24,
                fontWeight: FontWeight.bold,
              ),
            ),
            SizedBox(height: 20),
            Expanded(
              child: FutureBuilder<List<Map<String, dynamic>>>(
                future: _futureRiwayat,
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return Center(child: CircularProgressIndicator());
                  } else if (snapshot.hasError) {
                    return Center(child: Text('Error: ${snapshot.error}'));
                  } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
                    return Center(child: Text('No history found'));
                  } else {
                    return ListView.builder(
                      itemCount: snapshot.data!.length,
                      itemBuilder: (context, index) {
                        final riwayat = snapshot.data![index];
                        return Card(
                          elevation: 3,
                          child: Padding(
                            padding: EdgeInsets.all(16.0),
                            child: Column(
                              crossAxisAlignment: CrossAxisAlignment.start,
                              children: [
                                Text(
                                  'Penugasan: ${riwayat['penugasan']}',
                                  style: TextStyle(
                                    fontSize: 18,
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                                SizedBox(height: 10),
                                Text(
                                  'Mobil yang digunakan: ${riwayat['mobil_id']}',
                                  style: TextStyle(fontSize: 16),
                                ),
                                SizedBox(height: 10),
                                Text(
                                  'Status: ${riwayat['status'] == 'accepted' ? 'Sedang dikerjakan' : 'Selesai'}',
                                  style: TextStyle(
                                    fontSize: 16,
                                    color: riwayat['status'] == 'finish' ? Colors.green : Colors.orange,
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                              ],
                            ),
                          ),
                        );
                      },
                    );
                  }
                },
              ),
            ),
          ],
        ),
      ),
      bottomNavigationBar: BottomNavigationBar(
        items: const <BottomNavigationBarItem>[
          BottomNavigationBarItem(
            icon: Icon(Icons.home),
            label: 'Beranda',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.assignment),
            label: 'Riwayat Tugas',
          ),
        ],
        selectedItemColor: Colors.blue,
        currentIndex: 1,
        onTap: (index) {
          if (index == 0) {
            Navigator.pushReplacementNamed(context, '/beranda');
          }
        },
      ),
    );
  }
}
