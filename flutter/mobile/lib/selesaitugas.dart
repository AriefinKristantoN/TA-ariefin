import 'package:flutter/material.dart';

class SelesaiTugasPage extends StatefulWidget {
  @override
  _SelesaiTugasPageState createState() => _SelesaiTugasPageState();
}

class _SelesaiTugasPageState extends State<SelesaiTugasPage> {
  TextEditingController kendalaController = TextEditingController();
  TextEditingController pelaporanBBMController = TextEditingController();
  TextEditingController pelaporanETolTujuanController = TextEditingController();
  

  @override
  void dispose() {
    // Pastikan untuk membebaskan sumber daya kontroler saat widget dihapus
    kendalaController.dispose();
    pelaporanBBMController.dispose();
    pelaporanETolTujuanController.dispose();
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Pelaporan Penugasan'),
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              _buildProfileInfo(title: 'Kendala', controller: kendalaController),
              SizedBox(height: 16),
              _buildProfileInfo(title: 'Pelaporan BBM', controller: pelaporanBBMController),
              SizedBox(height: 16),
              _buildProfileInfo(title: 'Pelaporan E-Tol', controller: pelaporanETolTujuanController),
              SizedBox(height: 16),
              
              Align(
                alignment: Alignment.center,
                child: ElevatedButton(
                  onPressed: () {
                    // Tambahkan aksi yang ingin dilakukan saat tombol "Simpan" ditekan
                  },
                  child: Text('Simpan'),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildProfileInfo({required String title, required TextEditingController controller}) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          title,
          style: TextStyle(
            color: Color(0xFF333333),
            fontSize: 17,
            fontFamily: 'Roboto',
            fontWeight: FontWeight.w500,
            letterSpacing: -0.17,
          ),
        ),
        SizedBox(height: 8),
        Container(
          width: double.infinity,
          decoration: BoxDecoration(
            border: Border.all(width: 1, color: Colors.black.withOpacity(0.15)),
            borderRadius: BorderRadius.circular(10),
          ),
          child: Padding(
            padding: const EdgeInsets.symmetric(horizontal: 12.0),
            child: TextField(
              controller: controller,
              style: TextStyle(
                color: Color(0xFF333333),
                fontSize: 17,
                fontFamily: 'Roboto',
                fontWeight: FontWeight.w400,
                letterSpacing: -0.17,
              ),
              decoration: InputDecoration(
                border: InputBorder.none,
                contentPadding: EdgeInsets.symmetric(vertical: 12.0), // Sesuaikan dengan kebutuhan Anda
              ),
            ),
          ),
        ),
      ],
    );
  }
}
