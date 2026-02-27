<?php

namespace App\Mail;

use App\Models\Conversation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ChatWaitingMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Conversation $conversation;

    public function __construct(Conversation $conversation)
    {
        $this->conversation = $conversation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Chat Waiting - ' . $this->conversation->visitor_name
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.chat.waiting',
            with: [
                'conversation' => $this->conversation,
                'companyName' => $this->conversation->company->name ?? 'Support Team',
                'dashboardUrl' => url("/agent/conversations/{$this->conversation->uuid}")
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}