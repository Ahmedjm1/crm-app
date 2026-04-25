<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EmailService
{
    public function sendWelcomeEmail($user)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . env('RESEND_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.resend.com/emails', [
            'from' => 'onboarding@resend.dev',
            'to' => $user->email,
            'subject' => 'Welcome to CRM',
            'html' => "<h1>Welcome {$user->name}</h1>",
        ]);
    }
}