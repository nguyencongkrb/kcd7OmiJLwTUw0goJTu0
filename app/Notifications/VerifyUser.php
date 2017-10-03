<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Config;

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
					->subject('Đăng ký thành viên')
					//->subject('Kích Hoạt Tài Khoản')
					->line('Chào mừng bạn đến với Cửa hàng Quà tặng '. Config::getValueByKey('site_name') .', Cửa Hàng dành riêng cho nhân viên SUN LIFE')
					->line('Hệ thống đã nhận được thông báo bạn đăng ký tài khoản tại SUNMART.COM')
					->line('Tên đăng nhập: ' . $this->user->email)
					//->action('Xác Nhận', $url)
					->line('Nếu có bất kỳ thắc mắc nào về quá trình mua hàng, xin vui lòng liên hệ. Trung tâm hỗ trợ khách hàng qua email: '. Config::getValueByKey('address_received_mail') .' hoặc HOTLINE: ' . Config::getValueByKey('hot_line'));
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
