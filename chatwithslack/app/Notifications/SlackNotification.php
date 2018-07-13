<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Notifications\Messages\SlackMessage;

class SlackNotification extends Notification
{
    use Queueable;
    private $sender;
    public $msg;
    private $file;
    private $type;
  
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$msg,$typefile)
    {
        $this->sender=$user;
        $this->msg=$msg->message;
        $this->file=$msg->file;
        $this->type=$typefile;
    }
    

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toSlack($notifiable)
    {
        $msg= $this->msg;
        $url=url('storage/images/'.$this->file);
        $type=$this->type;
        return (new SlackMessage)
                    ->content($this->msg)
                    ->from($this->sender, ':ghost:')
                    ->attachment(function ($attachment) use ($url,$type) {
                        if($type){
                        $attachment->title('Type of file '.$type, $url);
                        }
                                 
                    });
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
            //
        ];
    }
}
