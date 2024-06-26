import 'package:flutter/material.dart';

class DetailTugasPage extends StatelessWidget {
  final Map<String, dynamic> tugas;

  DetailTugasPage({required this.tugas});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Detail Penugasan'),
      ),
      body: Padding(
        padding: EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              'Penugasan: ',
              style: TextStyle(
                fontSize: 24,
                fontWeight: FontWeight.bold,
              ),
            ),
            Text(
              '${tugas['penugasan']}',
              style: TextStyle(
                fontSize: 20,
              ),
            ),
            SizedBox(height: 20),
            Text(
              'Mobil yang digunakan: ${tugas['nopol']}',
              style: TextStyle(fontSize: 18),
            ),
            SizedBox(height: 20),
            // Tambahkan detail lain jika ada
            Text(
              'Detail Lainnya:',
              style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
            ),
            // // Contoh tambahan detail
            // Text(
            //   'Driver ID: ${tugas['driver_id']}',
            //   style: TextStyle(fontSize: 16),
            // ),
            Text(
              'Tanggal: ${tugas['tanggal']}',
              style: TextStyle(fontSize: 16),
            ),
            // Tambahkan detail sesuai kebutuhan
          ],
        ),
      ),
    );
  }
}
