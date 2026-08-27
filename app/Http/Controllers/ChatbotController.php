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

        // Fetch system instructions from database settings (with cache)
        $settings = \Illuminate\Support\Facades\Cache::remember('global_settings', 604800, function () {
            return \App\Models\Pengaturan::pluck('nilai', 'kunci')->toArray();
        });
        $systemInstruction = $settings['chatbot_prompt'] ?? "Anda adalah Asisten Virtual cerdas dan ramah untuk RA Al-Musyafallahi.";

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
