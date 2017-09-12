<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Config;
use App\Contact;

class ContactRequest extends Notification
{
	use Queueable;

	public $contact;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct(Contact $contact)
	{
		$this->contact = $contact;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail', 'database'];
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
					->from(Config::getValueByKey('address_sender_mail'), Config::getValueByKey('display_name_send_mail'))
					->subject('Liên hệ từ website')
					->view('frontend.emails.contactrequest', ['contact' => $this->contact]);
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function toArray($notifiable)
	{
		return $this->contact->toArray();
	}
}
