<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContractExpiringNotification extends Notification
{
    use Queueable;
    private $contract;
    private $daysLeft;

    /**
     * Create a new notification instance.
     */
    public function __construct($contract, $daysLeft)
    {
        $this->contract = $contract;
        $this->daysLeft = $daysLeft;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('แจ้งเตือนสัญญาใกล้หมดอายุ')
            ->line("สัญญาเลขที่ {$this->contract->contract_no}/{$this->contract->contract_year} จะหมดอายุในอีก {$this->daysLeft} วัน")
            ->action('ดูรายละเอียดสัญญา', route('contracts.show', $this->contract->id))
            ->line('กรุณาตรวจสอบและดำเนินการต่อไป');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
