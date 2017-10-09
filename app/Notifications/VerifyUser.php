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
					->greeting('Cửa hàng quà tặng <span style="color:#eaab00"><strong>'. Config::getValueByKey('site_name') .'</strong></span> Kính chào Anh/Chị')
					->line('Chào mừng Anh/Chị đã đến với website http://quatangsunmart.com')
					->line('Dưới đây là thông tin tài khoản chính thức của anh/chị:')
					->line('<strong>Tên đăng nhập: ' . $this->user->email . '</strong>')
					//->action('Xác Nhận', $url)
					->line('Sau khi đăng nhập thành công, vui lòng thay đổi mật khẩu cá nhân để đảm bảo Chính sách bảo mật thông tin.')
					->line('Mọi thắc mắc và cần sự hỗ trợ, xin vui lòng liên hệ Trung Tâm Chăm Sóc Khách Hàng <span style="color:#eaab00"><strong>' . Config::getValueByKey('hot_line') . '</strong></span> hoặc qua email: ' . Config::getValueByKey('address_received_mail') . '.')
					->line('Chúc Anh/Chị có thời gian mua sắm thật thú vị!')
					->line('Cảm ơn và chào trân trọng!');
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
