<?php

namespace App\Http\Controllers;

use App\Service\GeminiService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function Gemini(Request $request)
    {
        $request->validate([
            'image' => ['required', 'string', 'regex:/^data:image\/(png|jpeg|jpg|gif);base64,/'],
        ]);

        $prompt = $request->input('prompt');

        $base64String = $request->input('image');

        // Remove the prefix (e.g., "data:image/png;base64,")
        if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $matches)) {
            $imageType = $matches[1]; // Get the image type (e.g., "png", "jpeg")
            $base64String = substr($base64String, strpos($base64String, ',') + 1); // Remove prefix
        } else {
            return response()->json(['error' => 'Invalid Base64 string'], 400);
        }

        $decodedData = base64_decode($base64String, true); // Enable strict decoding
        if ($decodedData === false) {
            return response()->json(['error' => 'Base64 decode failed'], 400);
        }

        // Ensure uploads directory exists
        $uploadsDir = public_path('uploads');
        if (!is_dir($uploadsDir)) {
            mkdir($uploadsDir, 0755, true);
        }

        $fileName = time() . '.' . $imageType;
        $filePath = $uploadsDir . '/' . $fileName;

        // Save the decoded data as an image file
        if (file_put_contents($filePath, $decodedData) === false) {
            return response()->json(['error' => 'Failed to save image file'], 500);
        }

        try {
            // Call the GeminiService API service with the image path
            $response = GeminiService::GeminiProImage($filePath , $prompt);

            if (!isset($response['candidates'][0]['content']['parts'][0]['text'])) {
                return response()->json(['error' => 'Invalid API response format'], 500);
            }

            $data = $response['candidates'][0]['content']['parts'][0];

            // Clean up the temporary file
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            return response()->json(['info' => $data]);

        } catch (\Exception $e) {
            if (file_exists($filePath)) {
                unlink($filePath); // Clean up the temporary file
            }
            return response()->json(['error' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }

//    End
}
