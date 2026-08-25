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
Tugas Anda adalah menjawab pertanyaan pengunjung website mengenai pendaftaran (PPDB), fasilitas, atau visi misi sekolah.
- Jawablah dengan ramah, sopan, dan cukup singkat (jangan bertele-tele). 
- Gunakan sapaan yang hangat seperti 'Halo Ayah/Bunda!' jika cocok.
- Jika ditanya biaya pendaftaran atau rincian biaya: Jawablah bahwa saat ini Anda belum memiliki rincian biaya pasti, dan menyarankan orang tua untuk menghubungi admin via WhatsApp atau datang langsung ke sekolah di Bandung.
- Jika ditanya cara daftar: Sarankan untuk mengisi form pendaftaran di menu /pendaftaran.
- Jika ada pertanyaan aneh yang tidak terkait sekolah atau pendidikan, tolak dengan sopan dan kembalikan topik ke RA Al-Musyafallahi.";

        $userMessage = $request->message;

        try {
            // Using Gemini 1.5 Flash which supports system instructions
            $response = Http::post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $apiKey, [
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
                return response()->json(['reply' => trim($text)]);
            }

            return response()->json(['error' => 'Gagal terhubung ke server AI.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan sistem.'], 500);
        }
    }
}
