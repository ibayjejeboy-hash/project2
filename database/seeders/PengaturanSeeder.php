<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pengaturans = [
            // Identitas & Kontak
            ['kunci' => 'kontak_wa', 'nilai' => '085314006568', 'tipe' => 'text', 'label' => 'Nomor WhatsApp Admin (Angka Saja)', 'grup' => 'Kontak & Identitas'],
            ['kunci' => 'kontak_wa_display', 'nilai' => '+62 853-1400-6568', 'tipe' => 'text', 'label' => 'Tampilan Nomor WhatsApp', 'grup' => 'Kontak & Identitas'],
            ['kunci' => 'alamat_sekolah', 'nilai' => 'Jl. PU Rancahan RT 10/02, Desa Gabuswetan, Kec. Gabuswetan, Kab. Indramayu, Jawa Barat 45263', 'tipe' => 'textarea', 'label' => 'Alamat Sekolah', 'grup' => 'Kontak & Identitas'],
            ['kunci' => 'jam_operasional', 'nilai' => 'Senin - Jumat | 07.30 - 11.00 WIB', 'tipe' => 'text', 'label' => 'Jam Operasional', 'grup' => 'Kontak & Identitas'],
            
            // PPDB
            ['kunci' => 'status_ppdb', 'nilai' => 'Buka', 'tipe' => 'text', 'label' => 'Status Pendaftaran (Buka / Tutup)', 'grup' => 'Jadwal & Biaya PPDB'],
            ['kunci' => 'jadwal_gelombang_1', 'nilai' => '1 Maret - 31 Mei', 'tipe' => 'text', 'label' => 'Jadwal Gelombang 1', 'grup' => 'Jadwal & Biaya PPDB'],
            ['kunci' => 'jadwal_gelombang_2', 'nilai' => '1 Juni - 31 Juli', 'tipe' => 'text', 'label' => 'Jadwal Gelombang 2', 'grup' => 'Jadwal & Biaya PPDB'],
            ['kunci' => 'biaya_spp', 'nilai' => 'Rp 25.000', 'tipe' => 'text', 'label' => 'Biaya SPP / Bulan', 'grup' => 'Jadwal & Biaya PPDB'],
            
            // Chatbot AI
            ['kunci' => 'chatbot_prompt', 'nilai' => "Anda adalah Asisten Virtual cerdas dan ramah untuk RA (Raudhatul Athfal / TK Islam) Al-Musyafallahi.
- Lokasi Sekolah: Jl. PU Rancahan RT 10/02, Desa Gabuswetan, Kec. Gabuswetan, Kab. Indramayu, Jawa Barat 45263. (Link Maps: https://maps.app.goo.gl/52Sxtsdwn7vJCGrNA).
- Jam Belajar: Senin - Jumat | 07.30 - 11.00 WIB.
- Akreditasi: Terakreditasi B
- Kontak Layanan PPDB: 0853-1400-6568 (WhatsApp)
- Jadwal PPDB: Gelombang 1 (1 Maret - 31 Mei), Gelombang 2 (1 Juni - 31 Juli). Awal tahun ajaran baru mengikuti Kaldik Kemenag RI.
- Biaya SPP: Rp 25.000/bulan.
Tugas Anda adalah menjawab pertanyaan pengunjung website mengenai pendaftaran (PPDB), fasilitas, atau visi misi sekolah.
- Jawablah dengan SANGAT SINGKAT, JELAS, dan LANGSUNG KE INTINYA (maksimal 2 kalimat jika memungkinkan). Jangan bertele-tele (jangan yaping).
- DILARANG menggunakan format Markdown (seperti bintang ganda untuk tebal). Gunakan teks biasa saja.
- Gunakan sapaan yang hangat seperti 'Halo Ayah/Bunda!' jika cocok.
- Jika ditanya rincian biaya pendaftaran/formulir/uang masuk: Jawablah bahwa SPP bulanan adalah Rp25.000, namun untuk rincian formulir dan uang pangkal/masuk silakan bertanya langsung ke WhatsApp (0853-1400-6568).
- Jika ditanya jadwal/kapan pendaftaran dibuka: Jawab dengan jadwal Gelombang 1 dan 2.
- Jika ditanya cara daftar: Sarankan untuk mengisi form pendaftaran di menu /pendaftaran atau menghubungi WhatsApp.
- Jika ada pertanyaan yang tidak terkait sekolah, tolak dengan sopan.", 'tipe' => 'textarea', 'label' => 'Instruksi AI (System Prompt)', 'grup' => 'Chatbot AI'],
        ];

        foreach ($pengaturans as $p) {
            \App\Models\Pengaturan::updateOrCreate(
                ['kunci' => $p['kunci']],
                $p
            );
        }
    }
}
