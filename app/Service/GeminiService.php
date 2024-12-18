<?php

namespace App\Service;
use Illuminate\Support\Facades\Http;

class GeminiService
{
    public static function GeminiProImage($imagePath, $prompt, $config = [])
    {
        if (!file_exists($imagePath) || !is_readable($imagePath)) {
            throw new \InvalidArgumentException("Image file not found or not readable at path: {$imagePath}");
        }

        $url = config('services.gemini.api_url', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent');
        $key = env('GEMINI_API_KEY');
        if (!$key) {
            throw new \InvalidArgumentException("GEMINI_API_KEY is not set in the environment.");
        }

        $base64Image = base64_encode(file_get_contents($imagePath));
        $payload = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $prompt.'if given solve the following challenging math problem completely and show the full answer, including all the necessary steps for clarity. Be sure to provide an in-depth explanation of how you arrived at the solution, breaking down each step logically. Do not mention the word "image" at any point during your explanation. Provide a detailed explanation of the entire process in Bangla, ensuring that all key points and steps are clearly conveyed in the Bengali language.!!!. ',
                        ],
                        [
                            'inline_data' => [
                                'mime_type' => mime_content_type($imagePath), // Dynamically infer MIME type
                                'data' => $base64Image,
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("{$url}?key={$key}", $payload);

        if ($response->successful()) {
            return $response->json();
        }

        \Log::error('Gemini API Error', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return [
            'error' => $response->status(),
            'message' => $response->body(),
        ];
    }

//    End
}
