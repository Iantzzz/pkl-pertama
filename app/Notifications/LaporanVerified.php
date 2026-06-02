<?php

namespace App\Notifications;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LaporanVerified extends Notification
{
    use Queueable;

    public function __construct(
        public Laporan $laporan
    ) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Status Laporan PKL Diperbarui')
            ->greeting('Halo ' . $notifiable->name)
            ->line('Laporan PKL Anda dengan kegiatan "' . $this->laporan->kegiatan . '" telah diperbarui.')
            ->line('Status: ' . strtoupper($this->laporan->status))
            ->action('Lihat Laporan', route('laporan.show', $this->laporan))
            ->line('Terima kasih.');
    }
}
