<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $judulDokumen }} - RA Al-Musyafallahi</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        @page {
            size: A4 portrait;
            margin: 1.2cm 1.5cm 1.5cm 1.5cm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #0f172a;
            background: #ffffff;
            margin: 0;
            padding: 0;
            font-size: 11px;
            line-height: 1.4;
        }

        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 10px;
        }

        /* ================= KOP SURAT RESMI ================= */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #0f172a;
            padding-bottom: 8px;
            margin-bottom: 16px;
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
            font-size: 16px;
            font-weight: 900;
            color: #065f46;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .kop-text p {
            margin: 3px 0 0 0;
            font-size: 9.5px;
            color: #475569;
            line-height: 1.35;
        }

        /* ================= JUDUL DOKUMEN ================= */
        .doc-title {
            text-align: center;
            margin-bottom: 16px;
        }

        .doc-title h3 {
            margin: 0;
            font-size: 13px;
            font-weight: 800;
            color: #0f172a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .doc-title p {
            margin: 3px 0 0 0;
            font-size: 10px;
            color: #059669;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* ================= GRID FOTO DOKUMENTASI ================= */
        .galeri-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .galeri-card {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
            background: #ffffff;
            page-break-inside: avoid;
            display: flex;
            flex-direction: column;
        }

        .galeri-img-wrap {
            width: 100%;
            height: 180px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-bottom: 1px solid #e2e8f0;
        }

        .galeri-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .galeri-info {
            padding: 10px 12px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .galeri-info h4 {
            margin: 0 0 4px 0;
            font-size: 11px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.3;
        }

        .galeri-info p {
            margin: 0 0 6px 0;
            font-size: 9.5px;
            color: #64748b;
            line-height: 1.35;
        }

        .galeri-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 9px;
            color: #64748b;
            border-top: 1px dashed #e2e8f0;
            padding-top: 6px;
            margin-top: auto;
        }

        .badge-kategori {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 8.5px;
            text-transform: uppercase;
        }

        .badge-siswa {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .badge-guru {
            background: #f5f3ff;
            color: #5b21b6;
            border: 1px solid #ddd6fe;
        }

        /* ================= TANDA TANGAN ================= */
        .sign-section {
            width: 100%;
            margin-top: 25px;
            page-break-inside: avoid;
        }

        .sign-table {
            width: 100%;
            border-collapse: collapse;
        }

        .sign-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            font-size: 10px;
        }

        .sign-space {
            height: 60px;
        }

        .sign-name {
            font-weight: 800;
            color: #0f172a;
            text-decoration: underline;
        }

        /* ================= ACTION BAR (NO PRINT) ================= */
        .no-print {
            background: #0f172a;
            color: white;
            padding: 12px 20px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-print {
            background: #10b981;
            color: white;
        }

        .btn-print:hover {
            background: #059669;
        }

        .btn-back {
            background: #334155;
            color: white;
        }

        .btn-back:hover {
            background: #475569;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .container {
                max-width: 100%;
                padding: 0;
            }

            .galeri-card {
                box-shadow: none !important;
            }
        }
    </style>
</head>
<body>

    {{-- Floating Action Bar --}}
    <div class="no-print">
        <div style="display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-print" style="font-size: 18px; color: #34d399;"></i>
            <div>
                <strong style="font-size: 13px;">Format Lembar Dokumentasi Siap Cetak (A4)</strong>
                <span style="font-size: 11px; opacity: 0.8; display: block;">Total Foto: {{ count($galeris) }} kegiatan | RA Al-Musyafallahi</span>
            </div>
        </div>
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('galeri') }}" class="btn btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Galeri
            </a>
            <button onclick="window.print()" class="btn btn-print">
                <i class="fa-solid fa-print"></i> Cetak Dokumen / Simpan PDF
            </button>
        </div>
    </div>

    <div class="container">

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

        {{-- JUDUL DOKUMEN --}}
        <div class="doc-title">
            <h3>{{ $judulDokumen }}</h3>
            <p>DOKUMENTASI FOTO DIGITAL AKTIVITAS & PEMBELAJARAN</p>
        </div>

        {{-- GRID FOTO DOKUMENTASI --}}
        <div class="galeri-grid">
            @forelse($galeris as $item)
            <div class="galeri-card">
                <div class="galeri-img-wrap">
                    <img src="{{ $item->gambar_url }}" alt="{{ $item->judul }}">
                </div>
                <div class="galeri-info">
                    <div>
                        <h4>{{ $item->judul }}</h4>
                        @if($item->deskripsi)
                        <p>{{ $item->deskripsi }}</p>
                        @endif
                    </div>
                    <div class="galeri-meta">
                        <span>
                            <i class="fa-regular fa-calendar"></i>
                            {{ $item->tanggal_kegiatan ? $item->tanggal_kegiatan->translatedFormat('d F Y') : ($item->created_at ? $item->created_at->format('d/m/Y') : '-') }}
                        </span>
                        <span class="badge-kategori {{ $item->kategori === 'kegiatan_guru' ? 'badge-guru' : 'badge-siswa' }}">
                            {{ $item->kategori_label }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: span 2; text-align: center; padding: 40px; color: #94a3b8; border: 1px dashed #cbd5e1; border-radius: 8px;">
                <p>Belum ada dokumentasi foto untuk kategori ini.</p>
            </div>
            @endforelse
        </div>

        {{-- TANDA TANGAN & PENGESAHAN --}}
        <div class="sign-section">
            <table class="sign-table">
                <tr>
                    <td>
                        <br>
                        Guru Pendamping Kegiatan,
                        <div class="sign-space"></div>
                        <div class="sign-name">( ............................................ )</div>
                        <div>NIP / PegID : -</div>
                    </td>
                    <td>
                        Indramayu, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
                        Mengetahui,<br>
                        <strong>Kepala RA Al-Musyafallahi</strong>
                        <div class="sign-space"></div>
                        <div class="sign-name">Yoyoh Muasyarotul Muzayyanati S.Pd.I</div>
                        <div></div>
                    </td>
                </tr>
            </table>
        </div>

    </div>

</body>
</html>

