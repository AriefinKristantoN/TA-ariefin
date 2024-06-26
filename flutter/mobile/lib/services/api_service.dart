import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/tugas.dart';

class ApiService {
  static Future<List<Tugas>> fetchTugas(int driverId) async {
    final String url = 'http://api.pnmrute/fetchTugas.php';

    final response = await http.post(
      Uri.parse(url),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
      },
      body: jsonEncode(<String, int>{
        'driver_id': driverId,
      }),
    );

    if (response.statusCode == 200) {
      final List<dynamic> responseData = jsonDecode(response.body);
      return responseData.map((json) => Tugas.fromJson(json)).toList();
    } else {
      throw Exception('Failed to load tasks');
    }
  }
}
