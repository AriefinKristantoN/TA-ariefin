import 'package:flutter/material.dart';
import 'package:mobile/detailtugas.dart';
import 'login.dart';
import 'beranda.dart';
import 'riwayat.dart';
import 'splashscreen.dart';
import 'tugas.dart';
import 'selesaitugas.dart';
import 'package:shared_preferences/shared_preferences.dart';

void main() {
  runApp(MonitoringKendaraanApp());
}

class MonitoringKendaraanApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return FutureBuilder(
      future: checkLoginStatus(),
      builder: (BuildContext context, AsyncSnapshot<bool> snapshot) {
        if (snapshot.connectionState == ConnectionState.waiting) {
          return CircularProgressIndicator(); // Menampilkan loading indicator selama proses pengecekan login
        } else {
          final isLoggedIn = snapshot.data ?? false;
          return MaterialApp(
            title: 'Monitoring Kendaraan',
            theme: ThemeData(
              primarySwatch: Colors.blue,
              visualDensity: VisualDensity.adaptivePlatformDensity,
            ),
            routes: {
              '/': (context) => isLoggedIn ? BerandaPage() : SplashScreen(), // Jika sudah login, arahkan langsung ke halaman beranda; jika tidak, arahkan ke splash screen
              '/login': (context) => LoginPage(),
              '/beranda': (context) => BerandaPage(),
              '/riwayat': (context) => RiwayatPage(),
              '/tugas': (context) => TugasPage(),
              '/detail_tugas': (context) => DetailTugasPage(tugas: ModalRoute.of(context)?.settings.arguments as Map<String, dynamic>),
              '/selesaitugas': (context) => SelesaiTugasPage(),
            },
            initialRoute: '/',
          );
        }
      },
    );
  }

  Future<bool> checkLoginStatus() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getString('driver_id') != null;
  }
}
