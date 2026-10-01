<?php

namespace App\Http\Controllers;

use App\Models\ChatbotFaq;

class ChatbotController extends Controller
{
    public function index()
    {
        $faqs = ChatbotFaq::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json($faqs);
    }
}
