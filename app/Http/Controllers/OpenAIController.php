<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class OpenAIController extends Controller
{
    // Metode untuk menampilkan halaman chat bot
    public function sendMessage(Request $request)
{
    $message = $request->input('message'); // Mengambil pesan dari input form

    $data = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . env('OPEN_API_KEY'),
    ])
    ->post("https://api.openai.com/v1/chat/completions", [
        "model" => "gpt-3.5-turbo",
        "messages" => [
            [
                "role" => "user",
                "content" => $message // Menggunakan variabel $message sebagai isi pesan
            ]
        ],
        "temperature" => 0.5,
        "max_tokens" => 200,
        "top_p" => 1.0,
        "frequency_penalty" => 0.52,
        "presence_penalty" => 0.5,
    ])->json();

    // Ubah kode di bawah ini untuk menangani respons dari API OpenAI
    if (isset($data['choices'][0]['message']['content'])) {
        $botReply = $data['choices'][0]['message']['content'];
    } else {
        $botReply = "Bot failed to provide a response."; // Jika tidak ada balasan yang diberikan oleh bot
    }

    return response()->json(['reply' => $botReply], 200);
}

}
