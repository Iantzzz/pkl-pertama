<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KomentarBaru extends Notification
{
    use Queueable;

    public function __construct(
        public Comment $comment
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Komentar Baru pada Laporan PKL')
            ->greeting('Halo ' . $notifiable->name)
            ->line('Ada komentar baru dari ' . $this->comment->user->name . ' pada laporan "' . $this->comment->laporan->kegiatan . '".')
            ->line('Komentar: ' . $this->comment->isi)
            ->action('Lihat Laporan', route('laporan.show', $this->comment->laporan))
            ->line('Terima kasih.');
    }
}
