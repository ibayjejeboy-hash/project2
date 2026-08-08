<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Capaian Perkembangan Siswa - {{ $siswa->nama }}</title>

    <style>
        @page {
            margin: 1.2cm 1.5cm 1.5cm 1.5cm;
            size: A4 portrait;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #1e293b;
            line-height: 1.45;
            margin: 0;
            padding: 0;
        }

        /* ================= KOP SURAT ================= */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #0f172a;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .kop-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .kop-text {
            text-align: center;
        }

        .kop-text h4 {
            margin: 0;
            font-size: 11px;
            font-weight: 700;
            color: #334155;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .kop-text h2 {
            margin: 2px 0 0 0;
            font-size: 15px;
            font-weight: 900;
            color: #065f46;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .kop-text p {
            margin: 2px 0 0 0;
            font-size: 9px;
            color: #64748b;
        }

        /* ================= JUDUL DOKUMEN ================= */
        .doc-title {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 14px;
        }

        .doc-title h3 {
            margin: 0;
            font-size: 12px;
            font-weight: 800;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .doc-title p {
            margin: 2px 0 0 0;
            font-size: 9.5px;
            font-weight: 600;
            color: #059669;
            text-transform: uppercase;
        }

        /* ================= IDENTITAS SISWA ================= */
        .identity-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
        }

        .identity-table td {
            border: none;
            padding: 4px 8px;
            font-size: 10px;
            vertical-align: top;
        }

        .identity-label {
            width: 15%;
            font-weight: 700;
            color: #475569;
        }

        .identity-separator {
            width: 2%;
            text-align: center;
        }

        .identity-val {
            width: 33%;
            font-weight: 600;
            color: #0f172a;
        }

        /* ================= SECTION STYLING ================= */
        .section-title {
            font-size: 11px;
            font-weight: 800;
            color: #065f46;
            background-color: #ecfdf5;
            padding: 4px 8px;
            border-left: 4px solid #059669;
            margin-top: 12px;
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        /* ================= DATA TABLES ================= */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .data-table th, .data-table td {
            border: 1px solid #94a3b8;
            padding: 5px 8px;
            font-size: 10px;
        }

        .data-table th {
            background-color: #f1f5f9;
            color: #1e293b;
            font-weight: 800;
            text-align: center;
        }

        .data-table td.narasi {
            text-align: justify;
            line-height: 1.4;
            color: #1e293b;
        }

        .data-table td.center {
            text-align: center;
            font-weight: 700;
        }

        .badge-nilai {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-weight: 800;
            font-size: 9px;
        }

        .badge-bsb { background-color: #dcfce7; color: #166534; }
        .badge-bsh { background-color: #e0f2fe; color: #075985; }
        .badge-mb  { background-color: #fef3c7; color: #92400e; }
        .badge-bb  { background-color: #fee2e2; color: #991b1b; }

        /* ================= TANDA TANGAN ================= */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .signature-table td {
            border: none;
            padding: 0;
            text-align: center;
            font-size: 10px;
            vertical-align: top;
            width: 33.33%;
        }

        .sign-title {
            font-weight: 600;
            color: #475569;
            margin-bottom: 50px;
        }

        .sign-name {
            font-weight: 800;
            color: #0f172a;
            text-decoration: underline;
            margin-bottom: 2px;
        }

        .sign-role {
            font-size: 9px;
            color: #64748b;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    {{-- KOP SURAT MADRASAH --}}
    <table class="kop-table">
        <tr>
            <td class="kop-text">
                <h4>KEMENTERIAN AGAMA REPUBLIK INDONESIA</h4>
                <h4>KANTOR KEMENTERIAN AGAMA KABUPATEN INDRAMAYU</h4>
                <h2>RA AL-MUSYAFALLAHI GABUSWETAN</h2>
                <p>
                    NSM: 101232120099 &bull; NPSN: 69987654 &bull; Status: Terakreditasi B<br>
                    Jl. Raya Gabuswetan No. 12, Kec. Gabuswetan, Kab. Indramayu, Jawa Barat 45263 | Email: ra.almusyafallahi@gmail.com
                </p>
            </td>
        </tr>
    </table>

    {{-- JUDUL RAPOR --}}
    <div class="doc-title">
        <h3>LAPORAN CAPAIAN PERKEMBANGAN PESERTA DIDIK</h3>
        <p>KURIKULUM MERDEKA &bull; RAUDHATUL ATHFAL</p>
    </div>

    {{-- TABEL IDENTITAS SISWA --}}
    <table class="identity-table">
        <tr>
            <td class="identity-label">Nama Peserta Didik</td>
            <td class="identity-separator">:</td>
            <td class="identity-val">{{ strtoupper($siswa->nama) }}</td>

            <td class="identity-label">Kelompok / Kelas</td>
            <td class="identity-separator">:</td>
            <td class="identity-val">{{ $siswa->kelas->nama_kelas ?? 'Kelompok RA' }}</td>
        </tr>
        <tr>
            <td class="identity-label">NIS / NISN</td>
            <td class="identity-separator">:</td>
            <td class="identity-val">{{ $siswa->nis ?? '-' }}</td>

            <td class="identity-label">Semester / TP</td>
            <td class="identity-separator">:</td>
            <td class="identity-val">Semester {{ $nilai->semester ?? '1' }} (2026/2027)</td>
        </tr>
        <tr>
            <td class="identity-label">Wali Kelas</td>
            <td class="identity-separator">:</td>
            <td class="identity-val">{{ $siswa->kelas->waliKelas->name ?? 'Dewi Sartika, S.Pd.I' }}</td>

            <td class="identity-label">Fase Perkembangan</td>
            <td class="identity-separator">:</td>
            <td class="identity-val">Fase Fondasi (PAUD/RA)</td>
        </tr>
    </table>

    {{-- SECTION I: CAPAIAN PEMBELAJARAN (3 ELEMEN) --}}
    <div class="section-title">I. CAPAIAN PEMBELAJARAN (DESKRIPSI NARASI PERKEMBANGAN)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Elemen Capaian</th>
                <th style="width: 70%;">Deskripsi Capaian Perkembangan Anak</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center">1</td>
                <td><strong>Nilai Agama &amp; Budi Pekerti</strong></td>
                <td class="narasi">
                    {{ $nilai->agama ?? 'Ananda berkembang dengan sangat baik dalam mengenal nilai-nilai agama Islam, gemar melafalkan doa-doa harian, hafalan surah-surah pendek juz 30, serta menunjukkan perilaku santun, jujur, dan menyayangi teman sebaya.' }}
                </td>
            </tr>
            <tr>
                <td class="center">2</td>
                <td><strong>Jati Diri</strong></td>
                <td class="narasi">
                    {{ $nilai->jati_diri ?? 'Ananda menunjukkan kemandirian yang matang, mampu mengekspresikan emosi secara wajar, aktif dalam aktivitas motorik kasar dan halus, serta berdisiplin merapikan perlengkapan belajar.' }}
                </td>
            </tr>
            <tr>
                <td class="center">3</td>
                <td><strong>Dasar Literasi, Matematika, Sains, Teknologi, Rekayasa, dan Seni (STEAM)</strong></td>
                <td class="narasi">
                    {{ $nilai->literasi ?? 'Ananda memiliki rasa ingin tahu yang tinggi, aktif mengamati lingkungan sekitar, mengenali konsep bilangan dan simbol huruf awal, serta gemar berkreasi membuat karya seni rupa.' }}
                </td>
            </tr>
        </tbody>
    </table>

    {{-- SECTION II: P5 --}}
    <div class="section-title">II. PROJEK PENGUATAN PROFIL PELAJAR PANCASILA (P5)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 75%;">Dimensi &amp; Indikator Perkembangan P5</th>
                <th style="width: 20%;">Capaian</th>
            </tr>
        </thead>
        <tbody>
            @forelse($indikator as $i => $item)
            @php
                $cek = $nilaiP5->where('indikator_id', $item->id)->first();
                $val = strtolower($cek->nilai ?? 'baik');
            @endphp
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td class="center">
                    @if(in_array($val, ['bsb', 'sangat_baik']))
                        <span class="badge-nilai badge-bsb">BSB (Sangat Baik)</span>
                    @elseif(in_array($val, ['bsh', 'baik']))
                        <span class="badge-nilai badge-bsh">BSH (Sesuai Harapan)</span>
                    @elseif(in_array($val, ['mb', 'cukup']))
                        <span class="badge-nilai badge-mb">MB (Mulai Berkembang)</span>
                    @elseif(in_array($val, ['bb', 'kurang']))
                        <span class="badge-nilai badge-bb">BB (Belum Berkembang)</span>
                    @else
                        <span class="badge-nilai badge-bsh">BSH (Sesuai Harapan)</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td class="center">1</td>
                <td>Beriman, Bertakwa kepada Tuhan YME, dan Berakhlak Mulia</td>
                <td class="center"><span class="badge-nilai badge-bsb">BSB (Sangat Baik)</span></td>
            </tr>
            <tr>
                <td class="center">2</td>
                <td>Bergotong Royong dan Peduli Sesama Teman</td>
                <td class="center"><span class="badge-nilai badge-bsh">BSH (Sesuai Harapan)</span></td>
            </tr>
            <tr>
                <td class="center">3</td>
                <td>Mandiri dan Bertanggung Jawab</td>
                <td class="center"><span class="badge-nilai badge-bsh">BSH (Sesuai Harapan)</span></td>
            </tr>
            <tr>
                <td class="center">4</td>
                <td>Kreatif dalam Mengeksplorasi Ide Baru</td>
                <td class="center"><span class="badge-nilai badge-bsb">BSB (Sangat Baik)</span></td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- SECTION III: PROFIL PELAJAR RAHMATAN LIL ALAMIN (PPRA) --}}
    <div class="section-title">III. PROFIL PELAJAR RAHMATAN LIL ALAMIN (PPRA)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 75%;">Nilai Karakter Moderasi Beragama (PPRA)</th>
                <th style="width: 20%;">Capaian</th>
            </tr>
        </thead>
        <tbody>
            @forelse($indikatorRahmatan as $i => $item)
            @php
                $cek = $nilaiRahmatan->where('indikator_id', $item->id)->first();
                $val = strtolower($cek->nilai ?? 'baik');
            @endphp
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td class="center">
                    @if(in_array($val, ['bsb', 'sangat_baik']))
                        <span class="badge-nilai badge-bsb">BSB (Sangat Baik)</span>
                    @elseif(in_array($val, ['bsh', 'baik']))
                        <span class="badge-nilai badge-bsh">BSH (Sesuai Harapan)</span>
                    @elseif(in_array($val, ['mb', 'cukup']))
                        <span class="badge-nilai badge-mb">MB (Mulai Berkembang)</span>
                    @elseif(in_array($val, ['bb', 'kurang']))
                        <span class="badge-nilai badge-bb">BB (Belum Berkembang)</span>
                    @else
                        <span class="badge-nilai badge-bsh">BSH (Sesuai Harapan)</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td class="center">1</td>
                <td>Berkeadaban (Ta'addub) - Menunjukkan sopan santun dan adab mulia</td>
                <td class="center"><span class="badge-nilai badge-bsb">BSB (Sangat Baik)</span></td>
            </tr>
            <tr>
                <td class="center">2</td>
                <td>Keteladanan (Qudwah) - Menjadi contoh baik bagi teman</td>
                <td class="center"><span class="badge-nilai badge-bsh">BSH (Sesuai Harapan)</span></td>
            </tr>
            <tr>
                <td class="center">3</td>
                <td>Mengambil Jalan Tengah (Tawassuth) - Bersikap adil dan damai</td>
                <td class="center"><span class="badge-nilai badge-bsh">BSH (Sesuai Harapan)</span></td>
            </tr>
            <tr>
                <td class="center">4</td>
                <td>Toleransi (Tasamuh) - Menghargai perbedaan dan tolong menolong</td>
                <td class="center"><span class="badge-nilai badge-bsb">BSB (Sangat Baik)</span></td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- KETERANGAN SINGKAT NILAI --}}
    <p style="font-size: 8.5px; color: #64748b; margin-top: 4px; margin-bottom: 14px;">
        * Keterangan Capaian: <strong>BB</strong> = Belum Berkembang | <strong>MB</strong> = Mulai Berkembang | <strong>BSH</strong> = Berkembang Sesuai Harapan | <strong>BSB</strong> = Berkembang Sangat Baik
    </p>

    {{-- LEMBAR PENGESAHAN TANDA TANGAN --}}
    <table class="signature-table">
        <tr>
            <td>
                <div class="sign-title">
                    Mengetahui,<br>
                    Orang Tua / Wali Murid
                </div>
                <div class="sign-name">
                    ( ......................................... )
                </div>
            </td>
            <td>
                <div class="sign-title">
                    Mengetahui,<br>
                    Kepala RA Al-Musyafallahi
                </div>
                <div class="sign-name">
                    Hj. Siti Aminah, S.Pd.I
                </div>
                <div class="sign-role">NIP. 19780512 200501 2 004</div>
            </td>
            <td>
                <div class="sign-title">
                    Indramayu, {{ date('d F Y') }}<br>
                    Wali Kelas
                </div>
                <div class="sign-name">
                    {{ $siswa->kelas->waliKelas->name ?? 'Dewi Sartika, S.Pd.I' }}
                </div>
                <div class="sign-role">NUPTK. 8452760662300092</div>
            </td>
        </tr>
    </table>

</body>
</html>