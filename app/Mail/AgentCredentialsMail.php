<?php

namespace App\Mail;

use App\Models\Agent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AgentCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $agent;
    public $plainPassword;

    /**
     * Create a new message instance.
     */
    public function __construct(Agent $agent, string $plainPassword)
    {
        $this->agent = $agent;
        $this->plainPassword = $plainPassword;
    }

    /**
     * Email subject
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Agent Account Credentials',
        );
    }

    /**
     * Email view
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.agent_credentials',
            with: [
                'agent' => $this->agent,
                'plainPassword' => $this->plainPassword,
            ],
        );
    }

    /**
     * Attachments
     */
    public function attachments(): array
    {
        return [];
    }
}