<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500'
        ]);

        $apiKey = config('services.gemini.key');
        if (!$apiKey) {
            return response()->json(['error' => 'Sistem AI sedang dalam perbaikan.'], 500);
        }

        // System instructions to act as the school assistant
        $systemInstruction = "Anda adalah Asisten Virtual cerdas dan ramah untuk RA (Raudhatul Athfal / TK Islam) Al-Musyafallahi.
- Lokasi Sekolah: Jl. PU Rancahan RT 10/02, Desa Gabuswetan, Kec. Gabuswetan, Kab. Indramayu, Jawa Barat 45263. (Link Maps: https://maps.app.goo.gl/52Sxtsdwn7vJCGrNA).
- Jam Belajar: Senin - Jumat | 07.30 - 11.00 WIB.
Tugas Anda adalah menjawab pertanyaan pengunjung website mengenai pendaftaran (PPDB), fasilitas, atau visi misi sekolah.
- Jawablah dengan SANGAT SINGKAT, JELAS, dan LANGSUNG KE INTINYA (maksimal 2 kalimat jika memungkinkan). Jangan bertele-tele (jangan yaping).
- DILARANG menggunakan format Markdown (seperti bintang ganda untuk tebal). Gunakan teks biasa saja.
- Gunakan sapaan yang hangat seperti 'Halo Ayah/Bunda!' jika cocok.
- Jika ditanya biaya pendaftaran atau rincian biaya: Jawablah bahwa saat ini Anda belum memiliki rincian biaya pasti (estimasi siswa 100-150), dan sarankan untuk menghubungi admin via WhatsApp atau datang langsung ke sekolah di Gabuswetan, Indramayu.
- Jika ditanya cara daftar: Sarankan untuk mengisi form pendaftaran di menu /pendaftaran.
- Jika ada pertanyaan yang tidak terkait sekolah, tolak dengan sopan.";

        $userMessage = $request->message;

        try {
            // Using Gemini 3.6 Flash
            $response = Http::post('https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key=' . $apiKey, [
                'system_instruction' => [
                    'parts' => [
                        ['text' => $systemInstruction]
                    ]
                ],
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => $userMessage]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak mengerti maksud Anda.';
                
                // Hapus bintang markdown (bold/italic) agar tampil teks biasa
                $text = str_replace(['**', '*'], '', $text);
                
                return response()->json(['reply' => trim($text)]);
            }

            return response()->json(['error' => 'Gagal terhubung ke server AI.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan sistem.'], 500);
        }
    }
}
