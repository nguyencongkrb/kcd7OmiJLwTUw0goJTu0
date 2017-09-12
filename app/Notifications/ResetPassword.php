<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
	use Queueable;

	public $token;
	private $path;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($token, $path)
	{
		$this->token = $token;
		$this->path = $path;
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
		return (new MailMessage)
			->line([
				'Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu khôi phục mật mã cho tài khoản của bạn.',
				'Nhấn vào nút bên dưới để đặt lại mật mã của bạn:',
			])
			->subject('Khôi Phục Mật Mã')
			->action('Tạo Mật Khẩu Mới', url($this->path, $this->token))
			->line('Nếu bạn không yêu cầu khôi phục mật mã, bạn có thể bỏ qua thao tác này.');
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
