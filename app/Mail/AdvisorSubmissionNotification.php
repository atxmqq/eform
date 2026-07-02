<?php

namespace App\Mail;

use App\Models\FormSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdvisorSubmissionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public FormSubmission $submission,
        public object $advisor,
        public object $student,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[E-Form] คำร้อง ' . $this->submission->formType->name . ' รอการพิจารณา',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.advisor-submission',
        );
    }
}
