<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Config;
use DB;
use App\User;

class ResetPassword extends Notification
{
	use Queueable;

	public $token;
	private $path;
	private $user;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct($token, $path)
	{
		$this->token = $token;
		$this->path = $path;

		$email = DB::table('password_resets')
			->where('token', '=', $token)
			->pluck('email');
		$this->user = User::whereIn('email', $email)->first();
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
			->subject('Khôi Phục Mật Khẩu '.Config::getValueByKey('site_name'))
			->greeting('<span style="padding-top:35px;display:inline-block;">Chào <strong>'. $this->user->getFullname() .'</strong></span>,')
			->line('<strong>'.Config::getValueByKey('site_name'). '</strong> đã nhận được yêu cầu khôi phục mật khẩu của bạn. Vui lòng nhấn vào nút bên dưới để tạo lại mật khẩu cho mình.')
			->line('<em><strong>Lưu ý:</strong> mật khẩu bao gồm trên 6 ký tự (cả chữ và số)</em>')
			->action('Tạo Mật khẩu Mới', url($this->path, $this->token))
			->line('Nếu bạn không muốn khôi phục mật khẩu, vui lòng bỏ qua email này.')
			->line('Mọi thắc mắc vui lòng liên hệ Trung tâm dịch vụ khách hàng của <strong>'.Config::getValueByKey('site_name').'</strong> qua Email <a style="color: #3869D4;text-decoration: none;" href="'.Config::getValueByKey('address_received_mail').'">'.Config::getValueByKey('address_received_mail').'</a> hoặc Hotline <a style="color: #3869D4;text-decoration: none;" href="tel:'.Config::getValueByKey('hot_line').'"><strong>'.Config::getValueByKey('hot_line').'</strong></a>. Chúng tôi sẽ phản hồi bạn trong thời gian sớm nhất.')
			->line('Chúc bạn mua sắm vui vẻ!');
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
