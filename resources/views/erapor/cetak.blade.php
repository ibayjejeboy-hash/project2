<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapor</title>

    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td, th { border: 1px solid black; padding: 5px; }
    </style>
</head>

<body>

<h2>RAPOR SISWA</h2>

<p>Nama: {{ $siswa->nama }}</p>
<p>NIS: {{ $siswa->nis }}</p>
<p>Kelas: {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
<p>Semester: {{ $nilai->semester ?? '-' }}</p>

<h3>Penilaian</h3>

<p>Agama: {{ $nilai->agama ?? '-' }}</p>
<p>Jati Diri: {{ $nilai->jati_diri ?? '-' }}</p>
<p>Literasi: {{ $nilai->literasi ?? '-' }}</p>

<h3>P5</h3>

<table>
<tr>
    <th>No</th>
    <th>Indikator</th>
    <th>Nilai</th>
</tr>

@foreach($indikator as $i => $item)
@php
    $cek = $nilaiP5->where('indikator_id', $item->id)->first();
@endphp
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $item->deskripsi }}</td>
    <td>{{ $cek->nilai ?? '-' }}</td>
</tr>
@endforeach

</table>

<h3>Profil Rahmatan Lil Alamin</h3>

<table>
<tr>
    <th>No</th>
    <th>Indikator</th>
    <th>Nilai</th>
</tr>

@foreach($indikatorRahmatan as $i => $item)
@php
    $cek = $nilaiRahmatan->where('indikator_id', $item->id)->first();
@endphp
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $item->deskripsi }}</td>
    <td>{{ $cek->nilai ?? '-' }}</td>
</tr>
@endforeach

</table>

</body>
</html>