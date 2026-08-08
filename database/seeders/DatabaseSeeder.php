<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Indikator;
use App\Models\Nilai;
use App\Models\NilaiCheck;
use App\Models\Informasi;
use App\Models\Galeri;
use App\Models\Pendaftaran;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // =========================================================================
        // 1. SEED USER ADMIN & GURU
        // =========================================================================
        $admin = User::firstOrCreate(
            ['email' => 'admin@almusyafallahi.id'],
            [
                'name'     => 'Administrator RA Al-Musyafallahi',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );

        $guruA = User::firstOrCreate(
            ['email' => 'guru.fatimah@almusyafallahi.id'],
            [
                'name'     => 'Ustadzah Fatimah, S.Pd.I',
                'password' => Hash::make('password123'),
                'role'     => 'guru',
            ]
        );

        $guruB = User::firstOrCreate(
            ['email' => 'guru.aisyah@almusyafallahi.id'],
            [
                'name'     => 'Ustadzah Aisyah, S.Pd',
                'password' => Hash::make('password123'),
                'role'     => 'guru',
            ]
        );

        // =========================================================================
        // 2. SEED KELAS & WALI KELAS
        // =========================================================================
        $kelasA = Kelas::firstOrCreate(
            ['nama_kelas' => 'Kelompok A (Usia 4-5 Tahun)'],
            ['wali_kelas_id' => $guruA->id]
        );

        $kelasB = Kelas::firstOrCreate(
            ['nama_kelas' => 'Kelompok B (Usia 5-6 Tahun)'],
            ['wali_kelas_id' => $guruB->id]
        );

        // =========================================================================
        // 3. SEED INDIKATOR KURIKULUM MERDEKA (P5 & PROFIL PPRA)
        // =========================================================================
        $indikators = [
            // P5
            [
                'dimensi'   => 'Beriman, Bertakwa Kepada Tuhan YME, & Berakhlak Mulia',
                'elemen'    => 'Akhlak Beragama',
                'deskripsi' => 'Mengenal dan mempraktikkan doa harian, surat pendek, serta adab Islami',
                'kategori'  => 'p5',
            ],
            [
                'dimensi'   => 'Mandiri',
                'elemen'    => 'Pemahaman Diri & Regulasi Diri',
                'deskripsi' => 'Mampu melakukan kegiatan bina diri (makan, memakai sepatu, merapikan mainan) secara mandiri',
                'kategori'  => 'p5',
            ],
            [
                'dimensi'   => 'Bergotong Royong',
                'elemen'    => 'Kolaborasi & Kepedulian',
                'deskripsi' => 'Terbiasa berbagi makanan/mainan dan bekerja sama dalam aktivitas kelompok bersama teman',
                'kategori'  => 'p5',
            ],
            [
                'dimensi'   => 'Bernalar Kritis',
                'elemen'    => 'Memperoleh & Memproses Informasi',
                'deskripsi' => 'Menunjukkan rasa ingin tahu tinggi, gemar bertanya, dan mengeksplorasi lingkungan sekitar',
                'kategori'  => 'p5',
            ],
            [
                'dimensi'   => 'Kreatif',
                'elemen'    => 'Menghasilkan Karya & Gagasan Orisinal',
                'deskripsi' => 'Mampu mengekspresikan ide melalui karya seni (menggambar, membentuk plastisin, bernyanyi)',
                'kategori'  => 'p5',
            ],
            // Profil Rahmatan Lil Alamin (PPRA)
            [
                'dimensi'   => 'Berkeadaban (Ta\'addub)',
                'elemen'    => 'Sopan Santun Islami',
                'deskripsi' => 'Menunjukkan adab mulia kepada guru, orang tua, dan teman dengan senyum, sapa, dan salam',
                'kategori'  => 'profil',
            ],
            [
                'dimensi'   => 'Keteladanan (Qudwah)',
                'elemen'    => 'Perilaku Terpuji',
                'deskripsi' => 'Menjadi contoh kebaikan bagi teman dalam menjaga kebersihan dan ketertiban kelas',
                'kategori'  => 'profil',
            ],
            [
                'dimensi'   => 'Lurus dan Tegas (I\'tidal)',
                'elemen'    => 'Keadilan & Kejujuran',
                'deskripsi' => 'Terbiasa berkata jujur dan antre dengan tertib saat bergiliran bermain atau cuci tangan',
                'kategori'  => 'profil',
            ],
            [
                'dimensi'   => 'Toleransi (Tasamuh)',
                'elemen'    => 'Menghargai Perbedaan',
                'deskripsi' => 'Menghargai dan menerima perbedaan teman dalam bermain tanpa membeda-bedakan',
                'kategori'  => 'profil',
            ],
        ];

        foreach ($indikators as $ind) {
            Indikator::firstOrCreate(
                [
                    'dimensi'  => $ind['dimensi'],
                    'elemen'   => $ind['elemen'],
                    'kategori' => $ind['kategori'],
                ],
                ['deskripsi' => $ind['deskripsi']]
            );
        }

        // =========================================================================
        // 4. SEED DATA SISWA & AKUN LOGIN SISWA
        // =========================================================================
        $siswaUsers = [
            [
                'name'             => 'Muhammad Rayyan Al-Farizi',
                'email'            => 'rayyan@almusyafallahi.id',
                'nama_panggilan'   => 'Rayyan',
                'nis'              => '202601001',
                'kelas_id'         => $kelasA->id,
                'jenis_kelamin'    => 'Laki-laki',
                'tempat_lahir'     => 'Bandung',
                'tanggal_lahir'    => '2020-04-12',
                'agama'            => 'Islam',
                'anak_ke'          => 1,
                'nama_ayah'        => 'Ahmad Farizi',
                'nama_ibu'         => 'Nurul Hidayah',
                'no_hp'            => '081234567890',
                'pekerjaan_ayah'   => 'Wiraswasta',
                'pekerjaan_ibu'    => 'Ibu Rumah Tangga',
                'alamat'           => 'Jl. Terusan Al-Musyafallahi No. 12',
                'kode_pos'         => '40286',
                'kecamatan'        => 'Margacinta',
                'kota'             => 'Kota Bandung',
                'provinsi'         => 'Jawa Barat',
                'tanggal_diterima' => '2025-07-15',
            ],
            [
                'name'             => 'Zahra Khairunnisa',
                'email'            => 'zahra@almusyafallahi.id',
                'nama_panggilan'   => 'Zahra',
                'nis'              => '202601002',
                'kelas_id'         => $kelasA->id,
                'jenis_kelamin'    => 'Perempuan',
                'tempat_lahir'     => 'Bandung',
                'tanggal_lahir'    => '2020-08-25',
                'agama'            => 'Islam',
                'anak_ke'          => 2,
                'nama_ayah'        => 'Bambang Pratama',
                'nama_ibu'         => 'Siti Rahmah',
                'no_hp'            => '081298765432',
                'pekerjaan_ayah'   => 'Karyawan Swasta',
                'pekerjaan_ibu'    => 'Guru',
                'alamat'           => 'Jl. Pesantren No. 45',
                'kode_pos'         => '40287',
                'kecamatan'        => 'Buahbatu',
                'kota'             => 'Kota Bandung',
                'provinsi'         => 'Jawa Barat',
                'tanggal_diterima' => '2025-07-15',
            ],
            [
                'name'             => 'Alvaro Malik Ibrahim',
                'email'            => 'alvaro@almusyafallahi.id',
                'nama_panggilan'   => 'Alvaro',
                'nis'              => '202602001',
                'kelas_id'         => $kelasB->id,
                'jenis_kelamin'    => 'Laki-laki',
                'tempat_lahir'     => 'Bandung',
                'tanggal_lahir'    => '2019-11-15',
                'agama'            => 'Islam',
                'anak_ke'          => 1,
                'nama_ayah'        => 'Ibrahim Malik',
                'nama_ibu'         => 'Dewi Anggraeni',
                'no_hp'            => '085612345678',
                'pekerjaan_ayah'   => 'PNS',
                'pekerjaan_ibu'    => 'Dokter',
                'alamat'           => 'Komplek Asri No. 8',
                'kode_pos'         => '40264',
                'kecamatan'        => 'Lengkong',
                'kota'             => 'Kota Bandung',
                'provinsi'         => 'Jawa Barat',
                'tanggal_diterima' => '2024-07-15',
            ],
        ];

        foreach ($siswaUsers as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'     => $data['name'],
                    'password' => Hash::make('password123'),
                    'role'     => 'siswa',
                ]
            );

            $siswa = Siswa::updateOrCreate(
                ['nis' => $data['nis']],
                [
                    'nama'             => $data['name'],
                    'nama_panggilan'   => $data['nama_panggilan'],
                    'kelas_id'         => $data['kelas_id'],
                    'jenis_kelamin'    => $data['jenis_kelamin'],
                    'user_id'          => $user->id,
                    'tempat_lahir'     => $data['tempat_lahir'],
                    'tanggal_lahir'    => $data['tanggal_lahir'],
                    'agama'            => $data['agama'],
                    'anak_ke'          => $data['anak_ke'],
                    'nama_ayah'        => $data['nama_ayah'],
                    'nama_ibu'         => $data['nama_ibu'],
                    'no_hp'            => $data['no_hp'],
                    'email'            => $data['email'],
                    'pekerjaan_ayah'   => $data['pekerjaan_ayah'],
                    'pekerjaan_ibu'    => $data['pekerjaan_ibu'],
                    'alamat'           => $data['alamat'],
                    'kode_pos'         => $data['kode_pos'],
                    'kecamatan'        => $data['kecamatan'],
                    'kota'             => $data['kota'],
                    'provinsi'         => $data['provinsi'],
                    'tanggal_diterima' => $data['tanggal_diterima'],
                ]
            );

            // =====================================================================
            // 5. SEED NILAI RAPOR PERDANA UNTUK SISWA RAYYAN
            // =====================================================================
            if ($siswa->nis === '202601001') {
                $nilai = Nilai::updateOrCreate(
                    ['siswa_id' => $siswa->id],
                    [
                        'agama'     => 'Ananda Rayyan menunjukkan perkembangan yang sangat baik dalam melafalkan doa sebelum dan sesudah belajar, hafalan surat-surat pendek (Al-Fatihah, An-Nas, Al-Ikhlas), serta gemar mempraktikkan gerakan salat dhuha berjamaah.',
                        'jati_diri' => 'Ananda mandiri dalam mengelola barang bawaan sendiri, terbiasa merapikan mainan setelah digunakan, dan memiliki rasa percaya diri yang baik saat berbicara di depan kelas.',
                        'literasi'  => 'Ananda mampu mengenali simbol huruf hijaiyah dan abjad dengan sangat baik, antusias mendengarkan dongeng, serta mampu menceritakan kembali isi gambar yang dilihatnya.',
                        'semester'  => '1',
                    ]
                );

                // Checklists
                $allIndikators = Indikator::all();
                foreach ($allIndikators as $ind) {
                    NilaiCheck::updateOrCreate(
                        [
                            'siswa_id'     => $siswa->id,
                            'indikator_id' => $ind->id,
                        ],
                        [
                            'nilai'    => 'sangat_baik',
                            'kategori' => $ind->kategori,
                        ]
                    );
                }
            }
        }

        // =========================================================================
        // 6. SEED INFORMASI PROFIL SEKOLAH (VISI, MISI, DESKRIPSI)
        // =========================================================================
        Informasi::updateOrCreate(
            ['id' => 1],
            [
                'visi'      => 'Mewujudkan Generasi Qur\'ani yang Berakhlak Mulia, Cerdas, Kreatif, dan Mandiri Sejak Usia Dini.',
                'misi'      => "1. Menanamkan nilai-nilai keislaman dan kecintaan terhadap Al-Qur'an sejak usia dini.\n2. Mengembangkan potensi kecerdasan intelektual, emosional, dan spiritual anak secara seimbang.\n3. Membiasakan perilaku mandiri, disiplin, dan berakhlak terpuji dalam kehidupan sehari-hari.\n4. Menyelenggarakan pembelajaran yang aktif, inovatif, kreatif, efektif, dan menyenangkan (PAIKEM).",
                'deskripsi' => 'Raudhatul Athfal (RA) Al-Musyafallahi berkomitmen menghadirkan pendidikan anak usia dini berkualitas berbasis nilai-nilai Islam dan Kurikulum Merdeka.',
                'foto'      => null,
            ]
        );

        // =========================================================================
        // 7. SEED CONTOH GALERI KEGIATAN
        // =========================================================================
        $galeris = [
            ['judul' => 'Peringatan Maulid Nabi Muhammad SAW di RA Al-Musyafallahi', 'gambar' => 'galeri/sample1.jpg'],
            ['judul' => 'Praktik Manasik Haji Cilik RA Al-Musyafallahi', 'gambar' => 'galeri/sample2.jpg'],
            ['judul' => 'Kegiatan Belajar Sentra Sains dan Motorik Halus', 'gambar' => 'galeri/sample3.jpg'],
        ];

        foreach ($galeris as $g) {
            Galeri::firstOrCreate(['judul' => $g['judul']], ['gambar' => $g['gambar']]);
        }

        // =========================================================================
        // 8. SEED CONTOH PENDAFTARAN SISWA BARU
        // =========================================================================
        $pendaftarans = [
            [
                'nama_anak' => 'Ahmad Fathan Al-Ghifari',
                'tgl_lahir' => '2021-02-10',
                'nama_ortu' => 'Ridwan Ghifari',
                'no_hp'     => '081211223344',
                'alamat'    => 'Jl. Margacinta Asri No. 19, Bandung',
                'status'    => 'pending',
            ],
            [
                'nama_anak' => 'Aisyah Humaira',
                'tgl_lahir' => '2021-05-18',
                'nama_ortu' => 'Hendra Kurniawan',
                'no_hp'     => '081399887766',
                'alamat'    => 'Jl. Cipamokolan Regency No. B-3, Bandung',
                'status'    => 'diterima',
            ],
        ];

        foreach ($pendaftarans as $p) {
            Pendaftaran::firstOrCreate(['nama_anak' => $p['nama_anak']], $p);
        }
    }
}
