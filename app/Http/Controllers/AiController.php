<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{
    public function insights()
    {
        $user = Auth::user();

        $topics = $user->topics()->get(['name', 'status'])->toArray();
        $logs = $user->logs()->latest()->take(5)->get(['title', 'body', 'mood'])->toArray();
        $goals = $user->goals()->where('is_completed', false)->take(5)->get(['title'])->toArray();

        if (empty($topics) && empty($logs) && empty($goals)) {
            return response()->json(['insights' => 'Add some topics and logs first to get personalized insights!']);
        }

        $prompt = "You are a personal learning coach for a developer named " . $user->name . ".

        Here is their current learning data:
        - Topics they are studying: " . json_encode($topics) . "
        - Their 5 most recent log entries: " . json_encode($logs) . "
        - Their pending goals: " . json_encode($goals) . "

        Write a short personalized coaching report. Use exactly this format:

        **Progress Summary**
        Write 2 sentences analyzing their recent activity, mood patterns, and momentum. Be specific.

        **Your Next Steps**
        - [specific actionable tip based on their topics]
        - [specific tip based on their recent logs]
        - [specific tip based on their goals or gaps you notice]

        **Coach's Note**
        One powerful, specific motivational sentence addressing them by first name.

        Rules:
        - Be specific to their actual data, not generic
        - Mention their actual topic names
        - Keep total response under 150 words
        - Always address the developer directly using you/your
        - Never refer to them in third person
        - Be encouraging and warm, never critical or harsh
        - Focus on what they are doing well, then gently suggest improvements
        - Tone should be like a supportive mentor, not a strict coach
        - If data seems empty or minimal, acknowledge it honestly and encourage them to log more activity
        - Never invent or assume data that isn't provided
        - No markdown except the ** headers and bullet points";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('app.groq_api_key'),
            'Content-Type' => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'llama-3.1-8b-instant',
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'max_tokens' => 500
        ]);

        $response->json('choices.0.message.content') ?? 'Could not generate insights.';

        $text = $response->json('choices.0.message.content') ?? 'Could not generate insights.';
        return response()->json(['insights' => $text]);
    }
}
