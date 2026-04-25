<?php

namespace App\Services;

use Resend\Resend;

class EmailService
{
    protected $resend;

    public function __construct()
    {
        $this->resend = new Resend(env('RESEND_API_KEY'));
    }

    public function sendWelcomeEmail($user)
    {
        return $this->resend->emails->send([
            'from' => 'onboarding@resend.dev',
            'to' => $user->email,
            'subject' => 'Welcome to CRM',
            'html' => "<h1>Welcome {$user->name}</h1>",
        ]);
    }
}