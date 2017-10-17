<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
	'password', 'remember_token',
	];

	/**
	 * Send the password reset notification.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
		$path = $this->type ? '/backend/password/reset' : '/tao-mat-mat-moi';

		$this->notify(new ResetPassword($token, $path));
	}

	public function roles()
	{
		return $this->belongsToMany('App\Role');
	}

	public function hasRoles($roles)
	{
		$have_roles = $this->roles->pluck('key')->toArray();
		$have_roles = array_map('strtolower', $have_roles);

		if(is_array($roles)){
			foreach($roles as $need_role){
				if($this->checkIfUserHasRole($have_roles, $need_role)) {
					return true;
				}
			}
		} else{
			return $this->checkIfUserHasRole($have_roles, $roles);
		}
		return false;
	}

	public function getFullname()
	{
		return $this->last_name . ' ' . $this->first_name;
	}

	private function checkIfUserHasRole($have_roles, $need_role)
	{
		return in_array(strtolower($need_role), $have_roles);
	}

	public function attachments()
	{
		return $this->morphMany('App\Attachment', 'attachmentable');
	}

	// required model has relation attachments
	public function getFirstAttachment($template = 'original')
	{
		$attachment = $this->attachments()->where('published', 1)->first();
		if (isset($attachment) && !is_null($attachment)) {
			return $attachment->getLink($template);
		}
		return '';
	}

	public function shoppingCarts()
	{
		return $this->hasMany('App\ShoppingCart', 'customer_id');
	}

	public function province()
    {
        return $this->belongsTo('App\Province', 'province_id');
    }

	public function district()
	{
		return $this->belongsTo('App\District', 'district_id');
	}

	public function sentPasswordWithSMS($password)
	{
		$site_name = Config::getValueByKey('site_name');
		$phoneNumber = $this->mobile_phone;
		$smsMessage = 'Qua tang '.$site_name.' nhan duoc yeu cau thay doi mat khau cua ban. User:'.$this->username.' PW: '.$password.'. Vui long dang nhap lai va thay doi mat khau.';

		if (!empty($phoneNumber) && !empty($smsMessage)) {
			$sms_Url = env('SMS_Url', '');
			$sms_Username = env('SMS_Username', '');
			$sms_Password = env('SMS_Password', '');

			$fullUrl = $sms_Url . '?clientNo='.$sms_Username.'&clientPass='.$sms_Password.'&senderName=Sunmart&phoneNumber='.$phoneNumber.'&smsMessage='.$smsMessage.'&smsGUID=0&serviceType=0'; 

			//return $fullUrl;

			$client = new \GuzzleHttp\Client();
			$res = $client->request('GET', $fullUrl);
			return $res->getStatusCode(); // 200
		}
	}
}
