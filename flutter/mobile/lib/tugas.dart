import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'dart:convert';
import 'package:http/http.dart' as http;

class TugasPage extends StatefulWidget {
  @override
  _TugasPageState createState() => _TugasPageState();
}

class _TugasPageState extends State<TugasPage> {
  late Future<List<Map<String, dynamic>>> _futureTugas;

  @override
  void initState() {
    super.initState();
    _futureTugas = _loadTugas();
  }

  Future<List<Map<String, dynamic>>> _loadTugas() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    String? driverIdString = prefs.getString('driver_id');
    if (driverIdString != null) {
      try {
        final String url = 'http://api.pnmrute.com/fetchtugas.php';
        //  final String url = 'http://192.168.100.15/fetchTugas.php';

        
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
          throw Exception('Failed to load tasks');
        }
      } catch (e) {
        return Future.error("Invalid driver ID format");
      }
    } else {
      return Future.error("Driver ID not found");
    }
  }

  Future<void> _acceptTask(Map<String, dynamic> task) async {
    try {
      final String url = 'http://api.pnmrute.com/acceptTugas.php';
      // final String url = 'http://192.168.100.15/acceptTugas.php';
      final response = await http.post(
        Uri.parse(url),
        headers: <String, String>{
          'Content-Type': 'application/json; charset=UTF-8',
        },
        body: jsonEncode(<String, dynamic>{
          'task_id': task['id'],
        }),
      );

      if (response.statusCode == 200) {
        // Update the list of tasks by removing the accepted task
        setState(() {
          _futureTugas = _futureTugas.then((tasks) {
            return tasks.where((t) => t['id'] != task['id']).toList();
          });
        });

        Navigator.pushNamed(context, '/riwayat');
      } else {
        throw Exception('Failed to accept task');
      }
    } catch (e) {
      print("Error accepting task: $e");
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Tugas'),
      ),
      body: Padding(
        padding: EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          children: [
            SizedBox(height: 20),
            Text(
              'Penugasan',
              style: TextStyle(
                fontSize: 24,
                fontWeight: FontWeight.bold,
              ),
            ),
            SizedBox(height: 20),
            Expanded(
              child: FutureBuilder<List<Map<String, dynamic>>>(
                future: _futureTugas,
                builder: (context, snapshot) {
                  if (snapshot.connectionState == ConnectionState.waiting) {
                    return Center(child: CircularProgressIndicator());
                  } else if (snapshot.hasError) {
                    return Center(child: Text('Error: ${snapshot.error}'));
                  } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
                    return Center(child: Text('No tasks found'));
                  } else {
                    return ListView.builder(
                      itemCount: snapshot.data!.length,
                      itemBuilder: (context, index) {
                        final tugas = snapshot.data![index];
                        return Card(
                          elevation: 3,
                          child: Column(
                            children: [
                              ListTile(
                                title: Text(
                                  'Penugasan: ${tugas['penugasan']}',
                                  style: TextStyle(
                                    fontSize: 18,
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                                subtitle: Text(
                                  'Mobil yang digunakan: ${tugas['mobil_id']}',
                                  style: TextStyle(fontSize: 16),
                                ),
                                onTap: () {
                                  Navigator.pushNamed(
                                    context,
                                    '/detail_tugas',
                                    arguments: tugas,
                                  );
                                },
                              ),
                              Padding(
                                padding: EdgeInsets.symmetric(
                                    horizontal: 16.0, vertical: 8.0),
                                child: ElevatedButton(
                                  onPressed: () => _acceptTask(tugas),
                                  child: Text('Terima Tugas'),
                                ),
                              ),
                            ],
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
    );
  }
}