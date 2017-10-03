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
			->line('Cửa hàng Quà tặng chúng tôi đã nhận được thông tin yêu cầu phục hồi mật khẩu cho quý khách.')
			->line('Xin Quý khách vui lòng nhấn vào nút bên dưới để tạo lại mật khẩu cho mình.')
			->line('Lưu ý: mật khẩu bao gồm trên 6 ký tự (cả chữ và số)')
			->subject('Tạo mật khẩu mới')
			->action('Tạo Mật khẩu Mới', url($this->path, $this->token))
			->line('Nếu bạn không yêu cầu khôi phục mật mã, bạn có thể bỏ qua thao tác này.')
			->line('Chúc bạn mua sắm vui vẻ.');
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
