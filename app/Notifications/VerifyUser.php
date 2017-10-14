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

		$center = 'text-align:center;display:block;';
		$anchor = 'color: #3869D4;text-decoration: none;';

		$mailMessage = (new MailMessage)
					->subject('Đăng ký thành viên')
					->line('<span style="'.$center.'background:#f9df9c;padding: 10px 5px;">Chào mừng <strong>'. $this->user->getFullname() .'</strong> đến với<br>
						<strong style="color: #eaab00;">'.Config::getValueByKey('site_name').'</strong><strong> - <a style="'.$anchor.'" href="'.url('/').'">'. preg_replace('/^https?:\/\//', '', url('/')).'</a></strong><br>
						Cửa hàng quà tặng trực tuyến dành cho Tư vấn Tài chính Sun Life Việt Nam
						</span>')
					->line('<span style="'.$center.'border-top: solid 1px #eaab00;"></span>')
					->line('<span style="'.$center.'">Tên đăng nhập của bạn: <strong>' . $this->user->username . '</strong></span>')
					//->action('Xác Nhận', $url)
					->line('<span style="'.$center.'">Hãy bắt đầu trải nghiệm mua sắm cùng <strong>'. Config::getValueByKey('site_name') .'</strong>!</span>')
					->line('Mọi thắc mắc vui lòng liên hệ Trung tâm dịch vụ khách hàng của <strong>'.Config::getValueByKey('site_name').'</strong> qua Email <a style="'.$anchor.'" href="'.Config::getValueByKey('address_received_mail').'">'.Config::getValueByKey('address_received_mail').'</a> hoặc Hotline <a style="'.$anchor.'" href="tel:'.Config::getValueByKey('hot_line').'"><strong>'.Config::getValueByKey('hot_line').'</strong></a>. Chúng tôi sẽ phản hồi bạn trong thời gian sớm nhất.');
		if($this->user->type)
			$mailMessage->action('Xác Nhận', $url);


		return $mailMessage;
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
