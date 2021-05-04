<?php

namespace App\Notifications;

use App\RoomBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class RemovedUserRoomBooking extends Notification implements ShouldQueue
{
    use Queueable;

    protected $attendees;
    protected $roombooking;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(RoomBooking $roombooking, Collection $attendees)
    {
        $this->roombooking = $roombooking;
        $this->attendees = $attendees;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $attendeesString = NULL;

        foreach ($this->attendees as $object) {
            $attendeesString .= $object->name.' ';
        }
        return (new MailMessage)
            ->greeting('Hello!')
            ->subject('Removed from Meeting: ' . $this->roombooking->title)
            ->line('You have been removed as an attendee on the following meeting.')
            ->line('Title: ' . $this->roombooking->title)
            ->line('Description: ' . $this->roombooking->description)
            ->line('Creator: ' . $this->roombooking->user()->first()->name)
            ->line('New Attendees: ' . $attendeesString)
            ->line('Time: ' . date_format(date_create($this->roombooking->start_time),"(H:i) l, j F Y ") . ' - ' . date_format(date_create($this->roombooking->end_time),"(H:i) l, j F Y "))
            ->line('Location: ' . $this->roombooking->room()->first()->room_name)
            ->line('Thank you.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
