<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyUser extends Notification
{
	use Queueable;

	private $user;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($user)
	{
		$this->user = $user;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		$url = route('create.verify', ['confirmationcode' => $this->user->confirmation_code]);

		return (new MailMessage)
					->line('Hoàn tất việc đăng ký bằng việc nhấp vào nút bên dưới!.')
					->subject('Kích Hoạt Tài Khoản')
					->action('Xác Nhận', $url)
					->line('Cảm ởn bạn đã sử dụng website!');
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
