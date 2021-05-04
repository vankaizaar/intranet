<?php

namespace App\Notifications;

use App\RoomBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;

class NewRoomBooking extends Notification implements ShouldQueue
{
    use Queueable;

    protected $attendees;
    protected $creator;
    protected $roombooking;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Collection $attendees, Collection $creator, RoomBooking $roombooking)
    {
        $this->attendees = $attendees;
        $this->creator = $creator;
        $this->roombooking = $roombooking;
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
        $attendees = $this->attendees;
        foreach ($attendees as $object) {
            $attendeesString .= $object->name.' ';
        }

        return (new MailMessage)
            ->greeting('Hello!')
            ->subject('New Meeting: ' . $this->roombooking->title)
            ->line('You have been included as an attendee on the following upcoming meeting.')
            ->line('Title: ' . $this->roombooking->title)
            ->line('Description: ' . $this->roombooking->description)
            ->line('Creator: ' . $this->creator->first()->name)
            ->line('Attendees: ' .  $attendeesString)
            ->line('Time: ' . date_format(date_create($this->roombooking->start_time),"(H:i) l, j F Y ") . ' - ' . date_format(date_create($this->roombooking->end_time),"(H:i) l, j F Y "))
            ->line('Location: ' .  $this->roombooking->room()->first()->room_name)
            ->line('Thank you.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public
    function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
