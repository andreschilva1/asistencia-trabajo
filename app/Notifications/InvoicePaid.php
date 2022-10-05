<?php

namespace App\Notifications;

use App\Models\trabajosAsignado;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(trabajosAsignado $trabajo_asignado)
    {
        $this->trabajo_asignado = $trabajo_asignado;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'trabajoAsignado_id' => $this->trabajo_asignado->id,
            'trabajo_nombre' => $this->trabajo_asignado->trabajos->nombre,
            'tecnico_id' => $this->trabajo_asignado->tecnicos_id,
            'tecnico_nombre' => $this->trabajo_asignado->users->name,
            'fecha'=> $this->trabajo_asignado->Fecha,
            'time' => Carbon::now()->diffForHumans(),

        ];
    }
}
