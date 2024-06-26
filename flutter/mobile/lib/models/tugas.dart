class Tugas {
  final int id;
  final String penugasan;
  final String nopol;
  final int driverId; // Tambahkan properti baru untuk driverId

  Tugas({
    required this.id,
    required this.penugasan,
    required this.nopol,
    required this.driverId,
  });

  factory Tugas.fromJson(Map<String, dynamic> json) {
    int driverId = json['driver_id'] is String ? int.tryParse(json['driver_id']) ?? 0 : json['driver_id'];

    return Tugas(
      id: json['id'] as int,
      penugasan: json['penugasan'] as String,
      nopol: json['nopol'] as String,
      driverId: driverId,
    );
  }
}
